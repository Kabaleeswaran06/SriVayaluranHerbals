<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login — Sri Vayaluran Herbals</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
</head>
<body>
<div class="auth-wrap">
  <div class="auth-box">
    <h1 class="auth-logo"><i class="fa-solid fa-leaf" style="color:#C9A227;"></i> Sri Vayaluran</h1>
    <div class="auth-sub">Admin Panel</div>

    <?php if($errors->any()): ?>
      <div class="alert alert-error"><i class="fa-solid fa-triangle-exclamation"></i> <?php echo e($errors->first()); ?></div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('admin.login.attempt')); ?>">
      <?php echo csrf_field(); ?>
      <div class="field">
        <label>Username</label>
        <input type="text" name="username" required autofocus value="<?php echo e(old('username')); ?>" placeholder="admin">
      </div>
      <div class="field">
        <label>Password</label>
        <input type="password" name="password" required placeholder="••••••••">
      </div>
      <button type="submit" class="btn btn-gold" style="width:100%; justify-content:center;">
        <i class="fa-solid fa-right-to-bracket"></i> Login
      </button>
    </form>
    <p class="auth-hint">Authorized shop administrators only.</p>
  </div>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\SriVayaluranHerbals\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>