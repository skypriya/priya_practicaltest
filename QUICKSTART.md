# Quick Start Guide - How to Run the Application

## Step-by-Step Instructions

### Step 1: Set PHP 8.1 (Required)

Open PowerShell or Command Prompt and navigate to the project:

```powershell
cd E:\interview_project\ci4-auth-app
```

**Set PHP 8.1 for this session:**
```powershell
$env:PATH = "E:\wamp64\bin\php\php8.1.26;$env:PATH"
```

**Verify PHP version:**
```powershell
php -v
```
Should show: `PHP 8.1.26`

---

### Step 2: Install Dependencies (If Not Done)

```powershell
composer install --no-interaction
composer require phpoffice/phpspreadsheet dompdf/dompdf --no-interaction
```

---

### Step 3: Configure Environment

**Copy the environment file:**
```powershell
copy env .env
```

**Edit `.env` file** (open in any text editor) and set:
```
app.baseURL = 'http://localhost:8080/'
database.default.hostname = localhost
database.default.database = ci4_auth_app
database.default.username = root
database.default.password = ''
database.default.DBDriver = MySQLi
database.default.port = 3306
```

---

### Step 4: Create Database

**Option A: Using Migrations (Recommended)**
```powershell
php spark migrate
```

**Option B: Import SQL File**
1. Open phpMyAdmin (http://localhost/phpmyadmin)
2. Create database: `ci4_auth_app`
3. Import `database.sql` file

---

### Step 5: Start the Server

```powershell
php spark serve
```

You should see:
```
CodeIgniter development server started on http://localhost:8080
```

---

### Step 6: Access the Application

Open your browser and go to:
```
http://localhost:8080
```

---

## Quick Commands Reference

### Start Server (Every Time)
```powershell
cd E:\interview_project\ci4-auth-app
$env:PATH = "E:\wamp64\bin\php\php8.1.26;$env:PATH"
php spark serve
```

### Or Use the Setup Script
```powershell
cd E:\interview_project\ci4-auth-app
.\setup.ps1
```

---

## First Time Setup Checklist

- [ ] Set PHP 8.1 in PATH
- [ ] Run `composer install`
- [ ] Copy `env` to `.env`
- [ ] Configure database in `.env`
- [ ] Create database (migrate or import SQL)
- [ ] Start server with `php spark serve`
- [ ] Register first user
- [ ] Set user as admin in database

---

## Creating Admin User

After registering, set admin status:

**Via SQL:**
```sql
UPDATE users SET is_admin = 1 WHERE email = 'your-email@example.com';
```

**Via phpMyAdmin:**
1. Go to `users` table
2. Find your user
3. Edit `is_admin` to `1`

---

## Troubleshooting

**"PHP version too low" error:**
- Make sure you set PHP 8.1: `$env:PATH = "E:\wamp64\bin\php\php8.1.26;$env:PATH"`

**"Database connection failed":**
- Check `.env` database settings
- Make sure MySQL is running in WAMP
- Verify database exists

**"Port 8080 already in use":**
- Change port in `.env`: `app.baseURL = 'http://localhost:8081/'`
- Or stop the other service using port 8080

**"Composer not found":**
- Make sure Composer is installed and in PATH
- Or use full path to composer.exe

