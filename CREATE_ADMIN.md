# Create Default Admin User

## Option 1: Using Seeder (Recommended)

Run the seeder command:

```powershell
cd E:\interview_project\ci4-auth-app
$env:PATH = "E:\wamp64\bin\php\php8.1.26;$env:PATH"
php spark db:seed AdminUserSeeder
```

**Default Admin Credentials:**
- **Email:** `admin@example.com`
- **Password:** `admin123`

⚠️ **IMPORTANT:** Change the password after first login!

---

## Option 2: Using SQL

If you imported the `database.sql` file, the admin user is already created.

**Default Admin Credentials:**
- **Email:** `admin@example.com`
- **Password:** `admin123`

---

## Option 3: Manual SQL Insert

Run this SQL in phpMyAdmin or MySQL:

```sql
INSERT INTO `users` (`first_name`, `last_name`, `email`, `password_hash`, `is_admin`, `created_at`, `updated_at`) 
VALUES ('Admin', 'User', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, NOW(), NOW());
```

**Default Admin Credentials:**
- **Email:** `admin@example.com`
- **Password:** `admin123`

---

## Option 4: Register and Update

1. Register a new user through the registration form
2. Run this SQL to make them admin:

```sql
UPDATE users SET is_admin = 1 WHERE email = 'your-email@example.com';
```

---

## Verify Admin User

After creating the admin user, you can:

1. **Login** at: http://localhost:8080/login
2. Use credentials: `admin@example.com` / `admin123`
3. You should see the **Admin** link in the navigation menu
4. Access the admin panel at: http://localhost:8080/admin

---

## Change Admin Password

After logging in, you can change the password by:

1. Going to Admin Panel → Edit User
2. Or run this SQL (replace with your new password hash):

```sql
UPDATE users 
SET password_hash = '$2y$10$YOUR_NEW_PASSWORD_HASH_HERE' 
WHERE email = 'admin@example.com';
```

To generate a new password hash, you can use PHP:

```php
<?php
echo password_hash('your_new_password', PASSWORD_DEFAULT);
?>
```

