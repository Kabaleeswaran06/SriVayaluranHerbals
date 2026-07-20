<?php $__env->startSection('title', 'Categories'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-head">
  <div>
    <h1>Categories</h1>
    <p>Create and manage the categories your products are grouped under.</p>
  </div>
  <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-gold"><i class="fa-solid fa-plus"></i> Add Category</a>
</div>

<div class="card">
  <h2>All Categories (<?php echo e($categories->count()); ?>)</h2>
  <div class="table-wrap">
    <table>
      <thead>
        <tr><th>Image</th><th>Name (EN)</th><th>Name (TA)</th><th>Products</th><th>Actions</th></tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td>
              <?php if($category->image): ?>
                <img src="<?php echo e($category->image_url); ?>" class="thumb" alt="">
              <?php else: ?>
                <div class="thumb-empty"><i class="fa-solid fa-image"></i></div>
              <?php endif; ?>
            </td>
            <td><?php echo e($category->name_en); ?></td>
            <td class="tamil-text"><?php echo e($category->name_ta ?: '—'); ?></td>
            <td><span class="badge badge-cat"><?php echo e($category->products_count); ?></span></td>
            <td class="actions-cell">
              <a href="<?php echo e(route('admin.categories.edit', $category)); ?>" class="btn btn-outline btn-sm"><i class="fa-solid fa-pen"></i> Edit</a>
              <form method="POST" action="<?php echo e(route('admin.categories.destroy', $category)); ?>" onsubmit="return confirm('Delete this category?');">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
              </form>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr><td colspan="5" class="empty-state"><i class="fa-solid fa-tags"></i>No categories yet. Add your first one above.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\SriVayaluranHerbals\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>