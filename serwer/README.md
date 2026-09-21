# Skrypty na serwerze (konto imphost) — kopie do wglądu

Działające egzemplarze leżą w `~/bin/` na serwerze. Po zmianie tutaj trzeba je tam wgrać.

- `elmc-motyw-na-produkcje.sh` — kopiuje motyw z placu budowy (dev.ekmp.pl) na elmc.eu
  (`public_html/ekmp.pl/2027`). Uruchamiany ręcznie po sprawdzeniu zmiany na dev.
- `sprawdz-elmc.php` — cotygodniowa kontrola (cron: poniedziałek 7:30): strona w obu językach,
  informacja o danych, przekierowanie ekmp.pl, 8 archiwów kongresów, mural, logo, fonty.
  Mail z claude@labourinstitute.eu do Stefana tylko przy problemie. Log: `~/sprawdzanie/elmc.log`.
  Ręcznie: `php8.1 ~/bin/sprawdz-elmc.php --pokaz`.
