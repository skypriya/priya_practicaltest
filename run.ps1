# Quick Run Script - Sets PHP 8.1 and starts the server
# Double-click this file or run: .\run.ps1

Write-Host "Setting PHP 8.1.26..." -ForegroundColor Green
$env:PATH = "E:\wamp64\bin\php\php8.1.26;$env:PATH"

Write-Host "Current PHP version:" -ForegroundColor Cyan
php -v

Write-Host "`nVerifying PHP version..." -ForegroundColor Cyan
$phpVersion = php -r "echo PHP_VERSION;"
$versionCheck = php -r "if (version_compare(PHP_VERSION, '8.0.0', '<')) { exit(1); } else { exit(0); }"

if ($LASTEXITCODE -ne 0) {
    Write-Host "ERROR: PHP 8.0+ required! Current: $phpVersion" -ForegroundColor Red
    Write-Host "Please make sure PHP 8.1 is available at: E:\wamp64\bin\php\php8.1.26" -ForegroundColor Yellow
    Read-Host "Press Enter to exit"
    exit 1
}

Write-Host "PHP version OK: $phpVersion" -ForegroundColor Green

Write-Host "`nStarting CodeIgniter 4 server..." -ForegroundColor Green
Write-Host "Press Ctrl+C to stop the server`n" -ForegroundColor Yellow

# Navigate to project directory
Set-Location $PSScriptRoot

Write-Host "Current directory: $PWD" -ForegroundColor Cyan
Write-Host ""

# Start the server
php spark serve

