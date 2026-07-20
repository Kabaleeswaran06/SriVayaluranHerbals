@extends('layouts.admin')
@section('title', $product->exists ? 'Edit Product' : 'Add Product')

@section('content')
<div class="page-head">
  <div>
    <h1>{{ $product->exists ? 'Edit Product' : 'Add Product' }}</h1>
    <p>Category, product name (English), and at least one pack size with a price are required.</p>
  </div>
  <a href="{{ route('admin.products.index') }}" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> Back to Products</a>
</div>

<div class="card">
  <form method="POST"
        action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
        enctype="multipart/form-data">
    @csrf
    @if ($product->exists) @method('PUT') @endif

    <div class="form-grid">
      <div class="field">
        <label>Category</label>
        <select name="category_id" required>
          <option value="">Select category</option>
          @foreach ($categories as $c)
            <option value="{{ $c->id }}" {{ old('category_id', $product->category_id) == $c->id ? 'selected' : '' }}>{{ $c->name_en }}</option>
          @endforeach
        </select>
        @if ($categories->isEmpty())
          <p style="font-size:.76rem; color:var(--danger); margin-top:6px;">No categories yet — <a href="{{ route('admin.categories.create') }}" style="text-decoration:underline;">create one first</a>.</p>
        @endif
      </div>

      <div class="field">
        <label>Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $product->sort_order ?? 0) }}" placeholder="0">
      </div>

      <div class="field">
        <label>Product Name (English)</label>
        <input type="text" name="name_en" required value="{{ old('name_en', $product->name_en) }}" placeholder="e.g. Kesha Ranjani Hair Oil">
      </div>

      <div class="field">
        <label>Product Name (Tamil)</label>
        <input type="text" name="name_ta" value="{{ old('name_ta', $product->name_ta) }}" placeholder="தமிழ் பெயர்">
      </div>

      <div class="field full">
        <label>Product Description</label>
        <textarea name="description" rows="3" placeholder="Short description shown to customers">{{ old('description', $product->description) }}</textarea>
      </div>

      <div class="field full">
        <label>Pack Sizes &amp; Prices</label>
        <div id="variantRows">
          @php $existingVariants = old('var_value') ? collect(old('var_value'))->map(fn($v,$i)=>['value'=>$v,'unit'=>old('var_unit')[$i] ?? 'gms','price'=>old('var_price')[$i] ?? '']) : ($product->exists && $product->variants->isNotEmpty() ? $product->variants->map(fn($v)=>['value'=>rtrim(rtrim(number_format($v->value,2),'0'),'.'),'unit'=>$v->unit,'price'=>rtrim(rtrim(number_format($v->price,2),'0'),'.')]) : collect([['value'=>'','unit'=>'gms','price'=>'']])); @endphp
          @foreach ($existingVariants as $v)
            <div class="variant-row">
              <input type="number" step="0.01" name="var_value[]" value="{{ $v['value'] }}" placeholder="e.g. 100">
              <select name="var_unit[]">
                <option value="gms" {{ $v['unit']==='gms'?'selected':'' }}>gms</option>
                <option value="kg" {{ $v['unit']==='kg'?'selected':'' }}>kg</option>
              </select>
              <input type="number" step="0.01" name="var_price[]" value="{{ $v['price'] }}" placeholder="Price ₹">
              <button type="button" class="btn btn-danger btn-sm remove-variant"><i class="fa-solid fa-xmark"></i></button>
            </div>
          @endforeach
        </div>
        <button type="button" id="addVariant" class="btn btn-outline btn-sm"><i class="fa-solid fa-plus"></i> Add Pack Size</button>
        <p style="font-size:.76rem; color:#8a7f6a; margin-top:8px;">e.g. 100 gms — ₹80, 250 gms — ₹200. Add one row per pack size you sell this product in.</p>
      </div>

      <div class="field full">
        <label>Additional Details</label>
        <textarea name="additional_details" rows="3" placeholder="Ingredients, usage instructions, shelf life, etc.">{{ old('additional_details', $product->additional_details) }}</textarea>
      </div>

      <div class="field full">
        <label>Product Image</label>
        @if ($product->image)
          <div class="current-img">
            <img src="{{ $product->image_url }}" alt="">
            <span>Current image — upload a new file only if you want to replace it.</span>
          </div>
        @endif
        <input type="file" name="image" accept="image/*">
      </div>
    </div>

    <button type="submit" class="btn btn-gold"><i class="fa-solid fa-floppy-disk"></i> {{ $product->exists ? 'Update Product' : 'Save Product' }}</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline">Cancel</a>
  </form>
</div>

<script>
document.getElementById('addVariant').addEventListener('click', function(){
  const wrap = document.getElementById('variantRows');
  const row = document.createElement('div');
  row.className = 'variant-row';
  row.innerHTML = `
    <input type="number" step="0.01" name="var_value[]" placeholder="e.g. 100">
    <select name="var_unit[]">
      <option value="gms">gms</option>
      <option value="kg">kg</option>
    </select>
    <input type="number" step="0.01" name="var_price[]" placeholder="Price ₹">
    <button type="button" class="btn btn-danger btn-sm remove-variant"><i class="fa-solid fa-xmark"></i></button>
  `;
  wrap.appendChild(row);
});

document.getElementById('variantRows').addEventListener('click', function(e){
  const btn = e.target.closest('.remove-variant');
  if (!btn) return;
  const rows = document.querySelectorAll('#variantRows .variant-row');
  if (rows.length > 1) {
    btn.closest('.variant-row').remove();
  } else {
    btn.closest('.variant-row').querySelectorAll('input').forEach(i => i.value = '');
  }
});
</script>
@endsection
