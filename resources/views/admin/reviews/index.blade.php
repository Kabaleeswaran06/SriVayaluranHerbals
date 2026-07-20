@extends('layouts.admin')
@section('title', 'Reviews')

@section('content')
<div class="page-head">
  <div>
    <h1>Reviews</h1>
    <p>Toggle a review on to feature it in the homepage carousel. {{ $reviews->where('featured', true)->count() }} currently featured.</p>
  </div>
</div>

<div class="card">
  <h2>Add a Review</h2>
  <form method="POST" action="{{ route('admin.reviews.store') }}">
    @csrf
    <div class="form-grid">
      <div class="field">
        <label>Customer Name</label>
        <input type="text" name="customer_name" required value="{{ old('customer_name') }}" placeholder="e.g. Radhika Subramaniam">
      </div>
      <div class="field">
        <label>Role / Note (optional)</label>
        <input type="text" name="role" value="{{ old('role') }}" placeholder="e.g. Customer since 1994">
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
        <textarea name="review_text" rows="3" required placeholder="What the customer said...">{{ old('review_text') }}</textarea>
      </div>
    </div>
    <button type="submit" class="btn btn-gold"><i class="fa-solid fa-plus"></i> Add Review</button>
  </form>
</div>

<div class="card">
  <h2>All Reviews ({{ $reviews->count() }})</h2>
  <div class="table-wrap">
    <table>
      <thead>
        <tr><th>Customer</th><th>Rating</th><th>Review</th><th>Featured on Homepage</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @forelse ($reviews as $review)
          <tr>
            <td>
              <strong>{{ $review->customer_name }}</strong><br>
              <span class="tamil-text">{{ $review->role }}</span>
            </td>
            <td class="badge-star">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</td>
            <td class="review-text-cell">{{ $review->review_text }}</td>
            <td>
              <form method="POST" action="{{ route('admin.reviews.toggle', $review) }}" style="display:inline;">
                @csrf
                <button type="submit" class="toggle-switch {{ $review->featured ? 'on' : '' }}" style="border:none;"></button>
              </form>
              <span style="font-size:.72rem; color:#8a7f6a; margin-left:6px;">{{ $review->featured ? 'On' : 'Off' }}</span>
            </td>
            <td class="actions-cell">
              <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}" onsubmit="return confirm('Delete this review?');">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="empty-state"><i class="fa-solid fa-star"></i>No reviews yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
