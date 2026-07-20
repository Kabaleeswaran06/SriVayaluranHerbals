<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Your Cart — Sri Vayaluran</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Noto+Sans+Tamil&display=swap" rel="stylesheet"/>
  <style>
    :root{
      --green-dark:#1f4d3a;
      --green:#2f7a52;
      --green-light:#eaf5ee;
      --gold:#c8973a;
      --text:#20302a;
      --muted:#5c6d65;
      --red:#b3452f;
    }
    *{box-sizing:border-box;}
    body{margin:0;font-family:'Inter',sans-serif;color:var(--text);background:#fbfaf7;}
    .cart-header{background:var(--green-dark);color:#fff;padding:2.5rem 1.5rem 2rem;text-align:center;}
    .cart-header p{text-transform:uppercase;letter-spacing:.12em;font-size:.78rem;color:#bcd9c9;margin:0 0 .4rem;}
    .cart-header h1{margin:0;font-size:1.9rem;font-weight:800;}
    .crumbs{margin-top:1rem;font-size:.9rem;}
    .crumbs a{color:#eaf5ee;text-decoration:none;}
    .crumbs span{color:#8fb5a1;margin:0 .4rem;}
    .container{max-width:900px;margin:0 auto;padding:2.5rem 1.5rem 4rem;}

    .alert{
      background:var(--green-light);color:var(--green-dark);border:1px solid #cfe6d8;
      border-radius:10px;padding:.8rem 1rem;margin-bottom:1.5rem;font-size:.9rem;font-weight:600;
    }

    .cart-line{
      display:flex;align-items:center;gap:1rem;background:#fff;
      border:1px solid #e4e9e4;border-radius:14px;padding:1rem 1.2rem;margin-bottom:1rem;
    }
    .cart-line img, .cart-line .placeholder{
      width:72px;height:72px;border-radius:10px;object-fit:cover;
      background:var(--green-light);display:flex;align-items:center;justify-content:center;
      font-size:1.6rem;flex-shrink:0;
    }
    .cart-line-body{flex:1;min-width:0;}
    .cart-line-name{font-weight:700;font-size:1rem;margin:0 0 .15rem;}
    .cart-line-name-ta{font-family:'Noto Sans Tamil',sans-serif;color:var(--muted);font-size:.85rem;margin:0 0 .3rem;}
    .cart-line-meta{color:var(--muted);font-size:.85rem;margin:0;}
    .cart-line-price{text-align:right;flex-shrink:0;min-width:110px;}
    .cart-line-price .unit{color:var(--muted);font-size:.8rem;display:block;margin-bottom:.1rem;}
    .cart-line-price .sub{font-weight:700;color:var(--green-dark);font-size:1rem;}
    .remove-btn{
      background:none;border:1px solid #e4c9c2;color:var(--red);border-radius:8px;
      padding:.4rem .7rem;font-size:.78rem;font-weight:600;cursor:pointer;flex-shrink:0;
    }
    .remove-btn:hover{background:#fbeceA;}

    .summary{
      background:#fff;border:1px solid #e4e9e4;border-radius:14px;padding:1.3rem 1.4rem;margin-top:1.5rem;
    }
    .summary-row{display:flex;justify-content:space-between;font-size:1.05rem;font-weight:700;color:var(--green-dark);}
    .summary-actions{display:flex;gap:.8rem;margin-top:1.2rem;flex-wrap:wrap;}
    .btn{
      display:inline-block;text-decoration:none;text-align:center;padding:.8rem 1.4rem;
      border-radius:10px;font-weight:700;font-size:.92rem;cursor:pointer;border:none;
    }
    .btn-primary{background:var(--green-dark);color:#fff;flex:1;}
    .btn-primary:hover{background:var(--green);}
    .btn-secondary{background:#fff;color:var(--green-dark);border:1px solid var(--green-dark);}

    .empty{text-align:center;color:var(--muted);padding:3.5rem 1rem;}
    .empty a{color:var(--green-dark);font-weight:700;text-decoration:none;}

    @media(max-width:520px){
      .cart-line{flex-wrap:wrap;}
      .cart-line-price{text-align:left;margin-left:88px;}
    }
  </style>
</head>
<body>

  <div class="cart-header">
    <p>Sri Vayaluran &middot; Siddha &amp; Ayurvedic Herbals</p>
    <h1>Your Cart</h1>
    <div class="crumbs">
      <a href="{{ url('/') }}">Home</a><span>/</span>
      <a href="{{ route('shop.index') }}">Shop</a><span>/</span>
      <span style="color:#fff;">Cart</span>
    </div>
  </div>

  <div class="container">

    @if(session('success'))
      <div class="alert">{{ session('success') }}</div>
    @endif

    @if($lines->isEmpty())
      <div class="empty">
        <p>Your cart is empty.</p>
        <a href="{{ route('shop.index') }}">&larr; Browse the shop</a>
      </div>
    @else
      @foreach($lines as $line)
        @php $variantLabel = $line->variant->label ?? $line->variant->weight ?? $line->variant->size ?? null; @endphp
        <div class="cart-line">
          @if($line->product->image_url ?? $line->product->image ?? false)
            <img src="{{ $line->product->image_url ?? asset('storage/'.$line->product->image) }}" alt="{{ $line->product->name_en }}">
          @else
            <div class="placeholder">🌿</div>
          @endif

          <div class="cart-line-body">
            <p class="cart-line-name">{{ $line->product->name_en }}</p>
            @if($line->product->name_ta)
              <p class="cart-line-name-ta">{{ $line->product->name_ta }}</p>
            @endif
            <p class="cart-line-meta">
              @if($variantLabel){{ $variantLabel }} &middot; @endif
              Qty: {{ $line->qty }}
            </p>
          </div>

          <div class="cart-line-price">
            <span class="unit">&#8377;{{ number_format($line->variant->price, 2) }} each</span>
            <span class="sub">&#8377;{{ number_format($line->lineTotal, 2) }}</span>
          </div>

          <form action="{{ route('cart.remove', $line->variant) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="remove-btn">Remove</button>
          </form>
        </div>
      @endforeach

      <div class="summary">
        <div class="summary-row">
          <span>Total</span>
          <span>&#8377;{{ number_format($total, 2) }}</span>
        </div>
        <div class="summary-actions">
          <a href="{{ route('shop.index') }}" class="btn btn-secondary">Continue Shopping</a>
          <button type="button" class="btn btn-primary" disabled title="Checkout coming soon">Proceed to Checkout</button>
        </div>
      </div>
    @endif

  </div>

</body>
</html>