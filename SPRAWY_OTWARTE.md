# Sprawy otwarte — strona ELMC 2027

Jedna lista: co czeka, na kogo i dlaczego. Załatwione przekreślamy z datą.

## Czeka na Stefana

- **Test formularza Call for Speakers** — wyślij jedno zgłoszenie ze strony
  (dev.ekmp.pl → sekcja Call for Speakers) i sprawdź, czy mail dotarł na kontakt@ekmp.pl.
  Nie zrobiłem tego sam, bo to wysyłka wiadomości w Twoim imieniu. Przy okazji zobaczysz
  zgłoszenie w panelu WordPressa (menu „ELMC 2027" → Call for Speakers) — to sprawdzi
  wszystko naraz: zapis w bazie, mail i panel.
- **Adres kontaktowy** — na stronie (partnerstwo, stopka, zgłoszenia prelegentów) jest
  `kontakt@ekmp.pl`, tak jak w projekcie. Przy starcie elmc.eu do rozważenia `kontakt@elmc.eu`
  (19.09 ustaliłeś go jako adres tej strony dla spraw RODO). Zmiana to jedno miejsce w kodzie.
- **Teksty do uzupełnienia w projekcie** (z pakietu Claude Design): oficjalna treść misji,
  opis ELMI, opisy poziomów partnerstwa, temat edycji 2027.
- **Materiały do pustych miejsc**: 4 zdjęcia z relacji 2026, 8 prelegentów (nazwiska,
  funkcje, zdjęcia), 7 logo partnerów. Do czasu dostarczenia zostają przerywane ramki.
- **Angielska wersja tekstów** — tłumaczenie robocze, wymaga przejrzenia przez native
  speakera (tak zaznaczono w pakiecie projektowym).

## Czeka na kogoś z zewnątrz

- **Kod celu zgody dla Call for Speakers** — wspólny rejestr zgód ma katalog celów i strona
  nie może wymyślać kodów sama. Zgody ze zgłoszeń prelegentów zapisujemy dziś tylko lokalnie
  (treść + wersja + czas). Po nadaniu kodu (np. przez osobę prowadzącą bazę) dopiąć
  przekazywanie, tak jak przy zapisach na powiadomienia.
- **Alias kontakt@ekmp.pl** — czy istnieje i do której skrzynki trafia (dopisane do listy
  sprawdzeń w panelu Microsoft 365 we wspólnym repo RODO, 19.09.2026).
- **Wektorowe logo ELMC (SVG)** — dziś mamy tylko PNG; potrzebne do druku i ostrych ekranów.

## Do zrobienia po stronie kodu

- **Polska wersja informacji o danych** — strona „Privacy notice" jest po angielsku, a zgoda
  przy polskim formularzu linkuje właśnie do niej. Treść prawna czeka na prawnika (koniec
  projektu), więc na razie zostaje jak jest.
- **Fonty z Google Fonts** — ładowane z serwerów Google. Do rozważenia hosting własny
  (RODO / szybkość). Pakiet projektowy nie zawiera plików .woff2.
- **Nawigacja na telefonie** — poniżej 1100 px linki sekcji są ukryte (zostaje logo, PL/EN
  i przycisk zapisu). Projekt nie definiuje wersji mobilnej; jeśli ma być menu, trzeba je
  zaprojektować.
- **Przekierowanie elmc.eu** — strona docelowo ma stać pod elmc.eu (dziś przekierowanie na
  labourinstitute.eu przez `.htaccess`). Osobny krok, wymaga DNS/Cloudflare i decyzji o dacie.
- **Zagadka `elmc.eu/2019/`** — mimo wykluczenia w `.htaccess` adres nadal przekierowuje.
  Do zbadania przed przepięciem domeny (podejrzenie: wtyczka Redirection w osieroconej
  instalacji WP pod `public_html/elmc.eu/`).
