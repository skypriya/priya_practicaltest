<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php if (session('error')): ?><div class="alert alert-danger"><?= esc(session('error')) ?></div><?php endif; ?>
<?php if (session('success')): ?><div class="alert alert-success"><?= esc(session('success')) ?></div><?php endif; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Registered Users</h3>
  <div class="d-flex gap-2">
    <a class="btn btn-outline-success" href="/admin/export/excel">Export Excel</a>
    <!-- <a class="btn btn-outline-danger" href="/admin/export/pdf">Export PDF</a> -->
    <a class="btn btn-outline-danger" href="/admin/export/pdf" download="report.pdf">Export PDF</a>

  </div>
  </div>
<div class="table-responsive">
  <table class="table table-bordered table-striped align-middle">
    <thead class="table-light">
      <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>DOB</th><th>Gender</th><th>Admin</th><th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach(($users ?? []) as $u): ?>
        <tr>
          <td><?= esc($u['id']) ?></td>
          <td><?= esc($u['first_name'].' '.$u['last_name']) ?></td>
          <td><?= esc($u['email']) ?></td>
          <td><?= esc($u['date_of_birth']) ?></td>
          <td><?= esc($u['gender']) ?></td>
          <td><?= $u['is_admin'] ? 'Yes' : 'No' ?></td>
          <td class="d-flex gap-2">
            <a class="btn btn-sm btn-secondary" href="/admin/view/<?= esc($u['id']) ?>">View</a>
            <a class="btn btn-sm btn-primary" href="/admin/edit/<?= esc($u['id']) ?>">Edit</a>
            <form method="post" action="/admin/delete/<?= esc($u['id']) ?>" onsubmit="return confirm('Delete this user?')">
              <?= csrf_field() ?>
              <button class="btn btn-sm btn-danger">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?= $this->endSection() ?>


