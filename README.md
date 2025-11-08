# CI4 (Interview Project)

This is a CodeIgniter 4 application implementing:

- Authentication: Login, Registration, Forgot Password
- User fields: First Name, Last Name, Email, Date of Birth, Gender, Address, Profile Picture (with cropping), Signature (via plugin)
- jQuery validations on forms
- Admin panel: list users with View / Edit / Delete
- Export to Excel (PhpSpreadsheet) and Export to PDF (Dompdf)
- Bootstrap 5 responsive UI

## Setup

1) Requirements

- PHP 8.1+
- Composer
- MySQL 5.7+/8.0+

2) Install dependencies

``Check Php Version
php -v
version should be 8.1

```bash
composer install
composer require phpoffice/phpspreadsheet:^1.29 dompdf/dompdf:^2.0
```

3) Environment

- Change .env  and adjust values (database and baseURL):

```bash
cp env .env # On Windows, copy via Explorer or: copy env .env
```

Edit `.env`:

```
app.baseURL = 'http://localhost:8080/'
database.default.hostname = localhost
database.default.database =  priya_practicaltest
database.default.username = root
database.default.password = ''
database.default.DBDriver = MySQLi
database.default.port = 3306
security.CSRFProtection = true
```

4) Database

Option A: Run migrations

```bash
php spark migrate
```

5) Run the app

```bash
php spark serve
```

Visit `http://localhost:8080`

