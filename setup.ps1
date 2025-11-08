# Setup script for CI4 Auth App
# This script sets PHP 8.1 and installs dependencies

Write-Host "Setting PHP 8.1.26..." -ForegroundColor Green
$env:PATH = "E:\wamp64\bin\php\php8.1.26;$env:PATH"

Write-Host "Checking PHP version..." -ForegroundColor Green
php -v

Write-Host "`nInstalling CodeIgniter 4 dependencies..." -ForegroundColor Green
composer install --no-interaction

Write-Host "`nInstalling Excel and PDF export libraries..." -ForegroundColor Green
composer require phpoffice/phpspreadsheet dompdf/dompdf --no-interaction

Write-Host "`nSetup complete! Next steps:" -ForegroundColor Yellow
Write-Host "1. Copy 'env' to '.env' and configure database settings" -ForegroundColor Cyan
Write-Host "2. Run: php spark migrate" -ForegroundColor Cyan
Write-Host "3. Run: php spark serve" -ForegroundColor Cyan

