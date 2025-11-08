<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <h3 class="mb-3">Login</h3>
    <?php if (session('error')): ?><div class="alert alert-danger"><?= esc(session('error')) ?></div><?php endif; ?>
    <?php if (session('success')): ?><div class="alert alert-success"><?= esc(session('success')) ?></div><?php endif; ?>
    <form id="loginForm" method="post">
      <?= csrf_field() ?>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required minlength="6">
      </div>
      <div class="d-flex align-items-center gap-2">
        <button class="btn btn-primary" type="submit">Login</button>
        <a href="/forgot">Forgot Password?</a>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function(){
  $("#loginForm").validate();
});
</script>
<?= $this->endSection() ?>


