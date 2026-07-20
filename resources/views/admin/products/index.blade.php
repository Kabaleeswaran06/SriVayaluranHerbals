@extends('layouts.admin')
@section('title', 'Products')

@section('content')
<div class="page-head">
  <div>
    <h1>Products</h1>
    <p>All items on your shelf — filter by category, or add a new product.</p>
  </div>
  <a href="{{ route('admin.products.create') }}" class="btn btn-gold"><i class="fa-solid fa-plus"></i> Add Product</a>
</div>

<div class="card">
  <div class="filter-bar">
    <form method="GET" action="{{ route('admin.products.index') }}">
      <label style="font-size:.8rem; color:var(--leaf); font-weight:600;">Filter by category:</label>
      <select name="category" onchange="this.form.submit()">
        <option value="">All Categories</option>
        @foreach ($categories as $c)
          <option value="{{ $c->id }}" {{ request('category') == $c->id ? 'selected' : '' }}>{{ $c->name_en }}</option>
        @endforeach
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
        @forelse ($products as $product)
          <tr>
            <td>
              @if ($product->image)
                <img src="{{ $product->image_url }}" class="thumb" alt="">
              @else
                <div class="thumb-empty"><i class="fa-solid fa-image"></i></div>
              @endif
            </td>
            <td>{{ $product->name_en }}</td>
            <td class="tamil-text">{{ $product->name_ta ?: '—' }}</td>
            <td><span class="badge badge-cat">{{ $product->category->name_en ?? 'Uncategorized' }}</span></td>
            <td>
              <ul class="variant-list">
                @foreach ($product->variants as $v)
                  <li>{{ rtrim(rtrim(number_format($v->value, 2), '0'), '.') }} {{ $v->unit }} — ₹{{ rtrim(rtrim(number_format($v->price, 2), '0'), '.') }}</li>
                @endforeach
              </ul>
            </td>
            <td>{{ $product->sort_order }}</td>
            <td class="actions-cell">
              <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline btn-sm"><i class="fa-solid fa-pen"></i> Edit</a>
              <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Delete this product?');">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="7" class="empty-state"><i class="fa-solid fa-boxes-stacked"></i>No products found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
