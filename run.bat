@echo off
REM Quick Run Script - Sets PHP 8.1 and starts the server
REM Double-click this file to run

echo Setting PHP 8.1.26...
set PATH=E:\wamp64\bin\php\php8.1.26;%PATH%

echo.
echo Current PHP version:
php -v

echo.
echo Verifying PHP version...
php -r "if (version_compare(PHP_VERSION, '8.0.0', '<')) { echo 'ERROR: PHP 8.0+ required! Current: ' . PHP_VERSION . PHP_EOL; exit(1); } else { echo 'PHP version OK: ' . PHP_VERSION . PHP_EOL; }"

if errorlevel 1 (
    echo.
    echo ERROR: Wrong PHP version detected!
    echo Please make sure PHP 8.1 is available at: E:\wamp64\bin\php\php8.1.26
    pause
    exit /b 1
)

echo.
echo Starting CodeIgniter 4 server...
echo Press Ctrl+C to stop the server
echo.

cd /d "%~dp0"
echo Current directory: %CD%
echo.
php spark serve

pause

