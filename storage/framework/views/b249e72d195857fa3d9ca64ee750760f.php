<?php $__env->startSection('title', 'Reviews'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-head">
  <div>
    <h1>Reviews</h1>
    <p>Toggle a review on to feature it in the homepage carousel. <?php echo e($reviews->where('featured', true)->count()); ?> currently featured.</p>
  </div>
</div>

<div class="card">
  <h2>Add a Review</h2>
  <form method="POST" action="<?php echo e(route('admin.reviews.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="form-grid">
      <div class="field">
        <label>Customer Name</label>
        <input type="text" name="customer_name" required value="<?php echo e(old('customer_name')); ?>" placeholder="e.g. Radhika Subramaniam">
      </div>
      <div class="field">
        <label>Role / Note (optional)</label>
        <input type="text" name="role" value="<?php echo e(old('role')); ?>" placeholder="e.g. Customer since 1994">
      </div>
      <div class="field">
        <label>Rating</label>
        <select name="rating">
          <option value="5">★★★★★ (5)</option>
          <option value="4">★★★★☆ (4)</option>
          <option value="3">★★★☆☆ (3)</option>
          <option value="2">★★☆☆☆ (2)</option>
          <option value="1">★☆☆☆☆ (1)</option>
        </select>
      </div>
      <div class="field full">
        <label>Review Text</label>
        <textarea name="review_text" rows="3" required placeholder="What the customer said..."><?php echo e(old('review_text')); ?></textarea>
      </div>
    </div>
    <button type="submit" class="btn btn-gold"><i class="fa-solid fa-plus"></i> Add Review</button>
  </form>
</div>

<div class="card">
  <h2>All Reviews (<?php echo e($reviews->count()); ?>)</h2>
  <div class="table-wrap">
    <table>
      <thead>
        <tr><th>Customer</th><th>Rating</th><th>Review</th><th>Featured on Homepage</th><th>Actions</th></tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td>
              <strong><?php echo e($review->customer_name); ?></strong><br>
              <span class="tamil-text"><?php echo e($review->role); ?></span>
            </td>
            <td class="badge-star"><?php echo e(str_repeat('★', $review->rating)); ?><?php echo e(str_repeat('☆', 5 - $review->rating)); ?></td>
            <td class="review-text-cell"><?php echo e($review->review_text); ?></td>
            <td>
              <form method="POST" action="<?php echo e(route('admin.reviews.toggle', $review)); ?>" style="display:inline;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="toggle-switch <?php echo e($review->featured ? 'on' : ''); ?>" style="border:none;"></button>
              </form>
              <span style="font-size:.72rem; color:#8a7f6a; margin-left:6px;"><?php echo e($review->featured ? 'On' : 'Off'); ?></span>
            </td>
            <td class="actions-cell">
              <form method="POST" action="<?php echo e(route('admin.reviews.destroy', $review)); ?>" onsubmit="return confirm('Delete this review?');">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
              </form>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr><td colspan="5" class="empty-state"><i class="fa-solid fa-star"></i>No reviews yet.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\SriVayaluranHerbals\resources\views/admin/reviews/index.blade.php ENDPATH**/ ?>