<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>{{ $category->name_en }} — Sri Vayaluran</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Noto+Sans+Tamil&display=swap" rel="stylesheet"/>
  <style>
    :root{
      --green-dark:#1f4d3a;
      --green:#2f7a52;
      --green-light:#eaf5ee;
      --gold:#c8973a;
      --text:#20302a;
      --muted:#5c6d65;
    }
    *{box-sizing:border-box;}
    body{margin:0;font-family:'Inter',sans-serif;color:var(--text);background:#fbfaf7;}
    .cat-header{background:var(--green-dark);color:#fff;padding:2.5rem 1.5rem 2rem;text-align:center;}
    .cat-header p{text-transform:uppercase;letter-spacing:.12em;font-size:.78rem;color:#bcd9c9;margin:0 0 .4rem;}
    .cat-header h1{margin:0;font-size:1.9rem;font-weight:800;}
    .cat-header .ta{
      font-family:'Noto Sans Tamil',sans-serif;
      color:#cfe6d8;
      margin:.3rem 0 0;
      font-size:1rem;
    }
    .crumbs{margin-top:1rem;font-size:.9rem;}
    .crumbs a{color:#eaf5ee;text-decoration:none;}
    .crumbs span{color:#8fb5a1;margin:0 .4rem;}
    .container{max-width:1100px;margin:0 auto;padding:2.5rem 1.5rem 4rem;}
    .prod-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:1.5rem;}
    .prod-card{
      background:#fff;border:1px solid #e4e9e4;border-radius:16px;overflow:hidden;
      text-decoration:none;color:inherit;display:flex;flex-direction:column;
      transition:transform .15s ease, box-shadow .15s ease;
    }
    .prod-card:hover{transform:translateY(-4px);box-shadow:0 10px 24px rgba(31,77,58,.12);border-color:var(--green);}
    .prod-img{width:100%;height:160px;background:var(--green-light);display:flex;align-items:center;justify-content:center;font-size:2.6rem;}
    .prod-img img{width:100%;height:100%;object-fit:cover;}
    .prod-body{padding:1rem 1.1rem 1.2rem;flex:1;display:flex;flex-direction:column;}
    .prod-name{font-weight:700;font-size:1rem;margin:0 0 .2rem;}
    .prod-name-ta{font-family:'Noto Sans Tamil',sans-serif;color:var(--muted);font-size:.85rem;margin:0 0 .5rem;}
    .prod-desc{color:var(--muted);font-size:.85rem;margin:0 0 .8rem;flex:1;}
    .prod-price{font-weight:700;color:var(--green-dark);font-size:.95rem;}
    .prod-price small{font-weight:500;color:var(--muted);}
    .empty{text-align:center;color:var(--muted);padding:3rem 1rem;}
  </style>
</head>
<body>

  <div class="cat-header">
    <p>Sri Vayaluran &middot; Siddha &amp; Ayurvedic Herbals</p>
    <h1>{{ $category->name_en }}</h1>
    @if($category->name_ta)
      <p class="ta">{{ $category->name_ta }}</p>
    @endif
    <div class="crumbs">
      <a href="{{ url('/') }}">Home</a><span>/</span>
      <a href="{{ route('shop.index') }}">All Categories</a><span>/</span>
      <span style="color:#fff;">{{ $category->name_en }}</span>
    </div>
  </div>

  <div class="container">
    @if($products->isEmpty())
      <div class="empty">No products in this category yet.</div>
    @else
      <div class="prod-grid">
        @foreach($products as $product)
          <a href="{{ route('product.show', $product) }}" class="prod-card">
            <div class="prod-img">
              @if($product->image_url ?? $product->image ?? false)
                <img src="{{ $product->image_url ?? asset('storage/'.$product->image) }}" alt="{{ $product->name_en }}">
              @else
                🌿
              @endif
            </div>
            <div class="prod-body">
              <p class="prod-name">{{ $product->name_en }}</p>
              @if($product->name_ta)
                <p class="prod-name-ta">{{ $product->name_ta }}</p>
              @endif
              @if($product->description)
                <p class="prod-desc">{{ Str::limit($product->description, 70) }}</p>
              @endif
              @php $fromPrice = $product->from_price ?? $product->variants->min('price') ?? null; @endphp
              @if($fromPrice)
                <p class="prod-price"><small>From</small> &#8377;{{ number_format($fromPrice, 2) }}</p>
              @endif
            </div>
          </a>
        @endforeach
      </div>
    @endif
  </div>

</body>
</html>
