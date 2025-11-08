<h3>Registered Users</h3>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
  <thead>
    <tr>
      <th>ID</th><th>Name</th><th>Email</th><th>DOB</th><th>Gender</th><th>Admin</th>
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
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>


