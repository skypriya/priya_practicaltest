<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Password reset</title>
</head>
<body>
  <p>Hello <?= esc($name) ?>,</p>
  <p>We received a request to reset your password. Click the link below to reset it. This link will expire soon.</p>
  <p><a href="<?= esc($resetUrl) ?>"><?= esc($resetUrl) ?></a></p>
  <p>If you didn't request this, ignore this email.</p>
  <p>Thanks,<br>Your App Team</p>
</body>
</html>
