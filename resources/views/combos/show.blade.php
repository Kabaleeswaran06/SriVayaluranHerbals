@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ Storage::url($combo->main_image) }}" class="img-fluid rounded">
        </div>
        <div class="col-md-6">
            <h1>{{ $combo->title }}</h1>
            @if ($combo->title_ta)
                <p class="text-muted">{{ $combo->title_ta }}</p>
            @endif
            <h3 class="text-success">₹{{ number_format($combo->price, 2) }}</h3>

            <h5 class="mt-4">Includes:</h5>
            <ul>
                @foreach ($combo->items as $item)
                    <li>
                        {{ $item->name_en }}
                        @if ($item->name_ta) ({{ $item->name_ta }}) @endif
                        — {{ $item->grams }}g
                    </li>
                @endforeach
            </ul>

            @if ($combo->description)
                <h5 class="mt-4">Description</h5>
                <p>{{ $combo->description }}</p>
            @endif

            @if ($combo->additional_info)
                <h5 class="mt-4">Additional Information</h5>
                <p>{{ $combo->additional_info }}</p>
            @endif
        </div>
    </div>
</div>
@endsection
