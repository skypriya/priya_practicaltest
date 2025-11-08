# Fix: str_starts_with() Error

## The Problem
You're getting: `Call to undefined function str_starts_with()`

This means you're using PHP 7.4, but CodeIgniter 4 requires PHP 8.0+.

## The Solution

### Option 1: Use the Run Scripts (Easiest)

**Double-click `run.bat`** - it automatically sets PHP 8.1 for you!

Or in PowerShell:
```powershell
.\run.ps1
```

### Option 2: Set PHP 8.1 Manually

**In PowerShell:**
```powershell
cd E:\interview_project\ci4-auth-app
$env:PATH = "E:\wamp64\bin\php\php8.1.26;$env:PATH"
php spark serve
```

**In Command Prompt:**
```cmd
cd E:\interview_project\ci4-auth-app
set PATH=E:\wamp64\bin\php\php8.1.26;%PATH%
php spark serve
```

### Option 3: Make PHP 8.1 Default in WAMP

1. Open **WAMP Control Panel**
2. Click on **PHP** → **Version**
3. Select **PHP 8.1.26**
4. Restart WAMP services
5. Close and reopen your terminal

### Verify PHP Version

After setting PHP 8.1, verify it:
```powershell
php -v
```

Should show: `PHP 8.1.26`

## Quick Fix Command

Copy and paste this in PowerShell:

```powershell
cd E:\interview_project\ci4-auth-app; $env:PATH = "E:\wamp64\bin\php\php8.1.26;$env:PATH"; php -v; php spark serve
```

This will:
1. Navigate to project
2. Set PHP 8.1
3. Show PHP version
4. Start the server

