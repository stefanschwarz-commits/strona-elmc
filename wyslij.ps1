# =====================================================================
#  WYSLIJ - zapisuje biezaca wersje kodu i wysyla ja do chmury (GitHub)
#  Uzycie: kliknij prawym -> "Uruchom w programie PowerShell"
#          albo w terminalu:  .\wyslij.ps1
# =====================================================================
Set-Location "C:\Projekty\strona-elmc"

git add -A

# Commit tylko jesli sa jakies zmiany
$zmiany = git status --porcelain
if ($zmiany) {
    $data = Get-Date -Format "yyyy-MM-dd HH:mm"
    git commit -m "Zapis $data"
} else {
    Write-Host "Brak nowych zmian do zapisania."
}

Write-Host "Wysylam do chmury..."
git push

Write-Host ""
Write-Host "Gotowe. Nacisnij Enter, aby zamknac."
Read-Host
