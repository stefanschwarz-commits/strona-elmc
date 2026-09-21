#!/bin/bash
# Kopiuje motyw ELMC 2027 z placu budowy (dev.ekmp.pl) na strone produkcyjna (elmc.eu, katalog 2027).
# GitHub Actions wgrywa motyw tylko na dev; ten skrypt przenosi go dalej po sprawdzeniu.
set -e
SRC=~/public_html/dev.ekmp.pl/wp-content/themes/elmc2027/
DST=~/public_html/ekmp.pl/2027/wp-content/themes/elmc2027/
rsync -a --delete "$SRC" "$DST"
echo "motyw skopiowany: $(date "+%Y-%m-%d %H:%M")"
