# Motyw ELMC 2027

Klasyczny (nie blokowy) motyw WordPress dla `dev.ekmp.pl`.

## Struktura

- `style.css` — nagłówek motywu (wymagany przez WP) + wszystkie style.
- `functions.php` — konfiguracja motywu, rejestracja menu, zapis zgłoszeń e-mail.
- `header.php` / `footer.php` — wspólny nagłówek i stopka.
- `front-page.php` — strona główna (hero + formularz zapisu na powiadomienia).
- `page.php` — zwykłe podstrony.
- `index.php` — fallback (blog/archiwa/wyszukiwanie).
- `assets/img/elmc-hero.jpg` — grafika hero.

## Zapisy e-mail

Formularz na stronie głównej zapisuje adresy do własnej tabeli w bazie
(`wp_elmc2027_subscribers`) — tymczasowe rozwiązanie, do podmiany na
docelowy serwis (Mailchimp/Brevo/inny) gdy zostanie wybrany.

**Uwaga:** tabela tworzy się przy aktywacji motywu w Wygląd → Motywy.
Po pierwszym wdrożeniu tego kodu trzeba **aktywować motyw "ELMC 2027"**
w panelu WordPressa (Wygląd → Motywy), żeby zadziałał.

## Wdrożenie

Ten katalog jest automatycznie wdrażany przez GitHub Actions
(`.github/workflows/deploy.yml`) na serwer, do katalogu
`public_html/dev.ekmp.pl/wp-content/themes/elmc2027`, przy każdym pushu
do gałęzi `main`.
