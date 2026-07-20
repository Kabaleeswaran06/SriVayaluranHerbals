<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-head">
  <div>
    <h1>Products</h1>
    <p>All items on your shelf — filter by category, or add a new product.</p>
  </div>
  <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-gold"><i class="fa-solid fa-plus"></i> Add Product</a>
</div>

<div class="card">
  <div class="filter-bar">
    <form method="GET" action="<?php echo e(route('admin.products.index')); ?>">
      <label style="font-size:.8rem; color:var(--leaf); font-weight:600;">Filter by category:</label>
      <select name="category" onchange="this.form.submit()">
        <option value="">All Categories</option>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($c->id); ?>" <?php echo e(request('category') == $c->id ? 'selected' : ''); ?>><?php echo e($c->name_en); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
    </form>
  </div>

  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Image</th><th>Name (EN)</th><th>Name (TA)</th><th>Category</th>
          <th>Pack Sizes &amp; Prices</th><th>Sort</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td>
              <?php if($product->image): ?>
                <img src="<?php echo e($product->image_url); ?>" class="thumb" alt="">
              <?php else: ?>
                <div class="thumb-empty"><i class="fa-solid fa-image"></i></div>
              <?php endif; ?>
            </td>
            <td><?php echo e($product->name_en); ?></td>
            <td class="tamil-text"><?php echo e($product->name_ta ?: '—'); ?></td>
            <td><span class="badge badge-cat"><?php echo e($product->category->name_en ?? 'Uncategorized'); ?></span></td>
            <td>
              <ul class="variant-list">
                <?php $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><?php echo e(rtrim(rtrim(number_format($v->value, 2), '0'), '.')); ?> <?php echo e($v->unit); ?> — ₹<?php echo e(rtrim(rtrim(number_format($v->price, 2), '0'), '.')); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </td>
            <td><?php echo e($product->sort_order); ?></td>
            <td class="actions-cell">
              <a href="<?php echo e(route('admin.products.edit', $product)); ?>" class="btn btn-outline btn-sm"><i class="fa-solid fa-pen"></i> Edit</a>
              <form method="POST" action="<?php echo e(route('admin.products.destroy', $product)); ?>" onsubmit="return confirm('Delete this product?');">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
              </form>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr><td colspan="7" class="empty-state"><i class="fa-solid fa-boxes-stacked"></i>No products found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\SriVayaluranHerbals\resources\views/admin/products/index.blade.php ENDPATH**/ ?>