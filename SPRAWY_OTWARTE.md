# Sprawy otwarte — strona ELMC 2027

Jedna lista: co czeka, na kogo i dlaczego. Załatwione przekreślamy z datą.

## Czeka na Stefana

- ~~**Logo ELMC w wersji wektorowej**~~ — wdrożone 20.09.2026 (nagłówek czarne, stopka białe).
- **Test formularza Call for Speakers** — wyślij jedno zgłoszenie ze strony
  (dev.ekmp.pl → sekcja Call for Speakers) i sprawdź, czy mail dotarł na kontakt@elmc.eu.
  Nie zrobiłem tego sam, bo to wysyłka wiadomości w Twoim imieniu. Przy okazji zobaczysz
  zgłoszenie w panelu WordPressa (menu „ELMC 2027" → Call for Speakers) — to sprawdzi
  wszystko naraz: zapis w bazie, mail i panel.
- ~~**Adres kontaktowy**~~ — 20.09.2026 zmieniony na `kontakt@elmc.eu` (decyzja Stefana);
  do sprawdzenia próbnym zgłoszeniem, czy skrzynka odbiera.
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
- ~~**Wektorowe logo ELMC (SVG)**~~ — zrobione 20.09.2026.

## Do zrobienia po stronie kodu

- **Polska wersja informacji o danych** — strona „Privacy notice" jest po angielsku, a zgoda
  przy polskim formularzu linkuje właśnie do niej. Treść prawna czeka na prawnika (koniec
  projektu), więc na razie zostaje jak jest.
- ~~**Fonty z Google Fonts**~~ — 20.09.2026 przeniesione na własny serwer (Archivo zmienny
  400–900 i Space Mono 400/700, latin + latin-ext, licencja SIL OFL 1.1). Sprawdzone: zero
  połączeń z serwerami Google przy wejściu na stronę.
- ~~**Nawigacja na telefonie**~~ — 20.09.2026 dodane rozwijane „Menu” poniżej 1100 px
  (bez JavaScriptu), panel na całą szerokość pod nagłówkiem.
- ~~**Przekierowanie elmc.eu**~~ — zrobione 20.09.2026: elmc.eu pokazuje stronę tymczasową,
  ekmp.pl przekierowuje na elmc.eu, wszystkie archiwa działają pod obiema domenami.
- **Certyfikat SSL dla dev.ekmp.pl wygasł** — plac budowy działa tylko bez „https”. Do odnowienia
  w panelu (wymaga logowania Stefana).
- **Własna baza danych dla elmc.eu** — dziś strona produkcyjna używa tabel z przedrostkiem `elmc_`
  w bazie placu budowy. Działa i jest w nocnych kopiach; rozdzielić, gdy Stefan założy bazę w panelu.
- **Podejrzane konto `davanderson`** (rejestracja z 2022 r., adres `emalupe.com`) w bazie placu
  budowy — bez uprawnień, ale do usunięcia przy porządkach.
- ~~**Zagadka `elmc.eu/2019/`**~~ — wyjaśniona 19.09.2026: to nie wtyczka, tylko reguła
  „Przekierowanie zamówione przez Dominika" w `.htaccess` roczników **2013, 2017 i 2019**
  (`public_html/ekmp.pl/<rok>/.htaccess`): adres z domeną elmc.eu idzie na `www.ekmp.pl/`,
  a stamtąd na labourinstitute.eu/ekmp2025. Pozostałe roczniki pod elmc.eu działają
  (2014, 2015, 2016, 2022 po angielsku; 2023 pokazuje wersję polską). Do decyzji przy
  przepinaniu domeny, czy te trzy reguły zostają.
- **Decyzja Stefana 19.09.2026: elmc.eu jest domeną główną**, ekmp.pl przekierowuje na
  polską wersję elmc.eu (obie domeny działają, archiwa pod starymi adresami zostają).
- ~~**Strona tymczasowa na elmc.eu**~~ — zaakceptowana i opublikowana 20.09.2026.
- ~~**Przekierowania elmc.eu i ekmp.pl wskazują edycję 2025**~~ — nieaktualne od 20.09.2026.

## Archiwa kongresów — incydent 19.09.2026

Wątek „uporządkuj i zaktualizuj domeny na koncie WebAs" o 20:35 zamknął (403) wszystkie
roczniki `ekmp.pl/2013`–`2023` z dopiskiem „decyzja Stefana". Stefan: to nie była jego
decyzja — kazał zamknąć tylko strony-śmietnik. Tamten wątek sam przywrócił pliki
(stan sprzed zmiany); sprawdzone o 21:14: **8 z 8 roczników ekmp.pl odpowiada 200**
z właściwymi tytułami. `arch.inicjatywa.eu` i `old.inicjatywa.eu` (stare strony
Inicjatywy Mobilności Pracy — dawna nazwa stowarzyszenia) **zostają zamknięte — decyzja
Stefana 19.09.2026**; pliki i bazy zostają na serwerze.

## Wyszukiwarki (22.09.2026)

- **Google Search Console dla elmc.eu** — własność potwierdzona (usługa typu „Domena”, konto Google Stefana),
  mapa strony https://elmc.eu/wp-sitemap.xml przesłana, stan „Sukces”. Dane o ruchu pojawią się po kilku dniach.
- **Cloudflare wyczyszczony dla elmc.eu** — robots.txt był zapamiętany od ok. 8 dni jako przekierowanie
  na stronę 2025 i blokował pobranie mapy. **Dla ekmp.pl jeszcze nie** (Stefan: Edge → dash.cloudflare.com →
  ekmp.pl → Caching → Configuration → Purge Everything) — do tego czasu www.ekmp.pl/robots.txt pokazuje starą wersję.
- **ekmp.pl ma własny robots.txt** (`public_html/ekmp.pl/robots-ekmp.txt`, reguła w `.htaccess`): pozwala Google
  czytać archiwa. Kopia .htaccess sprzed zmiany: `~/kwarantanna-20260913/elmc-przepiecie-20260920/ekmp.pl-htaccess-przed-robots-20260922`.
- **Prośba o indeksowanie strony głównej** w Search Console — nie wykonana (przeglądarka w aplikacji nie rysowała
  strony); niekonieczna, Google odwiedzi stronę z mapy.

## Poczta ze strony (23.09.2026)

- **Maile ze strony idą przez Microsoft 365, nie z serwera hostingu.** Test 23.09 pokazał, że
  wiadomość wysłana przez WordPressa z serwera CyberFolks nie dociera: domena elmc.eu ma SPF
  dopuszczający tylko Microsoft. Kod: `theme/inc/mail.php`, dane aplikacji w `wp-config.php`
  (`ELMC2027_GRAPH_*`). Nadawca tymczasowy: **claude@labourinstitute.eu**, podpis „European Labour
  Mobility Congress”.
- **Do zrobienia, gdy powstanie skrzynka kontakt@elmc.eu** (Stefan: 24.09): zmienić
  `ELMC2027_GRAPH_SENDER` w wp-config na kontakt@elmc.eu i powtórzyć próbny zapis. Dziś ten adres
  nie istnieje w Microsoft 365 jako skrzynka (sprawdzone), więc zgłoszenia prelegentów i pytania
  o partnerstwo mogą nie dochodzić.
- **Test na produkcji 23.09**: zapis → mail w 2 sekundy → potwierdzenie → wypis, wszystko działa;
  wiersz testowy usunięty z bazy. **Uwaga:** rejestr zgód działa tu w trybie „produkcja”, więc
  zdarzenia testowe (zapis i wycofanie zgody dla claude@labourinstitute.eu) mogły trafić do rejestru
  — do usunięcia przez osobę prowadzącą bazę.
