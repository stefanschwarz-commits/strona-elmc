<?php
/**
 * Cotygodniowa kontrola strony ELMC (elmc.eu) i archiwow kongresow - poniedzialek rano.
 * Mail do Stefana (z claude@labourinstitute.eu) TYLKO gdy cos nie dziala.
 * Uzycie: php8.1 ~/bin/sprawdz-elmc.php [--pokaz]   (--pokaz: wypisz wynik, bez maila)
 * Utworzone 22.09.2026 w repo strona-elmc (sesja Claude Code).
 */
declare(strict_types=1);
$pokaz = in_array('--pokaz', $argv, true);
$ua = 'Mozilla/5.0 (sprawdz-elmc; ELMI) Chrome/128.0';

function pobierz(string $url, string $ua, bool $za = true): array {
    $ch = curl_init($url);
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => $za, CURLOPT_TIMEOUT => 30,
        CURLOPT_USERAGENT => $ua, CURLOPT_MAXREDIRS => 5]);
    $tresc = (string)curl_exec($ch);
    $wynik = ['kod' => curl_getinfo($ch, CURLINFO_HTTP_CODE), 'tresc' => $tresc,
        'dokad' => (string)curl_getinfo($ch, CURLINFO_REDIRECT_URL), 'koniec' => (string)curl_getinfo($ch, CURLINFO_EFFECTIVE_URL)];
    curl_close($ch);
    return $wynik;
}

$problemy = [];
$ok = 0;
$sprawdz = function (string $opis, bool $warunek, string $szczegol = '') use (&$problemy, &$ok) {
    if ($warunek) { $ok++; } else { $problemy[] = $opis . ($szczegol !== '' ? " ($szczegol)" : ''); }
};

// 1. Strona glowna w obu jezykach
foreach (['https://elmc.eu/' => 'Europejski Kongres', 'https://elmc.eu/en/' => 'European Labour Mobility Congress'] as $u => $tekst) {
    $r = pobierz($u, $ua);
    $sprawdz("strona $u", $r['kod'] === 200 && strpos($r['tresc'], $tekst) !== false && strpos($r['tresc'], 'name="email"') !== false, "kod {$r['kod']}");
}
// 2. Informacja o danych osobowych
$r = pobierz('https://elmc.eu/privacy-notice/', $ua);
$sprawdz('informacja o danych', $r['kod'] === 200, "kod {$r['kod']}");
// 3. Przekierowanie ekmp.pl -> elmc.eu
$r = pobierz('https://ekmp.pl/', $ua, false);
$sprawdz('przekierowanie ekmp.pl', in_array($r['kod'], [301, 302], true) && strpos($r['dokad'], 'elmc.eu') !== false, "kod {$r['kod']} -> {$r['dokad']}");
// 4. Archiwa kongresow (cel nr 1 projektu - nic nie moze zniknac)
foreach (['2013', '2014', '2015', '2016', '2017', '2019', '2022', '2023'] as $rok) {
    $r = pobierz("https://ekmp.pl/$rok/", $ua);
    $tytul = preg_match('~<title>([^<]*)~i', $r['tresc'], $m) ? trim($m[1]) : '';
    $sprawdz("archiwum ekmp.pl/$rok", $r['kod'] === 200 && $tytul !== '' && stripos($tytul, '403') === false && stripos($tytul, '404') === false, "kod {$r['kod']}, tytul: " . mb_substr($tytul, 0, 50));
}
// 5. Mural i logo sie wczytuja
foreach (['img/kv-elmc-900.webp?v=2', 'img/logo-elmc.svg', 'fonts/archivo-latin.woff2'] as $plik) {
    $r = pobierz("https://elmc.eu/2027/wp-content/themes/elmc2027/assets/$plik", $ua);
    $sprawdz("plik $plik", $r['kod'] === 200 && strlen($r['tresc']) > 1000, "kod {$r['kod']}");
}

$podsumowanie = sprintf("%s: %d w porzadku, %d problemow\n", date('Y-m-d H:i'), $ok, count($problemy));
if ($pokaz) { echo $podsumowanie, $problemy ? ' - ' . implode("\n - ", $problemy) . "\n" : ''; }
@mkdir(getenv('HOME') . '/sprawdzanie', 0700, true);
file_put_contents(getenv('HOME') . '/sprawdzanie/elmc.log', $podsumowanie . ($problemy ? ' - ' . implode("\n - ", $problemy) . "\n" : ''), FILE_APPEND);

if ($problemy && !$pokaz) {
    $html = '<p>Cotygodniowa kontrola strony <a href="https://elmc.eu">elmc.eu</a> znalazła problemy:</p><ul><li>'
        . implode('</li><li>', array_map('htmlspecialchars', $problemy)) . '</li></ul><p>W porządku: ' . $ok
        . ' sprawdzeń.</p><p>Wiadomość automatyczna (skrypt ~/bin/sprawdz-elmc.php na serwerze). Otwórz sesję Claude Code w repo strona-elmc, żeby to naprawić.</p>';
    $plik = tempnam(sys_get_temp_dir(), 'elmc');
    file_put_contents($plik, json_encode(['od' => 'claude@labourinstitute.eu', 'temat' => 'elmc.eu - kontrola znalazła problem (' . count($problemy) . ')',
        'do' => ['stefan.schwarz@labourinstitute.eu'], 'html' => $html], JSON_UNESCAPED_UNICODE));
    passthru('/usr/bin/php8.1 ' . escapeshellarg(getenv('HOME') . '/rodo/wyslij-graph.php') . ' ' . escapeshellarg($plik));
    unlink($plik);
}
