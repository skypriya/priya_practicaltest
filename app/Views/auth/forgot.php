<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <h3 class="mb-3">Forgot Password</h3>
    <?php if (session('success')): ?><div class="alert alert-success"><?= esc(session('success')) ?></div><?php endif; ?>
    <form id="forgotForm" method="post">
      <?= csrf_field() ?>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <button class="btn btn-primary" type="submit">Send Reset Link</button>
    </form>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function(){
  $("#forgotForm").validate();
});
</script>
<?= $this->endSection() ?>


