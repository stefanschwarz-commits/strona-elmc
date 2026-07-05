# =====================================================================
#  POBIERZ - sciaga z chmury najnowsza wersje kodu
#  Uruchom to na POCZATKU pracy, zwlaszcza na drugim komputerze.
#  Uzycie: kliknij prawym -> "Uruchom w programie PowerShell"
#          albo w terminalu:  .\pobierz.ps1
# =====================================================================
Set-Location "C:\Projekty\strona-elmc"

Write-Host "Pobieram najnowsza wersje z chmury..."
git pull

Write-Host ""
Write-Host "Gotowe. Nacisnij Enter, aby zamknac."
Read-Host
