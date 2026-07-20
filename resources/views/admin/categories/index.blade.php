@extends('layouts.admin')
@section('title', 'Categories')

@section('content')
<div class="page-head">
  <div>
    <h1>Categories</h1>
    <p>Create and manage the categories your products are grouped under.</p>
  </div>
  <a href="{{ route('admin.categories.create') }}" class="btn btn-gold"><i class="fa-solid fa-plus"></i> Add Category</a>
</div>

<div class="card">
  <h2>All Categories ({{ $categories->count() }})</h2>
  <div class="table-wrap">
    <table>
      <thead>
        <tr><th>Image</th><th>Name (EN)</th><th>Name (TA)</th><th>Products</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @forelse ($categories as $category)
          <tr>
            <td>
              @if ($category->image)
                <img src="{{ $category->image_url }}" class="thumb" alt="">
              @else
                <div class="thumb-empty"><i class="fa-solid fa-image"></i></div>
              @endif
            </td>
            <td>{{ $category->name_en }}</td>
            <td class="tamil-text">{{ $category->name_ta ?: '—' }}</td>
            <td><span class="badge badge-cat">{{ $category->products_count }}</span></td>
            <td class="actions-cell">
              <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-outline btn-sm"><i class="fa-solid fa-pen"></i> Edit</a>
              <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Delete this category?');">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="empty-state"><i class="fa-solid fa-tags"></i>No categories yet. Add your first one above.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
