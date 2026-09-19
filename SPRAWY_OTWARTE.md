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
- ~~**Zagadka `elmc.eu/2019/`**~~ — wyjaśniona 19.09.2026: to nie wtyczka, tylko reguła
  „Przekierowanie zamówione przez Dominika" w `.htaccess` roczników **2013, 2017 i 2019**
  (`public_html/ekmp.pl/<rok>/.htaccess`): adres z domeną elmc.eu idzie na `www.ekmp.pl/`,
  a stamtąd na labourinstitute.eu/ekmp2025. Pozostałe roczniki pod elmc.eu działają
  (2014, 2015, 2016, 2022 po angielsku; 2023 pokazuje wersję polską). Do decyzji przy
  przepinaniu domeny, czy te trzy reguły zostają.
- **Strona tymczasowa na elmc.eu** — gotowa na placu budowy: http://dev.ekmp.pl/zapowiedz/
  i http://dev.ekmp.pl/en/zapowiedz/ (19.09.2026). Czeka na akceptację wyglądu przez Stefana.
  Potem: przepięcie elmc.eu (osobna instalacja WP albo przeniesienie tej, reguły w
  `public_html/ekmp.pl/.htaccess` od Dawida, Cloudflare). Na docelowym serwerze wystarczy
  `define( 'ELMC2027_TEASER_FRONT', true );`, żeby zapowiedź była stroną główną.
- **Przekierowania elmc.eu i ekmp.pl wskazują edycję 2025** (labourinstitute.eu/…2025),
  choć jest już strona 2026 — nieaktualne niezależnie od ELMC 2027.

## Archiwa kongresów — incydent 19.09.2026

Wątek „uporządkuj i zaktualizuj domeny na koncie WebAs" o 20:35 zamknął (403) wszystkie
roczniki `ekmp.pl/2013`–`2023` z dopiskiem „decyzja Stefana". Stefan: to nie była jego
decyzja — kazał zamknąć tylko strony-śmietnik. Tamten wątek sam przywrócił pliki
(stan sprzed zmiany); sprawdzone o 21:14: **8 z 8 roczników ekmp.pl odpowiada 200**
z właściwymi tytułami. `arch.inicjatywa.eu` i `old.inicjatywa.eu` (stare strony
Inicjatywy Mobilności Pracy — dawna nazwa stowarzyszenia) **zostają zamknięte — decyzja
Stefana 19.09.2026**; pliki i bazy zostają na serwerze.
