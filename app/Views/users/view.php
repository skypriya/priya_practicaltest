<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h3>User Details</h3>
<?php if ($user): ?>
<div class="row g-3">
  <div class="col-md-4">
    <?php if (!empty($user['profile_picture'])): ?>
      <img class="img-thumbnail" src="<?= base_url('/'. $user['profile_picture']) ?>"/>
    <?php endif; ?>
  </div>
  <div class="col-md-8">
    <dl class="row">
      <dt class="col-sm-3">Name</dt><dd class="col-sm-9"><?= esc($user['first_name'].' '.$user['last_name']) ?></dd>
      <dt class="col-sm-3">Email</dt><dd class="col-sm-9"><?= esc($user['email']) ?></dd>
      <dt class="col-sm-3">DOB</dt><dd class="col-sm-9"><?= esc($user['date_of_birth']) ?></dd>
      <dt class="col-sm-3">Gender</dt><dd class="col-sm-9"><?= esc($user['gender']) ?></dd>
      <dt class="col-sm-3">Address</dt><dd class="col-sm-9"><?= esc($user['address']) ?></dd>
    </dl>
    <?php if (!empty($user['signature_image'])): ?>
      <h6>Signature</h6>
      <img class="img-thumbnail" src="<?= base_url('/' . $user['signature_image']) ?>"/>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>
<?= $this->endSection() ?>


