# CI4 Auth App (Interview Project)

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

```bash
composer install
composer require phpoffice/phpspreadsheet:^1.29 dompdf/dompdf:^2.0
```

3) Environment

- Copy `env` to `.env` and adjust values (database and baseURL):

```bash
cp env .env # On Windows, copy via Explorer or: copy env .env
```

Edit `.env`:

```
app.baseURL = 'http://localhost:8080/'
database.default.hostname = localhost
database.default.database = ci4_auth_app
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

Option B: Import SQL dump (creates DB and `users` table): `database.sql`

5) Run the app

```bash
php spark serve
```

Visit `http://localhost:8080`

## Notes

- Profile picture cropping uses Cropper.js (CDN). The current implementation stores the uploaded image; to persist the cropped version on the server, extend the controller to accept cropped canvas data and save it.
- Signature uses jSignature (CDN) and saves a base64 PNG into `writable/uploads/signatures`.
- Exports require the Composer packages listed above.
- Admin guard is simplified; mark a user as admin via DB or the Admin Edit screen.

## SourceTree

- Clone/open the repo in SourceTree, set your remotes (GitHub/Bitbucket), and push.


## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
