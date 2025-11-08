# START HERE - How to Fix "Could not open input file: spark"

## The Problem
You're getting: `Could not open input file: spark`

## The Solution

### Step 1: Open PowerShell
Press `Win + X` → Select "Windows PowerShell" or "Terminal"

### Step 2: Navigate to Project Directory
```powershell
cd E:\interview_project\ci4-auth-app
```

### Step 3: Set PHP 8.1
```powershell
$env:PATH = "E:\wamp64\bin\php\php8.1.26;$env:PATH"
```

### Step 4: Verify You're in the Right Place
```powershell
pwd
```
Should show: `E:\interview_project\ci4-auth-app`

### Step 5: Verify PHP Version
```powershell
php -v
```
Should show: `PHP 8.1.26`

### Step 6: Run Spark (Use `php spark`, NOT just `spark`)
```powershell
php spark serve
```

---

## Common Mistakes

❌ **Wrong:** Running `spark` directly
```powershell
spark serve  # This won't work!
```

✅ **Correct:** Using `php spark`
```powershell
php spark serve  # This works!
```

❌ **Wrong:** Not in the project directory
```powershell
PS C:\Users\YourName> php spark serve  # Wrong directory!
```

✅ **Correct:** In the project directory
```powershell
PS E:\interview_project\ci4-auth-app> php spark serve  # Correct!
```

---

## Quick Fix - Copy & Paste This:

```powershell
cd E:\interview_project\ci4-auth-app
$env:PATH = "E:\wamp64\bin\php\php8.1.26;$env:PATH"
php spark serve
```

---

## Or Use the Batch File

Just **double-click** `run.bat` in the project folder - it does everything automatically!

