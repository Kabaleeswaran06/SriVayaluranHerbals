<?php $__env->startSection('title', $category->exists ? 'Edit Category' : 'Add Category'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-head">
  <div>
    <h1><?php echo e($category->exists ? 'Edit Category' : 'Create Category'); ?></h1>
    <p>Category name (English) is required; Tamil name and image are optional.</p>
  </div>
  <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> Back to Categories</a>
</div>

<div class="card">
  <form method="POST"
        action="<?php echo e($category->exists ? route('admin.categories.update', $category) : route('admin.categories.store')); ?>"
        enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if($category->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

    <div class="form-grid">
      <div class="field">
        <label>Category Name (English)</label>
        <input type="text" name="name_en" required value="<?php echo e(old('name_en', $category->name_en)); ?>" placeholder="e.g. Herbal Oils">
      </div>
      <div class="field">
        <label>Category Name (Tamil)</label>
        <input type="text" name="name_ta" value="<?php echo e(old('name_ta', $category->name_ta)); ?>" placeholder="தமிழ் பெயர்">
      </div>
      <div class="field full">
        <label>Category Image</label>
        <?php if($category->image): ?>
          <div class="current-img">
            <img src="<?php echo e($category->image_url); ?>" alt="">
            <span>Current image — upload a new file only if you want to replace it.</span>
          </div>
        <?php endif; ?>
        <input type="file" name="image" accept="image/*">
      </div>
    </div>

    <button type="submit" class="btn btn-gold"><i class="fa-solid fa-floppy-disk"></i> <?php echo e($category->exists ? 'Update Category' : 'Save Category'); ?></button>
    <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-outline">Cancel</a>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\SriVayaluranHerbals\resources\views/admin/categories/form.blade.php ENDPATH**/ ?>