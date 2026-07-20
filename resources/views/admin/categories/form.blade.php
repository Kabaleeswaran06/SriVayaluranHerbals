@extends('layouts.admin')
@section('title', $category->exists ? 'Edit Category' : 'Add Category')

@section('content')
<div class="page-head">
  <div>
    <h1>{{ $category->exists ? 'Edit Category' : 'Create Category' }}</h1>
    <p>Category name (English) is required; Tamil name and image are optional.</p>
  </div>
  <a href="{{ route('admin.categories.index') }}" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> Back to Categories</a>
</div>

<div class="card">
  <form method="POST"
        action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
        enctype="multipart/form-data">
    @csrf
    @if ($category->exists) @method('PUT') @endif

    <div class="form-grid">
      <div class="field">
        <label>Category Name (English)</label>
        <input type="text" name="name_en" required value="{{ old('name_en', $category->name_en) }}" placeholder="e.g. Herbal Oils">
      </div>
      <div class="field">
        <label>Category Name (Tamil)</label>
        <input type="text" name="name_ta" value="{{ old('name_ta', $category->name_ta) }}" placeholder="தமிழ் பெயர்">
      </div>
      <div class="field full">
        <label>Category Image</label>
        @if ($category->image)
          <div class="current-img">
            <img src="{{ $category->image_url }}" alt="">
            <span>Current image — upload a new file only if you want to replace it.</span>
          </div>
        @endif
        <input type="file" name="image" accept="image/*">
      </div>
    </div>

    <button type="submit" class="btn btn-gold"><i class="fa-solid fa-floppy-disk"></i> {{ $category->exists ? 'Update Category' : 'Save Category' }}</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">Cancel</a>
  </form>
</div>
@endsection
