<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo e($product->name_en); ?> — Sri Vayaluran Herbals</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700;900&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
:root{
  --forest:#16321F; --forest-2:#1F4028; --leaf:#3F6B44; --leaf-light:#6E9B6E;
  --gold:#C9A227; --gold-light:#E4C860; --turmeric:#E08A1E;
  --cream:#F4ECD8; --cream-2:#FBF7EC; --maroon:#7A2E2E; --ink:#241A10;
  --font-display:'Cinzel',serif; --font-body:'Poppins',sans-serif; --font-quote:'Cormorant Garamond',serif;
  --ease:cubic-bezier(.22,.68,0,1);
}
*{margin:0;padding:0;box-sizing:border-box;}
body{ font-family:var(--font-body); background:var(--cream-2); color:var(--ink); line-height:1.6; }
a{ color:inherit; text-decoration:none; }
h1,h2,h3,.font-display{ font-family:var(--font-display); }
.container{ max-width:1200px; margin:0 auto; padding:0 28px; }
.btn{ display:inline-flex; align-items:center; gap:10px; padding:15px 32px; border-radius:4px; font-weight:600; font-size:.86rem; letter-spacing:.05em; text-transform:uppercase; cursor:pointer; border:none; transition:transform .3s var(--ease), box-shadow .3s var(--ease); }
.btn-gold{ background:linear-gradient(120deg,var(--gold),var(--turmeric)); color:var(--ink); }
.btn-gold:hover{ transform:translateY(-3px); box-shadow:0 14px 30px -10px rgba(201,162,39,.55); }
.btn-outline{ border:1.5px solid var(--leaf); color:var(--leaf); background:transparent; }
.btn-outline:hover{ background:rgba(63,107,68,.08); }

/* ---- Top bar ---- */
header{ background:var(--forest); padding:18px 0; position:sticky; top:0; z-index:100; box-shadow:0 10px 30px -20px rgba(0,0,0,.6); }
nav{ display:flex; align-items:center; justify-content:space-between; }
.logo{ font-family:var(--font-display); color:var(--cream); font-size:1.05rem; display:flex; align-items:center; gap:10px; }
.logo i{ color:var(--gold); }
.nav-right{ display:flex; align-items:center; gap:22px; }
.back-link{ color:var(--cream); font-size:.82rem; display:flex; align-items:center; gap:8px; opacity:.85; }
.back-link:hover{ opacity:1; }
.cart-link{ position:relative; color:var(--cream); font-size:1.15rem; }
.cart-badge{
  position:absolute; top:-10px; right:-12px; background:var(--gold); color:var(--ink);
  font-size:.66rem; font-weight:700; min-width:18px; height:18px; border-radius:20px;
  display:flex; align-items:center; justify-content:center; padding:0 4px;
}

/* ---- Breadcrumb ---- */
.breadcrumb{ padding:22px 0 0; font-size:.78rem; color:#8a7f6a; }
.breadcrumb a:hover{ color:var(--leaf); }

/* ---- Product hero ---- */
.product-hero{ padding:34px 0 70px; }
.product-hero-grid{ display:grid; grid-template-columns:1fr 1.05fr; gap:64px; align-items:start; }

.pd-visual{ position:sticky; top:100px; }
.pd-image-frame{
  position:relative; aspect-ratio:1/1.05; border-radius:14px; overflow:hidden;
  background:linear-gradient(160deg,var(--cream) 0%, #ece2c8 100%);
  border:1px solid rgba(201,162,39,.25); box-shadow:0 40px 80px -40px rgba(36,26,16,.5);
  display:flex; align-items:center; justify-content:center;
}
.pd-image-frame img{ width:100%; height:100%; object-fit:cover; }
.pd-image-frame svg{ width:52%; height:auto; filter:drop-shadow(0 20px 30px rgba(0,0,0,.15)); }
.pd-badge-ring{
  position:absolute; top:20px; left:20px; background:rgba(22,50,31,.9); backdrop-filter:blur(6px);
  color:var(--gold-light); font-size:.66rem; letter-spacing:.14em; text-transform:uppercase;
  padding:8px 16px; border-radius:30px; display:flex; align-items:center; gap:8px;
}
.pd-badge-ring i{ font-size:.7rem; }

/* ---- Product info ---- */
.pd-cat{ font-size:.72rem; letter-spacing:.24em; text-transform:uppercase; color:var(--maroon); font-weight:600; margin-bottom:10px; }
.pd-title{ font-size:clamp(1.8rem,3.4vw,2.6rem); color:var(--forest); font-weight:600; line-height:1.15; }
.pd-title-ta{ font-family:var(--font-quote); font-style:italic; color:var(--leaf); font-size:1.2rem; margin-top:6px; }
.pd-desc{ margin:22px 0; color:#4a4030; font-size:.98rem; max-width:520px; }

/* ---- Pack size selector ---- */
.pd-section-label{ font-size:.72rem; letter-spacing:.14em; text-transform:uppercase; color:var(--leaf); font-weight:700; margin:28px 0 12px; }
.pack-options{ display:flex; flex-wrap:wrap; gap:12px; }
.pack-option{
  border:1.5px solid rgba(63,107,68,.3); border-radius:8px; padding:12px 18px; cursor:pointer;
  transition:all .25s var(--ease); background:#fff; text-align:left; min-width:110px;
}
.pack-option .pk-size{ font-weight:600; font-size:.9rem; color:var(--forest); display:block; }
.pack-option .pk-price{ font-family:var(--font-display); color:var(--gold); font-size:1rem; font-weight:700; display:block; margin-top:2px; }
.pack-option.active{ border-color:var(--gold); background:linear-gradient(160deg,#fffaf0,#fdf3dc); box-shadow:0 8px 20px -12px rgba(201,162,39,.5); }
.pack-option.active .pk-size{ color:var(--maroon); }

/* ---- Price + qty + cart ---- */
.pd-buy-row{ display:flex; align-items:center; gap:20px; margin-top:30px; flex-wrap:wrap; }
.pd-price-display{ font-family:var(--font-display); font-size:2.1rem; color:var(--gold); font-weight:700; }
.pd-price-display .unit-label{ font-family:var(--font-body); font-size:.7rem; color:#8a7f6a; text-transform:uppercase; letter-spacing:.08em; display:block; font-weight:600; }
.qty-stepper{ display:flex; align-items:center; border:1.5px solid rgba(63,107,68,.3); border-radius:8px; overflow:hidden; }
.qty-stepper button{ width:40px; height:44px; border:none; background:var(--cream); color:var(--forest); font-size:1.1rem; cursor:pointer; }
.qty-stepper button:hover{ background:var(--gold); color:#fff; }
.qty-stepper input{ width:46px; text-align:center; border:none; font-family:inherit; font-size:1rem; height:44px; }
.add-cart-btn{ flex:1; min-width:220px; justify-content:center; }
.add-cart-btn.added{ background:var(--leaf); color:#fff; }

.pd-toast{
  position:fixed; bottom:30px; right:30px; background:var(--forest); color:var(--cream);
  padding:16px 24px; border-radius:8px; box-shadow:0 20px 40px -15px rgba(0,0,0,.5);
  display:flex; align-items:center; gap:12px; font-size:.88rem; z-index:500;
  opacity:0; transform:translateY(20px); pointer-events:none; transition:all .4s var(--ease);
}
.pd-toast.show{ opacity:1; transform:translateY(0); }
.pd-toast i{ color:var(--gold-light); }

/* ---- Trust badges ---- */
.pd-badges{ display:flex; gap:26px; flex-wrap:wrap; margin-top:34px; padding-top:26px; border-top:1px dashed rgba(63,107,68,.25); }
.pd-badge{ display:flex; align-items:center; gap:9px; font-size:.78rem; color:#5a5142; font-weight:500; }
.pd-badge i{ color:var(--gold); font-size:1.1rem; }

/* ---- Additional details accordion ---- */
.pd-accordion{ margin-top:30px; }
.pd-accordion details{ border-top:1px solid rgba(63,107,68,.15); padding:16px 0; }
.pd-accordion summary{ cursor:pointer; font-weight:600; color:var(--forest); font-size:.92rem; list-style:none; display:flex; justify-content:space-between; align-items:center; }
.pd-accordion summary::-webkit-details-marker{ display:none; }
.pd-accordion summary i{ transition:transform .3s; color:var(--gold); }
.pd-accordion details[open] summary i{ transform:rotate(180deg); }
.pd-accordion .pd-accordion-body{ padding-top:12px; color:#5a5142; font-size:.88rem; }

/* ---- Related products ---- */
.related-section{ padding:60px 0 90px; background:var(--cream); }
.related-head{ margin-bottom:34px; }
.related-head .eyebrow{ font-size:.72rem; letter-spacing:.24em; text-transform:uppercase; color:var(--maroon); font-weight:600; margin-bottom:8px; }
.related-head h2{ font-size:1.6rem; color:var(--forest); font-weight:600; }
.related-grid{ display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:24px; }
.related-card{
  display:block; background:#fff; border-radius:10px; padding:24px 20px; text-align:center;
  border:1px solid rgba(201,162,39,.18); box-shadow:0 16px 34px -26px rgba(36,26,16,.4);
  transition:transform .35s var(--ease), box-shadow .35s var(--ease);
}
.related-card:hover{ transform:translateY(-6px); box-shadow:0 22px 44px -20px rgba(36,26,16,.3); }
.related-card .rc-jar{ width:88px; height:100px; margin:0 auto 14px; }
.related-card h4{ font-size:.94rem; color:var(--forest); margin-bottom:4px; }
.related-card .rc-price{ font-family:var(--font-display); color:var(--gold); font-weight:700; font-size:.94rem; margin-top:6px; }

footer{ background:var(--ink); color:rgba(244,236,216,.6); padding:34px 0; text-align:center; font-size:.8rem; }
footer a:hover{ color:var(--gold-light); }

@media (max-width:900px){
  .product-hero-grid{ grid-template-columns:1fr; gap:34px; }
  .pd-visual{ position:static; }
}
</style>
</head>
<body>

<header>
  <div class="container">
    <nav>
      <a href="<?php echo e(route('home')); ?>" class="logo"><i class="fa-solid fa-leaf"></i> Sri Vayaluran Herbals</a>
      <div class="nav-right">
        <a href="<?php echo e(route('home')); ?>#products" class="back-link"><i class="fa-solid fa-arrow-left"></i> Back to Shop</a>
        <a href="<?php echo e(route('cart.index')); ?>" class="cart-link">
          <i class="fa-solid fa-basket-shopping"></i>
          <span class="cart-badge" id="cartBadge"><?php echo e($cartCount ?? 0); ?></span>
        </a>
      </div>
    </nav>
  </div>
</header>

<div class="container breadcrumb">
  <a href="<?php echo e(route('home')); ?>">Home</a> /
  <a href="<?php echo e(route('home')); ?>#products"><?php echo e($product->category->name_en ?? 'Shop'); ?></a> /
  <span><?php echo e($product->name_en); ?></span>
</div>

<section class="product-hero">
  <div class="container">
    <div class="product-hero-grid">
      <div class="pd-visual">
        <div class="pd-image-frame">
          <div class="pd-badge-ring"><i class="fa-solid fa-mortar-pestle"></i> Hand-Prepared</div>
          <?php if($product->image_url): ?>
            <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name_en); ?>">
          <?php else: ?>
            <?php echo \App\Support\ProductDisplay::visual($product, 260); ?>

          <?php endif; ?>
        </div>
      </div>

      <div class="pd-info">
        <div class="pd-cat"><?php echo e($product->category->name_en ?? 'Sri Vayaluran Herbals'); ?></div>
        <h1 class="pd-title"><?php echo e($product->name_en); ?></h1>
        <?php if($product->name_ta): ?><div class="pd-title-ta"><?php echo e($product->name_ta); ?></div><?php endif; ?>
        <p class="pd-desc"><?php echo e($product->description); ?></p>

        <?php if($product->variants->isNotEmpty()): ?>
          <div class="pd-section-label">Choose Pack Size</div>
          <div class="pack-options" id="packOptions">
            <?php $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <button type="button" class="pack-option <?php echo e($i === 0 ? 'active' : ''); ?>"
                      data-variant-id="<?php echo e($variant->id); ?>"
                      data-price="<?php echo e(\App\Support\ProductDisplay::money($variant->price)); ?>">
                <span class="pk-size"><?php echo e(\App\Support\ProductDisplay::money($variant->value)); ?> <?php echo e($variant->unit); ?></span>
                <span class="pk-price">₹<?php echo e(\App\Support\ProductDisplay::money($variant->price)); ?></span>
              </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <div class="pd-buy-row">
            <div class="pd-price-display">
              <span class="unit-label">Price</span>
              <span id="selectedPrice">₹<?php echo e(\App\Support\ProductDisplay::money($product->variants->first()->price)); ?></span>
            </div>
            <div class="qty-stepper">
              <button type="button" id="qtyMinus">−</button>
              <input type="text" id="qtyInput" value="1" readonly>
              <button type="button" id="qtyPlus">+</button>
            </div>
            <button type="button" class="btn btn-gold add-cart-btn" id="addToCartBtn">
              <i class="fa-solid fa-basket-shopping"></i> Add to Cart
            </button>
          </div>
        <?php else: ?>
          <p style="color:var(--maroon); font-size:.88rem;">This product doesn't have any pack sizes set up yet — check back soon.</p>
        <?php endif; ?>

        <div class="pd-badges">
          <div class="pd-badge"><i class="fa-solid fa-seedling"></i> 100% Natural Herbs</div>
          <div class="pd-badge"><i class="fa-solid fa-mortar-pestle"></i> Hand-Prepared Batches</div>
          <div class="pd-badge"><i class="fa-solid fa-certificate"></i> AYUSH Certified</div>
          <div class="pd-badge"><i class="fa-solid fa-hand-holding-heart"></i> No Preservatives</div>
        </div>

        <?php if($product->additional_details): ?>
          <div class="pd-accordion">
            <details open>
              <summary>Additional Details <i class="fa-solid fa-chevron-down"></i></summary>
              <div class="pd-accordion-body"><?php echo e($product->additional_details); ?></div>
            </details>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php if($related->isNotEmpty()): ?>
  <section class="related-section">
    <div class="container">
      <div class="related-head">
        <div class="eyebrow">More From Our Shelf</div>
        <h2>You Might Also Like</h2>
      </div>
      <div class="related-grid">
        <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="<?php echo e(route('product.show', $rp)); ?>" class="related-card">
            <div class="rc-jar"><?php echo \App\Support\ProductDisplay::visual($rp, 88); ?></div>
            <h4><?php echo e($rp->name_en); ?></h4>
            <?php if($rp->name_ta): ?><div style="font-size:.74rem;color:#8a7f6a;"><?php echo e($rp->name_ta); ?></div><?php endif; ?>
            <div class="rc-price"><?php echo \App\Support\ProductDisplay::priceSummary($rp); ?></div>
          </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<footer>
  <div class="container">
    &copy; <?php echo e(date('Y')); ?> Sri Vayaluran Herbals. All remedies prepared with care, since 1918. ·
    <a href="<?php echo e(route('home')); ?>">Back to Home</a>
  </div>
</footer>

<div class="pd-toast" id="pdToast"><i class="fa-solid fa-circle-check"></i> <span id="pdToastMsg">Added to cart</span></div>

<script>
const productId = <?php echo e($product->id); ?>;
let selectedVariantId = <?php echo e($product->variants->first()->id ?? 'null'); ?>;
let selectedPrice = <?php echo e(\App\Support\ProductDisplay::money($product->variants->first()->price ?? 0)); ?>;

document.querySelectorAll('.pack-option').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.pack-option').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    selectedVariantId = btn.dataset.variantId;
    selectedPrice = parseFloat(btn.dataset.price);
    updatePriceDisplay();
  });
});

const qtyInput = document.getElementById('qtyInput');
document.getElementById('qtyMinus')?.addEventListener('click', () => {
  qtyInput.value = Math.max(1, parseInt(qtyInput.value) - 1);
  updatePriceDisplay();
});
document.getElementById('qtyPlus')?.addEventListener('click', () => {
  qtyInput.value = Math.min(20, parseInt(qtyInput.value) + 1);
  updatePriceDisplay();
});

function updatePriceDisplay(){
  const qty = parseInt(qtyInput?.value || 1);
  const total = (selectedPrice * qty).toFixed(2).replace(/\.?0+$/, '');
  const el = document.getElementById('selectedPrice');
  if (el) el.textContent = '₹' + total;
}

const addBtn = document.getElementById('addToCartBtn');
addBtn?.addEventListener('click', async () => {
  if (!selectedVariantId) return;
  addBtn.disabled = true;

  try {
    const res = await fetch("<?php echo e(route('cart.add')); ?>", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      },
      body: JSON.stringify({
        product_id: productId,
        variant_id: selectedVariantId,
        qty: parseInt(qtyInput.value),
      }),
    });
    const data = await res.json();

    document.getElementById('cartBadge').textContent = data.count;
    addBtn.classList.add('added');
    addBtn.innerHTML = '<i class="fa-solid fa-check"></i> Added to Cart';

    const toast = document.getElementById('pdToast');
    document.getElementById('pdToastMsg').textContent = data.message || 'Added to cart';
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 2600);

    setTimeout(() => {
      addBtn.classList.remove('added');
      addBtn.innerHTML = '<i class="fa-solid fa-basket-shopping"></i> Add to Cart';
      addBtn.disabled = false;
    }, 1800);
  } catch (e) {
    addBtn.disabled = false;
    alert('Could not add to cart — please try again.');
  }
});
</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\SriVayaluranHerbals\resources\views/product-show.blade.php ENDPATH**/ ?>