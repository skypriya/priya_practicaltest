<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Practical Task') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet" />
    <style>
        .signature-pad{border:1px solid #ccc;min-height:160px}
        .cropper-container{max-width:100%}
    </style>
      <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
  <?php if (!session('user')): ?>
 
    <a class="navbar-brand" href="/">Practical Task</a>
    <?php endif; ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample" aria-controls="navbarsExample" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExample">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if (session('user')): ?>
          <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
          <?php if (!empty(session('user.is_admin'))): ?>
            <li class="nav-item"><a class="nav-link" href="/admin">Admin</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
  </nav>
<main class="container py-4">
    <?= $this->renderSection('content') ?>
  </main>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    // Verify jQuery loaded
    if (typeof jQuery === 'undefined') {
      console.error('jQuery failed to load!');
    } else {
      console.log('jQuery loaded successfully, version:', jQuery.fn.jquery);
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jSignature/2.1.3/jSignature.min.js"></script>
  <?= $this->renderSection('scripts') ?? '' ?>
</body>
</html>


