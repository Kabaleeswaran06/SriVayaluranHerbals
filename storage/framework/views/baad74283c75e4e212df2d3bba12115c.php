<?php $__env->startSection('title', $combo->exists ? 'Edit Combo Pack' : 'Add Combo Pack'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-head">
  <div>
    <h1><?php echo e($combo->exists ? 'Edit Combo Pack' : 'Add Combo Pack'); ?></h1>
    <p>Title, price, and at least one product with grams are required.</p>
  </div>
  <a href="<?php echo e(route('admin.combos.index')); ?>" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> Back to Combo Packs</a>
</div>

<div class="card">
  <form method="POST"
        action="<?php echo e($combo->exists ? route('admin.combos.update', $combo) : route('admin.combos.store')); ?>"
        enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if($combo->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

    <div class="form-grid">
      <div class="field">
        <label>Title (English)</label>
        <input type="text" name="title" required value="<?php echo e(old('title', $combo->title)); ?>" placeholder="e.g. Herbal Wellness Combo">
      </div>

      <div class="field">
        <label>Title (Tamil)</label>
        <input type="text" name="title_ta" value="<?php echo e(old('title_ta', $combo->title_ta)); ?>" placeholder="தமிழ் பெயர்">
      </div>

      <div class="field">
        <label>Price (₹)</label>
        <input type="number" step="0.01" name="price" required value="<?php echo e(old('price', $combo->price)); ?>" placeholder="e.g. 450">
      </div>

      <div class="field">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="<?php echo e(old('sort_order', $combo->sort_order ?? 0)); ?>" placeholder="0">
      </div>

      <div class="field">
        <label>Status</label>
        <label class="checkbox-inline">
          <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $combo->is_active ?? true) ? 'checked' : ''); ?>>
          Active (show on homepage banner)
        </label>
      </div>

      <div class="field full">
        <label>Description</label>
        <textarea name="description" rows="3" placeholder="Short description shown to customers"><?php echo e(old('description', $combo->description)); ?></textarea>
      </div>

      <div class="field full">
        <label>Additional Information</label>
        <textarea name="additional_info" rows="3" placeholder="Storage, shelf life, usage notes, etc."><?php echo e(old('additional_info', $combo->additional_info)); ?></textarea>
      </div>

      <div class="field">
        <label>Banner Image (1248 × 502) — homepage auto-scroll</label>
        <?php if($combo->banner_image): ?>
          <div class="current-img">
            <img src="<?php echo e(Storage::url($combo->banner_image)); ?>" alt="">
            <span>Current banner — upload a new file only if you want to replace it.</span>
          </div>
        <?php endif; ?>
        <input type="file" name="banner_image" accept="image/*">
      </div>

      <div class="field">
        <label>Main Image (combo detail page)</label>
        <?php if($combo->main_image): ?>
          <div class="current-img">
            <img src="<?php echo e(Storage::url($combo->main_image)); ?>" alt="">
            <span>Current image — upload a new file only if you want to replace it.</span>
          </div>
        <?php endif; ?>
        <input type="file" name="main_image" accept="image/*">
      </div>

      <div class="field full">
        <label>Products in this Combo</label>
        <p style="font-size:.76rem; color:#8a7f6a; margin-top:-6px; margin-bottom:10px;">
          Pick from your existing products, <strong>or</strong> type a name manually for items not in your product list (e.g. "Roja Poo"). Fill either the dropdown or the manual name — not both.
        </p>
        <div id="productRows">
          <?php
            $existingItems = $combo->items ?? collect();
          ?>
          <?php $__empty_1 = true; $__currentLoopData = $existingItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="variant-row combo-item-row">
              <select name="product_id[]" class="item-product-select">
                <option value="">— Manual item —</option>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($product->id); ?>" <?php echo e($item->product_id == $product->id ? 'selected' : ''); ?>>
                    <?php echo e($product->name_en); ?><?php if($product->name_ta): ?> (<?php echo e($product->name_ta); ?>)<?php endif; ?>
                  </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <input type="text" name="custom_name[]" value="<?php echo e($item->custom_name); ?>" placeholder="Manual name (English) — e.g. Roja Poo" class="item-custom-name" <?php echo e($item->product_id ? 'disabled' : ''); ?>>
              <input type="text" name="custom_name_ta[]" value="<?php echo e($item->custom_name_ta); ?>" placeholder="Manual name (Tamil)" class="item-custom-name-ta" <?php echo e($item->product_id ? 'disabled' : ''); ?>>
              <input type="number" name="grams[]" value="<?php echo e($item->grams); ?>" placeholder="Grams" required>
              <button type="button" class="btn btn-danger btn-sm remove-product"><i class="fa-solid fa-xmark"></i></button>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="variant-row combo-item-row">
              <select name="product_id[]" class="item-product-select">
                <option value="">— Manual item —</option>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($product->id); ?>">
                    <?php echo e($product->name_en); ?><?php if($product->name_ta): ?> (<?php echo e($product->name_ta); ?>)<?php endif; ?>
                  </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <input type="text" name="custom_name[]" placeholder="Manual name (English) — e.g. Roja Poo" class="item-custom-name">
              <input type="text" name="custom_name_ta[]" placeholder="Manual name (Tamil)" class="item-custom-name-ta">
              <input type="number" name="grams[]" placeholder="Grams" required>
              <button type="button" class="btn btn-danger btn-sm remove-product"><i class="fa-solid fa-xmark"></i></button>
            </div>
          <?php endif; ?>
        </div>
        <button type="button" id="addProduct" class="btn btn-outline btn-sm"><i class="fa-solid fa-plus"></i> Add Item</button>
        <p style="font-size:.76rem; color:#8a7f6a; margin-top:8px;">e.g. Kasthuri Manjal (existing product) — 50g, Roja Poo (manual) — 20g.</p>
      </div>
    </div>

    <button type="submit" class="btn btn-gold"><i class="fa-solid fa-floppy-disk"></i> <?php echo e($combo->exists ? 'Update Combo' : 'Save Combo'); ?></button>
    <a href="<?php echo e(route('admin.combos.index')); ?>" class="btn btn-outline">Cancel</a>
  </form>
</div>

<script>
const productOptions = `
  <option value="">— Manual item —</option>
  <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($product->id); ?>"><?php echo e($product->name_en); ?><?php if($product->name_ta): ?> (<?php echo e($product->name_ta); ?>)<?php endif; ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
`;

function toggleManualFields(row) {
  const select = row.querySelector('.item-product-select');
  const nameEn = row.querySelector('.item-custom-name');
  const nameTa = row.querySelector('.item-custom-name-ta');
  const hasProduct = select.value !== '';

  nameEn.disabled = hasProduct;
  nameTa.disabled = hasProduct;
  if (hasProduct) {
    nameEn.value = '';
    nameTa.value = '';
  }
}

document.getElementById('addProduct').addEventListener('click', function(){
  const wrap = document.getElementById('productRows');
  const row = document.createElement('div');
  row.className = 'variant-row combo-item-row';
  row.innerHTML = `
    <select name="product_id[]" class="item-product-select">${productOptions}</select>
    <input type="text" name="custom_name[]" placeholder="Manual name (English) — e.g. Roja Poo" class="item-custom-name">
    <input type="text" name="custom_name_ta[]" placeholder="Manual name (Tamil)" class="item-custom-name-ta">
    <input type="number" name="grams[]" placeholder="Grams" required>
    <button type="button" class="btn btn-danger btn-sm remove-product"><i class="fa-solid fa-xmark"></i></button>
  `;
  wrap.appendChild(row);
});

document.getElementById('productRows').addEventListener('change', function(e){
  if (e.target.classList.contains('item-product-select')) {
    toggleManualFields(e.target.closest('.combo-item-row'));
  }
});

document.getElementById('productRows').addEventListener('click', function(e){
  const btn = e.target.closest('.remove-product');
  if (!btn) return;
  const rows = document.querySelectorAll('#productRows .variant-row');
  if (rows.length > 1) {
    btn.closest('.variant-row').remove();
  } else {
    const row = btn.closest('.variant-row');
    row.querySelectorAll('select, input').forEach(el => { el.value = ''; el.disabled = false; });
  }
});

// Apply initial disabled state on page load for pre-filled rows
document.querySelectorAll('#productRows .combo-item-row').forEach(toggleManualFields);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\SriVayaluranHerbals\resources\views/admin/combos/form.blade.php ENDPATH**/ ?>