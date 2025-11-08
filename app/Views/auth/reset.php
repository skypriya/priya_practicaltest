<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h3>Reset password</h3>

<?php if (session('error')): ?>
  <div class="alert alert-danger"><?= esc(session('error')) ?></div>
<?php endif; ?>
<?php if (session('success')): ?>
  <div class="alert alert-success"><?= esc(session('success')) ?></div>
<?php endif; ?>

<form method="post" action="<?= site_url('reset-password') ?>">
  <?= csrf_field() ?>
  <input type="hidden" name="selector" value="<?= esc($selector) ?>">
  <input type="hidden" name="token" value="<?= esc($token) ?>">

  <div class="mb-3">
    <label>New password</label>
    <input type="password" name="password" class="form-control" required minlength="6">
  </div>
  <div class="mb-3">
    <label>Confirm new password</label>
    <input type="password" name="password_confirm" class="form-control" required minlength="6">
  </div>
  <button class="btn btn-primary" type="submit">Reset password</button>
</form>
<?= $this->endSection() ?>
