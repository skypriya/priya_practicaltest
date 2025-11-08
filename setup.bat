@echo off
REM Setup script for CI4 Auth App
REM This script sets PHP 8.1 and installs dependencies

echo Setting PHP 8.1.26...
set PATH=E:\wamp64\bin\php\php8.1.26;%PATH%

echo.
echo Checking PHP version...
php -v

echo.
echo Installing CodeIgniter 4 dependencies...
composer install --no-interaction

echo.
echo Installing Excel and PDF export libraries...
composer require phpoffice/phpspreadsheet dompdf/dompdf --no-interaction

echo.
echo Setup complete! Next steps:
echo 1. Copy 'env' to '.env' and configure database settings
echo 2. Run: php spark migrate
echo 3. Run: php spark serve

pause

