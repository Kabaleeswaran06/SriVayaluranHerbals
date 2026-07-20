<?php $__env->startSection('title', 'Combo Packs'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-head">
  <div>
    <h1>Combo Packs</h1>
    <p>Bundle existing products together at a combo price, with a homepage banner.</p>
  </div>
  <a href="<?php echo e(route('admin.combos.create')); ?>" class="btn btn-gold"><i class="fa-solid fa-plus"></i> Add Combo</a>
</div>

<?php if(session('success')): ?>
  <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<div class="card">
  <table class="data-table">
    <thead>
      <tr>
        <th>Banner</th>
        <th>Title</th>
        <th>Products</th>
        <th>Price</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php $__empty_1 = true; $__currentLoopData = $combos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $combo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td>
            <?php if($combo->banner_image): ?>
              <img src="<?php echo e(Storage::url($combo->banner_image)); ?>" alt="" style="width:100px; border-radius:6px;">
            <?php else: ?>
              <span style="color:#8a7f6a; font-size:.8rem;">No image</span>
            <?php endif; ?>
          </td>
          <td>
            <?php echo e($combo->title); ?>

            <?php if($combo->title_ta): ?>
              <br><span style="color:#8a7f6a; font-size:.8rem;"><?php echo e($combo->title_ta); ?></span>
            <?php endif; ?>
          </td>
          <td><?php echo e($combo->items_count); ?></td>
          <td>₹<?php echo e(number_format($combo->price, 2)); ?></td>
          <td>
            <?php if($combo->is_active): ?>
              <span class="badge badge-success">Active</span>
            <?php else: ?>
              <span class="badge badge-muted">Inactive</span>
            <?php endif; ?>
          </td>
          <td>
            <a href="<?php echo e(route('admin.combos.edit', $combo)); ?>" class="btn btn-outline btn-sm"><i class="fa-solid fa-pen"></i> Edit</a>
            <form action="<?php echo e(route('admin.combos.destroy', $combo)); ?>" method="POST" style="display:inline"
                  onsubmit="return confirm('Delete this combo pack?')">
              <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
              <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="6" style="text-align:center; color:#8a7f6a; padding:24px;">No combo packs yet — click "Add Combo" to create your first one.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php if($combos->hasPages()): ?>
  <div style="margin-top:16px;"><?php echo e($combos->links()); ?></div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\SriVayaluranHerbals\resources\views/admin/combos/index.blade.php ENDPATH**/ ?>