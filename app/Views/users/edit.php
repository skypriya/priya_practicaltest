<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h3>Edit User</h3>
<form method="post">
  <?= csrf_field() ?>
  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">First Name</label>
      <input class="form-control" name="first_name" value="<?= esc($user['first_name']) ?>" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Last Name</label>
      <input class="form-control" name="last_name" value="<?= esc($user['last_name']) ?>" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="email" class="form-control" name="email" value="<?= esc($user['email']) ?>" required>
    </div>
    <div class="col-md-3">
      <label class="form-label">DOB</label>
      <input type="date" class="form-control" name="date_of_birth" value="<?= esc($user['date_of_birth']) ?>">
    </div>
    <div class="col-md-3">
      <label class="form-label">Gender</label>
      <select class="form-select" name="gender">
        <option value="" <?= empty($user['gender'])?'selected':'' ?>>Select</option>
        <option value="male" <?= ($user['gender']==='male')?'selected':'' ?>>Male</option>
        <option value="female" <?= ($user['gender']==='female')?'selected':'' ?>>Female</option>
        <option value="other" <?= ($user['gender']==='other')?'selected':'' ?>>Other</option>
      </select>
    </div>
    <div class="col-md-12">
      <label class="form-label">Address</label>
      <textarea class="form-control" name="address" rows="3"><?= esc($user['address']) ?></textarea>
    </div>
    <div class="col-md-12 form-check">
      <input class="form-check-input" type="checkbox" name="is_admin" id="is_admin" <?= $user['is_admin']? 'checked':'' ?>>
      <label class="form-check-label" for="is_admin">Is Admin</label>
    </div>
  </div>
  <div class="mt-3">
    <button class="btn btn-primary">Save</button>
    <a href="/admin" class="btn btn-secondary">Cancel</a>
  </div>
</form>
<?= $this->endSection() ?>


