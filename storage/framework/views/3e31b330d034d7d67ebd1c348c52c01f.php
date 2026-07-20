<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>Shop All Categories — Sri Vayaluran</title>
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
    body{
      margin:0;
      font-family:'Inter',sans-serif;
      color:var(--text);
      background:#fbfaf7;
    }
    .shop-header{
      background:var(--green-dark);
      color:#fff;
      padding:3rem 1.5rem 2.5rem;
      text-align:center;
    }
    .shop-header p{
      text-transform:uppercase;
      letter-spacing:.12em;
      font-size:.8rem;
      color:#bcd9c9;
      margin:0 0 .5rem;
    }
    .shop-header h1{
      margin:0;
      font-size:2.1rem;
      font-weight:800;
    }
    .shop-header a{
      color:#eaf5ee;
      text-decoration:none;
      font-size:.9rem;
    }
    .breadcrumb{margin-bottom:1rem;}
    .container{
      max-width:1100px;
      margin:0 auto;
      padding:2.5rem 1.5rem 4rem;
    }
    .cat-grid{
      display:grid;
      grid-template-columns:repeat(auto-fill,minmax(230px,1fr));
      gap:1.5rem;
    }
    .cat-card{
      display:block;
      background:#fff;
      border:1px solid #e4e9e4;
      border-radius:16px;
      overflow:hidden;
      text-decoration:none;
      color:inherit;
      transition:transform .15s ease, box-shadow .15s ease;
    }
    .cat-card:hover{
      transform:translateY(-4px);
      box-shadow:0 10px 24px rgba(31,77,58,.12);
      border-color:var(--green);
    }
    .cat-img{
      width:100%;
      height:150px;
      background:var(--green-light);
      display:flex;
      align-items:center;
      justify-content:center;
      font-size:2.6rem;
      overflow:hidden;
    }
    .cat-img img{width:100%;height:100%;object-fit:cover;}
    .cat-body{padding:1.1rem 1.2rem 1.4rem;}
    .cat-name-en{
      font-weight:700;
      font-size:1.05rem;
      margin:0 0 .15rem;
    }
    .cat-name-ta{
      font-family:'Noto Sans Tamil',sans-serif;
      color:var(--muted);
      font-size:.9rem;
      margin:0 0 .6rem;
    }
    .cat-count{
      display:inline-block;
      background:var(--green-light);
      color:var(--green-dark);
      font-size:.78rem;
      font-weight:600;
      padding:.25rem .6rem;
      border-radius:999px;
    }
    .empty{
      text-align:center;
      color:var(--muted);
      padding:3rem 1rem;
    }
  </style>
</head>
<body>

  <div class="shop-header">
    <p>Sri Vayaluran &middot; Siddha &amp; Ayurvedic Herbals</p>
    <h1>Shop by Category</h1>
    <div style="margin-top:.75rem;"><a href="<?php echo e(url('/')); ?>">&larr; Back to Home</a></div>
  </div>

  <div class="container">
    <?php if($categories->isEmpty()): ?>
      <div class="empty">No categories yet — add some from the admin panel.</div>
    <?php else: ?>
      <div class="cat-grid">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="<?php echo e(route('shop.category', $category)); ?>" class="cat-card">
            <div class="cat-img">
              <?php if($category->image_url ?? $category->image ?? false): ?>
                <img src="<?php echo e($category->image_url ?? asset('storage/'.$category->image)); ?>" alt="<?php echo e($category->name_en); ?>">
              <?php else: ?>
                🌿
              <?php endif; ?>
            </div>
            <div class="cat-body">
              <p class="cat-name-en"><?php echo e($category->name_en); ?></p>
              <?php if($category->name_ta): ?>
                <p class="cat-name-ta"><?php echo e($category->name_ta); ?></p>
              <?php endif; ?>
              <span class="cat-count"><?php echo e($category->products_count); ?> <?php echo e(Str::plural('product', $category->products_count)); ?></span>
            </div>
          </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php endif; ?>
  </div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\SriVayaluranHerbals\resources\views/shop/index.blade.php ENDPATH**/ ?>