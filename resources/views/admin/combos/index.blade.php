@extends('layouts.admin')
@section('title', 'Combo Packs')

@section('content')
<div class="page-head">
  <div>
    <h1>Combo Packs</h1>
    <p>Bundle existing products together at a combo price, with a homepage banner.</p>
  </div>
  <a href="{{ route('admin.combos.create') }}" class="btn btn-gold"><i class="fa-solid fa-plus"></i> Add Combo</a>
</div>

@if (session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

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
      @forelse ($combos as $combo)
        <tr>
          <td>
            @if ($combo->banner_image)
              <img src="{{ Storage::url($combo->banner_image) }}" alt="" style="width:100px; border-radius:6px;">
            @else
              <span style="color:#8a7f6a; font-size:.8rem;">No image</span>
            @endif
          </td>
          <td>
            {{ $combo->title }}
            @if ($combo->title_ta)
              <br><span style="color:#8a7f6a; font-size:.8rem;">{{ $combo->title_ta }}</span>
            @endif
          </td>
          <td>{{ $combo->items_count }}</td>
          <td>₹{{ number_format($combo->price, 2) }}</td>
          <td>
            @if ($combo->is_active)
              <span class="badge badge-success">Active</span>
            @else
              <span class="badge badge-muted">Inactive</span>
            @endif
          </td>
          <td>
            <a href="{{ route('admin.combos.edit', $combo) }}" class="btn btn-outline btn-sm"><i class="fa-solid fa-pen"></i> Edit</a>
            <form action="{{ route('admin.combos.destroy', $combo) }}" method="POST" style="display:inline"
                  onsubmit="return confirm('Delete this combo pack?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" style="text-align:center; color:#8a7f6a; padding:24px;">No combo packs yet — click "Add Combo" to create your first one.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

@if ($combos->hasPages())
  <div style="margin-top:16px;">{{ $combos->links() }}</div>
@endif
@endsection
