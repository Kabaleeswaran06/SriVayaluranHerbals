@extends('layouts.admin')
@section('title', $combo->exists ? 'Edit Combo Pack' : 'Add Combo Pack')

@section('content')
<div class="page-head">
  <div>
    <h1>{{ $combo->exists ? 'Edit Combo Pack' : 'Add Combo Pack' }}</h1>
    <p>Title, price, and at least one product with grams are required.</p>
  </div>
  <a href="{{ route('admin.combos.index') }}" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> Back to Combo Packs</a>
</div>

<div class="card">
  <form method="POST"
        action="{{ $combo->exists ? route('admin.combos.update', $combo) : route('admin.combos.store') }}"
        enctype="multipart/form-data">
    @csrf
    @if ($combo->exists) @method('PUT') @endif

    <div class="form-grid">
      <div class="field">
        <label>Title (English)</label>
        <input type="text" name="title" required value="{{ old('title', $combo->title) }}" placeholder="e.g. Herbal Wellness Combo">
      </div>

      <div class="field">
        <label>Title (Tamil)</label>
        <input type="text" name="title_ta" value="{{ old('title_ta', $combo->title_ta) }}" placeholder="தமிழ் பெயர்">
      </div>

      <div class="field">
        <label>Price (₹)</label>
        <input type="number" step="0.01" name="price" required value="{{ old('price', $combo->price) }}" placeholder="e.g. 450">
      </div>

      <div class="field">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $combo->sort_order ?? 0) }}" placeholder="0">
      </div>

      <div class="field">
        <label>Status</label>
        <label class="checkbox-inline">
          <input type="checkbox" name="is_active" value="1" {{ old('is_active', $combo->is_active ?? true) ? 'checked' : '' }}>
          Active (show on homepage banner)
        </label>
      </div>

      <div class="field full">
        <label>Description</label>
        <textarea name="description" rows="3" placeholder="Short description shown to customers">{{ old('description', $combo->description) }}</textarea>
      </div>

      <div class="field full">
        <label>Additional Information</label>
        <textarea name="additional_info" rows="3" placeholder="Storage, shelf life, usage notes, etc.">{{ old('additional_info', $combo->additional_info) }}</textarea>
      </div>

      <div class="field">
        <label>Banner Image (1248 × 502) — homepage auto-scroll</label>
        @if ($combo->banner_image)
          <div class="current-img">
            <img src="{{ Storage::url($combo->banner_image) }}" alt="">
            <span>Current banner — upload a new file only if you want to replace it.</span>
          </div>
        @endif
        <input type="file" name="banner_image" accept="image/*">
      </div>

      <div class="field">
        <label>Main Image (combo detail page)</label>
        @if ($combo->main_image)
          <div class="current-img">
            <img src="{{ Storage::url($combo->main_image) }}" alt="">
            <span>Current image — upload a new file only if you want to replace it.</span>
          </div>
        @endif
        <input type="file" name="main_image" accept="image/*">
      </div>

      <div class="field full">
        <label>Products in this Combo</label>
        <p style="font-size:.76rem; color:#8a7f6a; margin-top:-6px; margin-bottom:10px;">
          Pick from your existing products, <strong>or</strong> type a name manually for items not in your product list (e.g. "Roja Poo"). Fill either the dropdown or the manual name — not both.
        </p>
        <div id="productRows">
          @php
            $existingItems = $combo->items ?? collect();
          @endphp
          @forelse ($existingItems as $item)
            <div class="variant-row combo-item-row">
              <select name="product_id[]" class="item-product-select">
                <option value="">— Manual item —</option>
                @foreach ($products as $product)
                  <option value="{{ $product->id }}" {{ $item->product_id == $product->id ? 'selected' : '' }}>
                    {{ $product->name_en }}@if($product->name_ta) ({{ $product->name_ta }})@endif
                  </option>
                @endforeach
              </select>
              <input type="text" name="custom_name[]" value="{{ $item->custom_name }}" placeholder="Manual name (English) — e.g. Roja Poo" class="item-custom-name" {{ $item->product_id ? 'disabled' : '' }}>
              <input type="text" name="custom_name_ta[]" value="{{ $item->custom_name_ta }}" placeholder="Manual name (Tamil)" class="item-custom-name-ta" {{ $item->product_id ? 'disabled' : '' }}>
              <input type="number" name="grams[]" value="{{ $item->grams }}" placeholder="Grams" required>
              <button type="button" class="btn btn-danger btn-sm remove-product"><i class="fa-solid fa-xmark"></i></button>
            </div>
          @empty
            <div class="variant-row combo-item-row">
              <select name="product_id[]" class="item-product-select">
                <option value="">— Manual item —</option>
                @foreach ($products as $product)
                  <option value="{{ $product->id }}">
                    {{ $product->name_en }}@if($product->name_ta) ({{ $product->name_ta }})@endif
                  </option>
                @endforeach
              </select>
              <input type="text" name="custom_name[]" placeholder="Manual name (English) — e.g. Roja Poo" class="item-custom-name">
              <input type="text" name="custom_name_ta[]" placeholder="Manual name (Tamil)" class="item-custom-name-ta">
              <input type="number" name="grams[]" placeholder="Grams" required>
              <button type="button" class="btn btn-danger btn-sm remove-product"><i class="fa-solid fa-xmark"></i></button>
            </div>
          @endforelse
        </div>
        <button type="button" id="addProduct" class="btn btn-outline btn-sm"><i class="fa-solid fa-plus"></i> Add Item</button>
        <p style="font-size:.76rem; color:#8a7f6a; margin-top:8px;">e.g. Kasthuri Manjal (existing product) — 50g, Roja Poo (manual) — 20g.</p>
      </div>
    </div>

    <button type="submit" class="btn btn-gold"><i class="fa-solid fa-floppy-disk"></i> {{ $combo->exists ? 'Update Combo' : 'Save Combo' }}</button>
    <a href="{{ route('admin.combos.index') }}" class="btn btn-outline">Cancel</a>
  </form>
</div>

<script>
const productOptions = `
  <option value="">— Manual item —</option>
  @foreach ($products as $product)
    <option value="{{ $product->id }}">{{ $product->name_en }}@if($product->name_ta) ({{ $product->name_ta }})@endif</option>
  @endforeach
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
@endsection
