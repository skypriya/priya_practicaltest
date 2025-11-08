# How to Switch PHP Version in WAMP

## You Already Have PHP 8.1!

WAMP already has PHP 8.1.26 installed at: `E:\wamp64\bin\php\php8.1.26`

You just need to **switch** to it, not upgrade!

---

## Method 1: Using WAMP Control Panel (Recommended)

1. **Right-click** on the WAMP icon in your system tray (bottom-right corner)
2. Click on **PHP**
3. Click on **Version**
4. Select **php8.1.26** from the list
5. WAMP will automatically restart Apache
6. Done! ✅

---

## Method 2: Verify It's Switched

After switching, verify in a new terminal:

```powershell
php -v
```

Should show: `PHP 8.1.26`

---

## Method 3: Check Available PHP Versions

To see all PHP versions installed in WAMP:

1. Navigate to: `E:\wamp64\bin\php\`
2. You should see folders like:
   - `php7.4.33`
   - `php8.0.30`
   - `php8.1.26` ✅
   - `php8.2.13`
   - `php8.3.0`

---

## If PHP 8.1 is NOT in the List

If you don't see `php8.1.26` in the WAMP menu:

1. **Download PHP 8.1** from: https://windows.php.net/downloads/releases/
   - Download: `php-8.1.26-Win32-vs16-x64.zip` (Thread Safe version)
   
2. **Extract** the zip file

3. **Copy** the extracted folder to: `E:\wamp64\bin\php\`
   - Rename it to: `php8.1.26`

4. **Restart WAMP**

5. **Switch to PHP 8.1** using Method 1 above

---

## After Switching

Once you've switched to PHP 8.1:

1. **Close all terminal windows**
2. **Open a new terminal**
3. Run: `php -v` (should show 8.1.26)
4. Navigate to your project: `cd E:\interview_project\ci4-auth-app`
5. Run: `php spark serve`

No need to set PATH anymore! 🎉

---

## Troubleshooting

**If WAMP doesn't start after switching:**
- Check Apache error logs: `E:\wamp64\logs\apache_error.log`
- Make sure all required PHP extensions are enabled in `php.ini`

**If you still see PHP 7.4:**
- Make sure you closed and reopened your terminal
- Check: `where php` (should point to WAMP's PHP 8.1)
- Restart your computer if needed

