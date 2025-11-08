# Installation Instructions

## PHP Version Issue Fix

Your system has PHP 7.4, but CodeIgniter 4 requires PHP 8.1+. Since you're using WAMP, you already have PHP 8.1.26 installed!

## Quick Setup

### Option 1: Use the Setup Script (Recommended)

**PowerShell:**
```powershell
cd E:\interview_project\ci4-auth-app
.\setup.ps1
```

**Command Prompt:**
```cmd
cd E:\interview_project\ci4-auth-app
setup.bat
```

### Option 2: Manual Setup

1. **Set PHP 8.1 for this session:**
   ```powershell
   $env:PATH = "E:\wamp64\bin\php\php8.1.26;$env:PATH"
   ```

2. **Install dependencies:**
   ```bash
   composer install --no-interaction
   composer require phpoffice/phpspreadsheet dompdf/dompdf --no-interaction
   ```

### Option 3: Make PHP 8.1 Default in WAMP

1. Open WAMP Control Panel
2. Click on PHP → Version → Select PHP 8.1.26
3. Restart WAMP services

## Troubleshooting File Locking Issues

If you see "Could not delete" errors during composer install:

1. **Temporarily disable antivirus real-time scanning** for the project folder
2. **Exclude the vendor folder** from Windows Search Indexer
3. **Run as Administrator** (right-click PowerShell/CMD → Run as Administrator)
4. **Close any IDEs** that might have the folder open

## After Installation

1. **Configure environment:**
   ```bash
   copy env .env
   ```
   Edit `.env` and set your database credentials.

2. **Create database:**
   - Import `database.sql` into MySQL, OR
   - Run: `php spark migrate`

3. **Start the server:**
   ```bash
   php spark serve
   ```

4. **Access the app:**
   - Open: http://localhost:8080

## Creating an Admin User

After registering your first user, set them as admin:

```sql
UPDATE users SET is_admin = 1 WHERE email = 'your-email@example.com';
```

Or use the Admin panel's Edit feature (if you already have an admin account).

