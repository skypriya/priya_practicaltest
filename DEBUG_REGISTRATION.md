# Debug Registration Issue

## Steps to Debug

### 1. Check Browser Console
Open Developer Tools (F12) → Console tab and look for:
- "Form submit handler called - validation passed"
- Any JavaScript errors

### 2. Check Server Logs
Check the log file: `writable/logs/log-YYYY-MM-DD.log`

Look for:
- "Registration POST received"
- Any database errors
- Any validation errors

### 3. Check Database Connection
Make sure:
- Database exists: `ci4_auth_app` (or `interview_project` based on your .env)
- Table `users` exists
- Database credentials in `.env` are correct

### 4. Test Database Connection
Run this in terminal:
```powershell
cd E:\interview_project\ci4-auth-app
$env:PATH = "E:\wamp64\bin\php\php8.1.26;$env:PATH"
php spark db:table users
```

### 5. Check Form Submission
1. Fill out the form
2. Open Network tab in Developer Tools (F12)
3. Submit the form
4. Check if POST request is sent to `/register`
5. Check the response

### 6. Common Issues

**Issue: Form not submitting**
- Check if jQuery validation is blocking
- Check console for JavaScript errors
- Try disabling JavaScript temporarily

**Issue: Database error**
- Check `.env` database settings
- Verify database exists
- Check if table exists: `php spark migrate:status`

**Issue: CSRF token error**
- Check if CSRF protection is enabled in `.env`
- Clear browser cache
- Try in incognito mode

**Issue: Validation failing silently**
- Check error messages at top of form
- Check server logs for validation errors

### 7. Quick Test
Try registering with minimal data:
- First Name: Test
- Last Name: User
- Email: test@example.com
- Password: test123

If this works, the issue is with specific field validation.

