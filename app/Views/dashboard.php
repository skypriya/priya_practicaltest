<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="p-4 bg-light rounded">
  <h3 class="mb-2">Welcome, <?= esc($user['name'] ?? 'User') ?></h3>
  <p class="mb-0">You're logged in.</p>
</div>
<?= $this->endSection() ?>


