# strona-elmc — kontekst projektu

Ten plik jest wczytywany automatycznie przez każdą sesję Claude Code otwartą w tym repo.

**Ten plik jest inny niż w pozostałych 3 projektach: repo lokalne jest technicznie puste**
(tylko `.gitignore`, `wyslij.ps1`/`pobierz.ps1` — brak kodu WordPressa), ale **na serwerze
hostingowym trwa już realna, zaawansowana praca infrastrukturalna** nad uruchomieniem
elmc.eu jako prawdziwej strony. Treść poniżej zrekonstruowana z surowego transkryptu sesji
(nie było tu wcześniej żadnej pamięci/notatek) — traktuj to jako punkt startowy, nie jako
pełny, aktualny na bieżąco log. **Stefan miewa otwarte równolegle inne sesje Claude Code w
tym folderze — zawsze sprawdź aktualny stan serwera/skrzynki, zanim założysz, że coś poniżej
wciąż jest aktualne.**

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
- **NIEROZWIĄZANA ZAGADKA (flagowana, nie wyjaśniona):** mimo tego wykluczenia, `elmc.eu/2019/`
  nadal 301-przekierowuje na `www.ekmp.pl` zamiast pokazać prawdziwe archiwum 2019 — sprawdzone
  dwa razy, także po ręcznym wyczyszczeniu cache Cloudflare dla ścieżek `elmc.eu/2013`...`2023`.
  Podejrzenie: wtyczka **"Redirection"** zainstalowana w osieroconej instalacji WP pod
  `public_html/elmc.eu/` ma własne reguły w bazie, niezależne od `.htaccess`; ewentualnie
  kolejność reguł Apache. **Do zbadania przed poleganiem na `.htaccess` jako jedynym źródle
  prawdy o przekierowaniach.**
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

## 6. Blokada na koniec ostatniej sesji (stan prawdopodobnie wciąż nierozwiązany)

- Uruchomiono autoinstalator WordPressa dla `dev.ekmp.pl` (tytuł "European Labour Mobility
  Congress (ELMC)", user `elmc-admin`, mail `stefan.schwarz@krupowki9.pl`) — **instalacja
  nigdy się nie ukończyła.**
- Blokada: `dev.ekmp.pl` pokazywał **PHP 7.3** (WordPress wymaga ≥7.4). Zmieniono w panelu na
  8.2 i zapisano (potwierdzone zapisane po nieudanej pierwszej próbie) — ale autoinstalator
  **nadal** przez >50 minut zgłaszał błąd o PHP 7.3.27 — niewyjaśnione, czy to bug hostingu,
  cache, czy osobny pool PHP-FPM wymagający restartu.
- Zgłoszenie do wsparcia CyberFolks ("Zmiana wersji PHP nie jest stosowana dla subdomeny
  dev.ekmp.pl", 2026-07-05 14:40, obsługuje Marcin Stanaszek) doprowadziło do odkrycia, że
  **usługa `imphost` może być zarejestrowana pod INNYM kontem klienckim CyberFolks niż to, na
  które zalogowany jest Stefan** — mimo że `stefan.schwarz@labourinstitute.eu` jest
  autoryzowany w panelu, którym się loguje, CyberFolks twierdzi że nie jest autoryzowany dla
  konkretnie usługi `imphost`. Wysłano (potwierdzone przez Stefana) drugiego maila do Dawida z
  pytaniem, pod jakim kontem klienckim faktycznie figuruje `imphost`.
- **Sesja urwała się w trakcie pętli** sprawdzania co ~10 minut, czy PHP się zmienił / czy
  Dawid odpowiedział. **Sprawdź aktualny stan PHP na `dev.ekmp.pl` i odpowiedź Dawida, zanim
  cokolwiek zakładasz** — to najbardziej prawdopodobne miejsce, gdzie realnie trzeba
  kontynuować.

## 7. Kontakt zewnętrzny: Dawid

**Dawid Sierży** (`d.sierzy@microlab.pl`, też widziany jako `dawid@sierzy.pl`) — zewnętrzny
kontakt IT dla ELMI, kontroluje konto Cloudflare i pierwotnie skonfigurował przekierowania w
`.htaccess`. Prawdopodobnie też kontroluje/wie, pod jakim kontem klienckim CyberFolks
faktycznie widnieje usługa `imphost` (patrz §6). Dwa maile do niego w tej sesji: (1) o dostęp
do Cloudflare — **przyznany**, (2) o konto CyberFolks dla `imphost` — **wysłany, bez
potwierdzonej odpowiedzi na koniec transkryptu.**

## 8. Zasady współpracy zespołowej

Pełny, przenośny rdzeń: `C:\Projekty\_zasady-wspolpracy-zespolowej.md`. Kluczowe punkty
(dopóki nie ma tu jeszcze żadnego kodu, głównie na przyszłość):
- **Stefan nie przegląda diffów kodu** (uniwersalny fakt) — nie prosić o code review, działać
  i podsumowywać słownie, pytać tylko o decyzje biznesowe/dostępowe.
- **Dostęp serwerowy tutaj = dostęp do całego zestawu domen z §3** — najbardziej rozległy
  potwierdzony przypadek z całego portfela.
- **Nie uwierzytelniać się jako użytkownik nawet ze znanym hasłem** (§5) — Stefan loguje/
  autoryzuje się sam do paneli/kont trzecich (Cloudflare, CyberFolks, Dropbox w innych
  projektach, itp.) — to spójna zasada w całym portfelu, nie tylko tutaj.
- Gdy tu w końcu powstanie kod WordPressa (nowa instalacja dla ELMC 2027) — dopisać resztę
  sekcji (system projektowy, architektura) analogicznie do `strona-elmi`.
