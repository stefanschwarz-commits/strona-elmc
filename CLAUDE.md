# strona-elmc — kontekst projektu

Ten plik jest wczytywany automatycznie przez każdą sesję Claude Code otwartą w tym repo.

**Stefan miewa otwarte równolegle inne sesje Claude Code (i Codex) w tym folderze — zawsze
sprawdź `git log` i aktualny stan serwera, zanim założysz, że coś poniżej wciąż jest aktualne.**
Lista spraw otwartych: `SPRAWY_OTWARTE.md`.

## 0. Stan na 19.09.2026 — strona działa, jest co rozwijać

- **Repo nie jest już puste**: `theme/` to kompletny motyw WordPressa ELMC 2027, wdrażany
  automatycznie na `dev.ekmp.pl` (patrz §9 i §10).
- **`dev.ekmp.pl` działa**: dwujęzyczna strona jednostronicowa według projektu z Claude Design
  (16 sekcji, PL pod adresem głównym, EN pod `/en/`).
- Blokady z lipca (PHP 7.3, nieukończony autoinstalator, uprawnienia FTP) — **rozwiązane**.

## 1. Cel projektu (ustalony ze Stefanem)

1. **Zachować i nadal serwować każdą przeszłą edycję ELMC od 2013 roku** (nic nie usuwać).
2. Po zakończeniu danej edycji, stawiać nową stronę pod kolejną edycję — **obecnie w
   przygotowaniu: ELMC 2027**.
3. Strona główna `elmc.eu` ma zawsze pokazywać nadchodzącą edycję, z opcją przeglądania
   edycji archiwalnych ("Poprzednie edycje").

**Uzgodniony plan (zaakceptowany przez Stefana):** Faza 1 — zbudować stronę ELMC 2027 jako
nową instalację WP w katalogu numerowanym rokiem (wzorem istniejących `20XX`), oraz stronę
główną elmc.eu (nadchodząca edycja + menu "Poprzednie edycje" do archiwów 2013–2026) —
docelowo najpierw na `dev.ekmp.pl` jako bezpieczny plac budowy (nie wymaga zmian DNS/Cloudflare,
bo ta subdomena już wskazuje na hosting CyberFolks).

## 2. Stan dziś: `elmc.eu` żyje, ale tylko jako przekierowanie

- `https://elmc.eu/` → 301 → `https://labourinstitute.eu/en/elmc2025/` (podstrona głównej
  strony ELMI o kongresie 2025). `https://ekmp.pl/` → 301 → `https://labourinstitute.eu/ekmp2025/`.
- **Mechanizm przekierowania:** reguły `mod_rewrite` w `.htaccess` na serwerze
  (`/home/users/imphost/public_html/ekmp.pl/.htaccess`), skonfigurowane przez Dawida (komentarze
  w pliku: "dsierzy - 20241106 - przekieruj ruch..."), NIE reguła Cloudflare Page/Redirect Rule
  (tych nie ma). Reguły jawnie WYKLUCZAJĄ ścieżki z prefiksem roku (2013/2014/.../2023) z
  przekierowania.
- **Zagadka `elmc.eu/2019/` — wyjaśniona 19.09.2026:** roczniki 2013, 2017 i 2019 mają we
  własnym `.htaccess` regułę „Przekierowanie zamówione przez Dominika" (host elmc.eu →
  `www.ekmp.pl/`). To nie wtyczka Redirection. Katalog dokumentów obu domen to
  `public_html/ekmp.pl` (roczniki w podkatalogach, 2014–2016 w wersjach `…pl`/`…en`).
- **Archiwa to cel nr 1 projektu** — po incydencie z 19.09.2026 (inny wątek zamknął roczniki,
  potem je przywrócił, patrz `SPRAWY_OTWARTE.md`) każda sesja porządkująca serwer ma je
  zostawić otwarte.
- Dla porównania: `https://ekmp.pl/2019/` (bez `elmc.` ) działa poprawnie i pokazuje prawdziwe
  archiwum "VI European Labour Mobility Congress (EKMP) 2019".

## 3. Hosting — to samo konto co labormobilis/polskaopieka, PEŁNA lista domen

- Panel kliencki (rozliczenia/dane): `panel.cyberfolks.pl` — organizacja "STOWARZYSZENIE
  EUROPEJSKI INSTYTUT MOBILNOŚCI PRACY" (Stefan Schwarz, Plac Wolnica 13/10, 30-060 Kraków,
  NIP PL6762470670). Panel techniczny (domeny/aplikacje): `webas23187.e-kei.pl` ("WebAs") —
  to ten sam serwer/login co w `labormobilis`/`polskaopieka`. Login techniczny: `imphost`,
  serwer `94.152.54.152`.
- **Zweryfikowana lista domen na tym koncie** (z formularza autoinstalatora WordPressa,
  2026-07 — część nieużywana/legacy): `arch.inicjatywa.eu`, `dev.ekmp.pl`, `ekmp.pl`, `elmc.eu`,
  `imphost.e-kei.pl`, `inicjatywa.eu`, `koordynacja.org`, `kpeu.pl`, `labormobilis.eu`,
  `labourinstitute.eu`, `labourmobilityinstitute.eu`, `m.inicjatywa.eu`, `mobilelabour.eu`,
  `next.ekmp.pl`, `next.labourmobilityinstitute.eu`, `old.inicjatywa.eu`, `polskaopieka.eu`,
  `psod.eu`, `registration.ekmp.pl`, `rejestracja.ekmp.pl`, `rejestracja.koordynacja.org`,
  `sklep.labourinstitute.eu`, `test.registration.elmc.eu`, `wp.ekmp.pl` (dwie ostatnie na
  starym PHP 5.6) — potwierdza i uszczegóławia decyzję z
  `C:\Projekty\_zasady-wspolpracy-zespolowej.md` §2: **dostęp serwerowy do jednego z tych
  projektów = dostęp do całego tego zestawu domen.**
- **29 osobnych baz danych MySQL** na koncie — po jednej per rok/edycja (`elmc_2014`–`2017`,
  `ekmp_2013`–`2023` — `ekmp_2023` 422MB, największa — plus `laborm_2017`, `lmi_2022`,
  `inicjatywa`, `kpeu`) oraz `po_2022`/`po_2023` (prawdopodobnie `polskaopieka`). Audyt
  (tylko odczyt) potwierdził: **nic z archiwów poprzednich edycji nie zginęło.**
- **DNS domen `elmc.eu`/`ekmp.pl` zarządzane przez Cloudflare**, konto o nazwie "dsierzy"
  (Dawid Sierży) — **dostęp administracyjny do obu stref (w tym zarządzanie DNS) został już
  przyznany** kontu `stefan.schwarz@labourinstitute.eu` w trakcie tej sesji (zaproszenie
  wysłane przez Dawida, Stefan sam się zalogował — asystent nie loguje się nigdy w imieniu
  użytkownika, nawet ze znanym hasłem, patrz §5).
- Rzeczywisty adres origin za Cloudflare: `94.152.54.152` (rekord A dla elmc.eu, proxy
  Cloudflare/"orange cloud" włączony — stąd publiczne resolwowanie pokazuje IP Cloudflare,
  nie origin).

## 4. Odkryta osierocona instalacja WordPressa pod `public_html/elmc.eu`

Osobna, samodzielna instalacja WP (motyw `ekmp`, wtyczki: WPML/sitepress-multilingual-cms,
Advanced Custom Fields Pro, **Redirection** (patrz zagadka w §2), Yoast SEO, Cache Enabler;
pliki core z lipca 2017, ostatnio dotykane sierpień 2020) — **niepodpięta pod żadną domenę
dziś**. Cel projektu (§1, "budować od zera") sugeruje, że **prawdopodobnie NIE będzie
reużyta jako fundament** — ale ostateczna decyzja nie została jawnie potwierdzona w
transkrypcie. Nie kasować/nadpisywać tej instalacji bez potwierdzenia ze Stefanem.

## 5. `dev.ekmp.pl` jako plac budowy — realne ryzyko bezpieczeństwa + zasada pracy

- `dev.ekmp.pl` miał zostać wyczyszczony pod nową instalację. Audyt znalazł tam stary,
  zapomniany WordPress z **2018/2019** roku, w tym **publicznie dostępny plik `adminer.php`**
  (narzędzie do zarządzania bazą danych) — **realne ryzyko bezpieczeństwa niezależnie od
  dalszych planów**, ktokolwiek mógłby przez niego dostać się do bazy. **Sprawdzić, czy to
  wciąż tam jest — jeśli tak, priorytet do usunięcia/zablokowania niezależnie od reszty planu.**
- Przed czymkolwiek zrobiono **backup tylko-do-odczytu** przez tymczasowe, jednorazowe dane
  panelu (ograniczone czasowo/IP): pełny FTP konta (60GB) i zrzut bazy `baza23187_dev_ekmp`.
  Oba te tymczasowe dostępy wygasały krótko po sesji (jeden 2026-07-06 12:00, drugi
  2026-07-05 17:36) — jeśli potrzebny nowy backup, trzeba wygenerować nowe dane w panelu.
- **Zasada bezpieczeństwa stosowana konsekwentnie w tej sesji (i w `polskaopieka`):**
  mimo że Stefan podał hasło do głównego konta `imphost` wprost na czacie (żeby się zalogować
  do panelu), **asystent nigdy nie użył go do zalogowania/uwierzytelnienia się w imieniu
  Stefana** — ani do panelu CyberFolks, ani do Cloudflare. Stefan loguje/autoryzuje się zawsze
  sam; asystent czeka i działa dopiero na już-zalogowanej sesji.
- **Zalecenie bezpieczeństwa dla Stefana:** hasło do głównego konta `imphost` padło jawnym
  tekstem na czacie tamtej sesji — warto je zrotować po zakończeniu bieżących prac, czat nie
  jest bezpiecznym miejscem do trzymania haseł na stałe.

## 6. Blokady z lipca 2026 — rozwiązane (zostawione jako historia)

- **PHP 7.3 na `dev.ekmp.pl`** blokował autoinstalator WordPressa. Zmiana na 8.2 w panelu
  ostatecznie zadziałała; WordPress zainstalowany, motyw ELMC 2027 aktywny.
- **Konto FTP `deploy_elmc` „psuło" stronę (403 / pliki niewidoczne dla WWW)** — okazało się,
  że to nie był błąd hostingu, tylko **zła ścieżka podkatalogu konta FTP**. Katalog domowy
  domeny to `/home/users/imphost/public_html/dev.ekmp.pl`, a konto FTP miało wpisane
  `/dev.ekmp.pl`, czyli `/home/users/imphost/dev.ekmp.pl` — zupełnie inny, nieserwowany
  katalog (wyjaśnił Maciej Machnik z CyberFolks, 16.08.2026). **Podkatalog konta FTP musi
  zaczynać się od `public_html/`.** Konto `ligia_ekmp` ma poprawną ścieżkę i to ono służy do
  wdrożeń. Krok `chmod` w workflow został z tamtych prób — nie szkodzi, nie był sprawdzany
  osobno po naprawie ścieżki.

## 7. Kontakt zewnętrzny: Dawid

**Dawid Sierży** (`d.sierzy@microlab.pl`, też widziany jako `dawid@sierzy.pl`) — zewnętrzny
kontakt IT dla ELMI, kontroluje konto Cloudflare i pierwotnie skonfigurował przekierowania w
`.htaccess`. Prawdopodobnie też kontroluje/wie, pod jakim kontem klienckim CyberFolks
faktycznie widnieje usługa `imphost` (patrz §6). Dwa maile do niego w tej sesji: (1) o dostęp
do Cloudflare — **przyznany**, (2) o konto CyberFolks dla `imphost` — **wysłany, bez
potwierdzonej odpowiedzi na koniec transkryptu.**

## 8. Zasady współpracy zespołowej

Pełny, przenośny rdzeń: `C:\Projekty\_zasady-wspolpracy-zespolowej.md`. Kluczowe punkty:
- **Stefan nie przegląda diffów kodu** (uniwersalny fakt) — nie prosić o code review, działać
  i podsumowywać słownie, pytać tylko o decyzje biznesowe/dostępowe.
- **Dostęp serwerowy tutaj = dostęp do całego zestawu domen z §3** — najbardziej rozległy
  potwierdzony przypadek z całego portfela.
- **Nie uwierzytelniać się jako użytkownik nawet ze znanym hasłem** (§5) — Stefan loguje/
  autoryzuje się sam do paneli/kont trzecich (Cloudflare, CyberFolks, Dropbox w innych
  projektach, itp.) — to spójna zasada w całym portfelu, nie tylko tutaj.
- Sposób pracy na żywej stronie (pomiary zamiast wrażeń, wdrożenie i sprawdzenie w tej samej
  sesji, raport po polsku bez żargonu): skill `zywa-strona`.

## 9. Motyw ELMC 2027 — architektura

Kod: `theme/` (motyw WordPressa, katalog na serwerze: `wp-content/themes/elmc2027`).

- `style.css` — nagłówek motywu + **cały** system wizualny (tokeny w `:root`, sekcje, RWD).
  Brak osobnych plików CSS, brak JavaScriptu na froncie.
- `functions.php` — konfiguracja, wczytanie fontów, zapis na powiadomienia (zgoda + podwójne
  potwierdzenie + wypis + przekazanie do rejestru zgód), wersja bazy (`ELMC2027_DB_VERSION`),
  stała `ELMC2027_CONTACT_EMAIL`.
- `inc/copy.php` — **wszystkie teksty PL/EN** i dane powtarzalnych bloków (edycje, poziomy
  partnerstwa, filary). Tu się zmienia treść, nie w szablonach.
- `inc/i18n.php` — dwa języki: PL pod `/`, EN pod `/en/` (reguła przepisania + `hreflang`).
- `inc/cfs.php` — Call for Speakers: tabela, walidacja, mail na `ELMC2027_CONTACT_EMAIL`.
- `inc/admin.php` — podgląd zapisów i zgłoszeń w panelu WP (menu „ELMC 2027").
- `header.php` / `footer.php` / `front-page.php` / `page.php` / `index.php` — szablony.
- `teaser.php` — strona tymczasowa (zapowiedź) na elmc.eu przed startem pełnej strony:
  `/zapowiedz/` i `/en/zapowiedz/`; `ELMC2027_TEASER_FRONT = true` robi z niej stronę główną.
- `parts/` — sekcje wspólne dla pełnej strony i zapowiedzi (hero z zapisem, fakty, hasło,
  o kongresie, poprzednie edycje). Zmiana tu zmienia obie strony.
- `assets/img/` — `kv-elmc.jpg` (mural), `logo-elmc.png`, `logo-elmi.jpg`, `logo-psod.jpg`.

**System wizualny** (z pakietu Claude Design, 19.09.2026): pomarańcz `#E9961F` / `#F3B33D`,
granat `#1F3C8F`, czerń `#111`, ciepłe szarości; fonty **Archivo** (800/700/500/400) i
**Space Mono** (etykiety, liczby); pełnoszerokościowe tła sekcji na przemian, czarne linie
2 px, przyciski-pigułki, **bez cieni, gradientów, ikon i emoji**; puste miejsca na zdjęcia to
przerywane ramki z podpisem. Źródłowy pakiet projektu nie jest w repo — Stefan ma go w
`Downloads` (`ELMC 2027 Homepage Mockups-handoff.zip`).

**Zasada treści:** polski jest oryginałem, angielski to tłumaczenie robocze. Żadnych
wymyślonych nazwisk, zdjęć, dat ani logo — czego nie ma, to zostaje pustą ramką z podpisem
„do uzupełnienia".

## 10. Wdrożenie

`git push` do `main` ze zmianą w `theme/**` uruchamia GitHub Actions
(`.github/workflows/deploy.yml`), które wgrywa motyw przez FTP na `dev.ekmp.pl`
(konto `ligia_ekmp`, sekrety `FTP_SERVER`/`FTP_USERNAME`/`FTP_PASSWORD` w ustawieniach repo).
Repozytorium: `github.com/stefanschwarz-commits/strona-elmc` (publiczne).

Zmiany w bazie i panelu WordPressa **nie** są w repozytorium (strona główna jest ustawiona
w Ustawieniach → Czytanie na stronę „ELMC 2027 — Coming Soon"; jej treść jest ignorowana,
bo `front-page.php` renderuje sekcje z kodu).

Sprawdzenie po wdrożeniu: kod odpowiedzi dla `/` i `/en/`, obecność zmiany w kodzie strony
z pominięciem pamięci podręcznej, brak przewijania w poziomie przy 375 px.
