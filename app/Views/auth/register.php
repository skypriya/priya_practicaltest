<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
  <div class="col-lg-8">
    <h3 class="mb-3">Register</h3>
    <?php if (session('error')): ?>
      <div class="alert alert-danger">
        <?php 
        $error = session('error');
        if (is_array($error)) {
          echo '<ul class="mb-0">';
          foreach ($error as $err) {
            echo '<li>' . esc($err) . '</li>';
          }
          echo '</ul>';
        } else {
          echo esc($error);
        }
        ?>
      </div>
    <?php endif; ?>
    <?php if (session('success')): ?><div class="alert alert-success"><?= esc(session('success')) ?></div><?php endif; ?>
      <form id="registerForm" method="post" enctype="multipart/form-data" action="<?= site_url('register') ?>">
      <?= csrf_field() ?>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">First Name <span style="color:red">*</span></label>
          <input type="text" name="first_name" class="form-control" value="<?= old('first_name') ?>" required minlength="2">
        </div>
        <div class="col-md-6">
          <label class="form-label">Last Name <span style="color:red">*</span></label>
          <input type="text" name="last_name" class="form-control" value="<?= old('last_name') ?>" required minlength="2">
        </div>
        <div class="col-md-6">
          <label class="form-label">Email <span style="color:red">*</span></label>
          <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Password <span style="color:red">*</span></label>
          <input type="password" name="password" class="form-control" required minlength="6">
        </div>
        <div class="col-md-4">
          <label class="form-label">Date of Birth</label>
          <input type="date" name="date_of_birth" class="form-control" value="<?= old('date_of_birth') ?>">
        </div>
        <div class="col-md-4">
          <label class="form-label">Gender</label>
          <select name="gender" class="form-select">
            <option value="">Select</option>
            <option value="male" <?= old('gender') === 'male' ? 'selected' : '' ?>>Male</option>
            <option value="female" <?= old('gender') === 'female' ? 'selected' : '' ?>>Female</option>
            <option value="other" <?= old('gender') === 'other' ? 'selected' : '' ?>>Other</option>
          </select>
        </div>
        <div class="col-md-12">
          <label class="form-label">Address</label>
          <textarea name="address" class="form-control" rows="3"><?= old('address') ?></textarea>
        </div>
        <div class="col-md-6">
          <label class="form-label">Profile Picture</label>
          <input type="file" accept="image/*" class="form-control" id="profileInput" name="profile_picture">
          <div class="mt-2"><img id="profilePreview" style="max-width:100%;max-height:300px;display:none"/></div>
          <input type="hidden" name="profile_cropped" id="profile_cropped"/>
        </div>
        <div class="col-md-6">
          <label class="form-label">Signature</label>
          <div id="signature" class="signature-pad"></div>
          <input type="hidden" name="signature_image" id="signature_image"/>
          <div class="mt-2 d-flex gap-2">
            <button class="btn btn-sm btn-outline-secondary" id="clearSign" type="button">Clear</button>
            <button class="btn btn-sm btn-outline-primary" id="saveSign" type="button">Save</button>
          </div>
        </div>
      </div>
      <div class="mt-3">
        <button class="btn btn-success" type="submit">Register</button>
      </div>
    </form>
  </div>
</div>
<!-- Test: If you see this comment, the content section rendered -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Test: Scripts section is rendering -->
<script type="text/javascript">
console.log('=== Register Script Section Started ===');
console.log('jQuery available:', typeof jQuery !== 'undefined', typeof $ !== 'undefined');

// Wait for jQuery if not loaded yet
(function() {
  if (typeof jQuery === 'undefined') {
    console.error('jQuery not loaded! Waiting...');
    setTimeout(arguments.callee, 100);
    return;
  }
  
  console.log('jQuery is ready, initializing...');
  
  let cropper;
  $(document).ready(function(){
    console.log('jQuery ready fired');
    console.log('Form found:', $('#registerForm').length);
    
    if ($('#registerForm').length === 0) {
      console.error('Register form not found!');
      return;
    }
    
    $("#registerForm").validate({
      rules: {
        first_name: {
          required: true,
          minlength: 2
        },
        last_name: {
          required: true,
          minlength: 2
        },
        email: {
          required: true,
          email: true
        },
        password: {
          required: true,
          minlength: 6
        }
      },
      messages: {
        first_name: {
          required: "Please enter your first name",
          minlength: "First name must be at least 2 characters"
        },
        last_name: {
          required: "Please enter your last name",
          minlength: "Last name must be at least 2 characters"
        },
        email: {
          required: "Please enter your email",
          email: "Please enter a valid email address"
        },
        password: {
          required: "Please enter a password",
          minlength: "Password must be at least 6 characters"
        }
      },
      submitHandler: function(form) {
        console.log('Form submit handler called - validation passed');
        // Get cropped image before submit
        if (cropper) {
          const canvas = cropper.getCroppedCanvas();
          if (canvas) {
            canvas.toBlob(function(blob) {
              const dataUrl = canvas.toDataURL('image/jpeg');
              $('#profile_cropped').val(dataUrl);
              // Create a new file from blob and replace the input
              const file = new File([blob], 'cropped.jpg', {type: 'image/jpeg'});
              const dataTransfer = new DataTransfer();
              dataTransfer.items.add(file);
              document.getElementById('profileInput').files = dataTransfer.files;
              console.log('Submitting form with cropped image');
              form.submit();
            }, 'image/jpeg', 0.9);
            return false;
          }
        }
        console.log('Submitting form normally');
        form.submit();
      },
      invalidHandler: function(event, validator) {
        console.log('Form validation failed');
        console.log('Errors:', validator.errorList);
      }
    });
    
    // Initialize signature pad
    if ($('#signature').length > 0) {
      $('#signature').jSignature();
      $('#clearSign').on('click', function(){ 
        $('#signature').jSignature('reset'); 
        $('#signature_image').val(''); 
      });
      $('#saveSign').on('click', function(){
        const data = $('#signature').jSignature('getData', 'image');
        $('#signature_image').val('data:'+data[0]+','+data[1]);
        alert('Signature saved!');
      });
    }
    
    // Initialize profile picture cropper
    $('#profileInput').on('change', function(e){
      const file = e.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = function(){
        $('#profilePreview').show().attr('src', reader.result);
        if (cropper) cropper.destroy();
        cropper = new Cropper(document.getElementById('profilePreview'), { 
          aspectRatio: 1, 
          viewMode: 1,
          autoCropArea: 0.8
        });
      };
      reader.readAsDataURL(file);
    });
    
    console.log('Register form initialized successfully');
  });
})();
</script>
<?= $this->endSection() ?>


