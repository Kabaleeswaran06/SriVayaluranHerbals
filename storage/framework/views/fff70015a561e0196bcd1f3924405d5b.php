<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $__env->yieldContent('title'); ?> — Sri Vayaluran Herbals Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
</head>
<body>

<aside class="sidebar">
  <div class="brand">
    <span>Sri Vayaluran<small>Admin Panel</small></span>
  </div>
  <nav>
    <a href="<?php echo e(route('admin.categories.index')); ?>" class="<?php echo e(request()->routeIs('admin.categories.*') ? 'active' : ''); ?>"><i class="fa-solid fa-tags"></i> Categories</a>
    <a href="<?php echo e(route('admin.products.index')); ?>" class="<?php echo e(request()->routeIs('admin.products.*') ? 'active' : ''); ?>"><i class="fa-solid fa-boxes-stacked"></i> Products</a>
    <a href="<?php echo e(route('admin.reviews.index')); ?>" class="<?php echo e(request()->routeIs('admin.reviews.*') ? 'active' : ''); ?>"><i class="fa-solid fa-star"></i> Reviews</a>
  </nav>
  <div class="user-box">
    <div class="uname"><i class="fa-solid fa-circle-user"></i> <?php echo e(auth()->user()->name ?? 'Admin'); ?></div>
    <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
      <?php echo csrf_field(); ?>
      <button type="submit" class="logout-link" style="background:none;border:none;cursor:pointer;padding:0;">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
      </button>
    </form>
  </div>
</aside>

<main class="main">
  <?php if(session('success')): ?>
    <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> <?php echo e(session('success')); ?></div>
  <?php endif; ?>
  <?php if(session('error')): ?>
    <div class="alert alert-error"><i class="fa-solid fa-triangle-exclamation"></i> <?php echo e(session('error')); ?></div>
  <?php endif; ?>
  <?php if($errors->any()): ?>
    <div class="alert alert-error">
      <i class="fa-solid fa-triangle-exclamation"></i>
      <span>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($error); ?><br> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </span>
    </div>
  <?php endif; ?>

  <?php echo $__env->yieldContent('content'); ?>
</main>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\SriVayaluranHerbals\resources\views/layouts/admin.blade.php ENDPATH**/ ?>