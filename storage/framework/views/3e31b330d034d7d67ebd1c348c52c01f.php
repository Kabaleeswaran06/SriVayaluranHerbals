<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shop All Categories — Sri Vayaluran Herbals</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Cormorant+Garamond:ital,wght@0,400;0,500;1,400&family=Poppins:wght@300;400;500;600;700&family=Noto+Sans+Tamil&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="icon" type="image/jpeg" href="<?php echo e(asset('images/logoa.jpeg')); ?>">
<style>
:root{
  --forest:#16321F;
  --forest-2:#1F4028;
  --leaf:#3F6B44;
  --leaf-light:#6E9B6E;
  --gold:#C9A227;
  --gold-light:#E4C860;
  --turmeric:#E08A1E;
  --cream:#F4ECD8;
  --cream-2:#FBF7EC;
  --maroon:#7A2E2E;
  --ink:#241A10;
  --font-display:'Cinzel',serif;
  --font-body:'Poppins',sans-serif;
  --font-quote:'Cormorant Garamond',serif;
  --font-ta:'Noto Sans Tamil',sans-serif;
  --ease:cubic-bezier(.22,.68,0,1);
}
*{margin:0;padding:0;box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{
  font-family:var(--font-body);
  background:var(--cream-2);
  color:var(--ink);
  line-height:1.6;
  overflow-x:hidden;
}
@media (prefers-reduced-motion: reduce){
  *{animation-duration:.01ms !important; animation-iteration-count:1 !important; transition-duration:.01ms !important; scroll-behavior:auto !important;}
}
img{max-width:100%;display:block;}
a{color:inherit;text-decoration:none;}
:focus-visible{outline:3px solid var(--gold); outline-offset:3px;}
.container{max-width:1180px;margin:0 auto;padding:0 28px;}

/* ---------- Scroll progress ---------- */
#progress-bar{
  position:fixed; top:0; left:0; height:3px; width:0%;
  background:linear-gradient(90deg,var(--leaf),var(--gold),var(--turmeric));
  z-index:2000; transition:width .1s linear;
}

/* ---------- Header ---------- */
.shop-header{
  position:relative;
  background:
    radial-gradient(circle at 15% 25%, rgba(63,107,68,.5), transparent 55%),
    radial-gradient(circle at 85% 75%, rgba(122,46,46,.35), transparent 55%),
    linear-gradient(160deg,var(--forest) 0%, #0F2416 55%, var(--ink) 100%);
  background-size:220% 220%;
  animation:gradientShift 18s ease infinite;
  color:var(--cream);
  padding:0 0 64px;
  overflow:hidden;
}
@keyframes gradientShift{
  0%{background-position:0% 30%;} 50%{background-position:100% 70%;} 100%{background-position:0% 30%;}
}
.shop-header::after{
  content:''; position:absolute; inset:0;
  background:radial-gradient(ellipse at center, transparent 40%, rgba(0,0,0,.5) 100%);
  pointer-events:none;
}
.leaf-particles{ position:absolute; inset:0; overflow:hidden; pointer-events:none; z-index:1; }
.leaf-particles span{
  position:absolute; opacity:.4; border-radius:0 100% 0 100%; background:var(--leaf-light);
  animation:floatUp linear infinite; will-change:transform;
}
.leaf-particles span.alt{ background:var(--gold-light); border-radius:100% 0 100% 0; }
.leaf-particles span.feather-eye{
  background:none; border-radius:0;
}
@keyframes floatUp{
  0%{ transform:translateY(120%) rotate(0deg); opacity:0; }
  10%{ opacity:.5; }
  90%{ opacity:.45; }
  100%{ transform:translateY(-20%) rotate(360deg); opacity:0; }
}

/* ---------- Peacock signature element ---------- */
.peacock-wrap{
  position:absolute; z-index:1;
  right:-2%; bottom:-6%;
  width:min(46vw, 460px);
  opacity:.9;
  pointer-events:none;
  transform-origin:bottom right;
  animation:peacockDrift 9s ease-in-out infinite;
}
@keyframes peacockDrift{
  0%,100%{ transform:translateY(0) rotate(0deg); }
  50%{ transform:translateY(-6px) rotate(-0.6deg); }
}
.peacock-feather{
  stroke:var(--gold); stroke-width:1.4; fill:none;
  stroke-dasharray:400; stroke-dashoffset:400;
  transform-box:fill-box; transform-origin:bottom center;
  animation:featherOpen 1.4s var(--ease) forwards, featherSway 5.5s ease-in-out infinite;
}
.peacock-eye-outer{ fill:var(--turmeric); opacity:0; animation:featherFillIn .6s var(--ease) forwards; }
.peacock-eye-inner{ fill:var(--forest-2); opacity:0; animation:featherFillIn .6s var(--ease) forwards; }
.peacock-body{
  fill:var(--forest-2); stroke:var(--gold); stroke-width:1.2;
  opacity:0; animation:featherFillIn 1s var(--ease) .15s forwards;
}
@keyframes featherOpen{ to{ stroke-dashoffset:0; } }
@keyframes featherFillIn{ to{ opacity:1; } }
@keyframes featherSway{
  0%,100%{ transform:rotate(0deg); } 50%{ transform:rotate(1.4deg); }
}

@media (max-width:760px){
  .peacock-wrap{ width:min(70vw, 320px); right:-8%; bottom:-4%; opacity:.55; }
}

.shop-nav{
  position:relative; z-index:2;
  display:flex; align-items:center; justify-content:space-between;
  padding:22px 0;
}
.shop-logo{ display:flex; align-items:center; gap:12px; }
.shop-logo img{
  width:44px; height:44px; border-radius:50%; object-fit:cover;
  border:1.5px solid var(--gold);
}
.shop-logo-text{ font-family:var(--font-display); font-size:1.05rem; line-height:1.1; }
.shop-logo-text span{ display:block; font-family:var(--font-body); font-size:.56rem; letter-spacing:.28em; color:var(--gold); text-transform:uppercase; margin-top:3px; font-weight:600; }
.back-home{
  display:inline-flex; align-items:center; gap:8px;
  font-size:.82rem; letter-spacing:.04em; color:var(--cream);
  border:1px solid rgba(244,236,216,.3); padding:9px 18px; border-radius:30px;
  transition:.3s;
}
.back-home:hover{ background:var(--gold); color:var(--ink); border-color:var(--gold); transform:translateY(-2px); }

.shop-hero{ position:relative; z-index:2; text-align:center; padding:36px 0 0; }
.eyebrow{
  font-family:var(--font-body); letter-spacing:.28em; text-transform:uppercase;
  font-size:.7rem; font-weight:600; color:var(--gold-light);
  display:flex; align-items:center; justify-content:center; gap:12px; margin-bottom:16px;
  opacity:0; animation:fadeUp .9s var(--ease) .1s forwards;
}
.eyebrow::before, .eyebrow::after{ content:''; width:30px; height:1px; background:var(--gold); display:inline-block; }
.shop-title{
  font-family:var(--font-display); font-size:clamp(2rem,4.4vw,3.1rem); font-weight:600;
  color:var(--cream); margin-bottom:14px;
  opacity:0; animation:fadeUp .9s var(--ease) .25s forwards;
}
.shop-sub{
  font-family:var(--font-quote); font-style:italic; font-size:1.12rem; color:rgba(244,236,216,.78);
  max-width:520px; margin:0 auto;
  opacity:0; animation:fadeUp .9s var(--ease) .4s forwards;
}
@keyframes fadeUp{ from{opacity:0; transform:translateY(24px);} to{opacity:1; transform:translateY(0);} }

/* ---------- Vine divider ---------- */
.vine-divider{ width:100%; height:50px; display:flex; align-items:center; justify-content:center; margin-top:-1px; position:relative; z-index:2; }
.vine-divider svg{ width:min(640px,88%); height:auto; }
.vine-divider path{ stroke:var(--gold); stroke-dasharray:900; stroke-dashoffset:900; transition:stroke-dashoffset 1.6s var(--ease); }
.vine-divider.in-view path{ stroke-dashoffset:0; }
.vine-divider circle{ fill:var(--turmeric); opacity:0; transition:opacity .6s ease .9s; }
.vine-divider.in-view circle{ opacity:1; }

/* ---------- Category grid ---------- */
.shop-body{ padding:64px 0 100px; }
.count-strip{
  display:flex; justify-content:center; margin-bottom:44px;
  opacity:0; transform:translateY(20px); transition:opacity .7s var(--ease), transform .7s var(--ease);
}
.count-strip.in-view{ opacity:1; transform:translateY(0); }
.count-pill{
  font-size:.78rem; letter-spacing:.05em; color:var(--leaf); background:var(--cream);
  border:1px solid rgba(63,107,68,.25); padding:8px 20px; border-radius:30px; font-weight:500;
}

.cat-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(240px,1fr));
  gap:26px;
}
.cat-card{
  position:relative;
  display:block;
  background:#fff;
  border:1px solid rgba(63,107,68,.16);
  border-radius:14px;
  overflow:hidden;
  box-shadow:0 18px 40px -30px rgba(36,26,16,.4);
  transition:transform .45s var(--ease), box-shadow .45s var(--ease), border-color .45s;
  opacity:0; transform:translateY(30px);
}
.cat-card.in-view{ opacity:1; transform:translateY(0); transition:opacity .7s var(--ease), transform .7s var(--ease); }
.cat-card:hover{
  transform:translateY(-8px);
  box-shadow:0 30px 60px -24px rgba(36,26,16,.35);
  border-color:var(--gold);
}
.cat-img{
  position:relative;
  width:100%; height:168px;
  background:linear-gradient(135deg, var(--cream), #fff);
  display:flex; align-items:center; justify-content:center;
  font-size:2.6rem; overflow:hidden;
}
.cat-img img{ width:100%; height:100%; object-fit:cover; transition:transform .6s var(--ease); }
.cat-card:hover .cat-img img{ transform:scale(1.08); }
.cat-img::after{
  content:''; position:absolute; inset:0;
  background:linear-gradient(180deg, transparent 60%, rgba(22,50,31,.28) 100%);
  opacity:0; transition:opacity .4s;
}
.cat-card:hover .cat-img::after{ opacity:1; }
.cat-ring{
  position:absolute; top:12px; right:12px; z-index:2;
  width:34px; height:34px; border-radius:50%;
  background:rgba(255,255,255,.85); backdrop-filter:blur(4px);
  display:flex; align-items:center; justify-content:center;
  color:var(--gold); font-size:.85rem;
  opacity:0; transform:scale(.7);
  transition:opacity .35s var(--ease), transform .35s var(--ease);
}
.cat-card:hover .cat-ring{ opacity:1; transform:scale(1); }
.cat-body{ padding:20px 20px 24px; position:relative; }
.cat-name-en{
  font-family:var(--font-display); font-weight:600; font-size:1.05rem; color:var(--forest);
  margin-bottom:4px;
}
.cat-name-ta{
  font-family:var(--font-ta); color:var(--maroon); font-size:.86rem; margin-bottom:12px;
}
.cat-count{
  display:inline-flex; align-items:center; gap:6px;
  background:var(--cream); color:var(--leaf);
  font-size:.74rem; font-weight:600; letter-spacing:.03em;
  padding:6px 14px; border-radius:30px;
}
.cat-count i{ color:var(--gold); font-size:.68rem; }

/* Underline sweep on card title */
.cat-name-en::after{
  content:''; display:block; width:0; height:1.5px; background:var(--gold);
  transition:width .4s var(--ease); margin-top:6px;
}
.cat-card:hover .cat-name-en::after{ width:32px; }

.empty{
  text-align:center; color:#8a7f6a; padding:70px 20px;
  opacity:0; transform:translateY(20px); transition:opacity .7s var(--ease), transform .7s var(--ease);
}
.empty.in-view{ opacity:1; transform:translateY(0); }
.empty i{ font-size:2.2rem; color:var(--gold); margin-bottom:14px; display:block; }

/* ---------- Footer strip ---------- */
.shop-footer{
  text-align:center; padding:28px 0; background:var(--ink); color:rgba(244,236,216,.55);
  font-size:.78rem; letter-spacing:.03em;
}
.shop-footer span{ color:var(--gold-light); }

@media (max-width:600px){
  .shop-header{ padding-bottom:48px; }
  .shop-nav{ padding:18px 0; }
  .cat-grid{ grid-template-columns:repeat(auto-fill,minmax(160px,1fr)); gap:16px; }
  .cat-img{ height:130px; }
}
</style>
</head>
<body>

<div id="progress-bar"></div>

<header class="shop-header">

  <div class="peacock-wrap" aria-hidden="true">
    <svg viewBox="0 0 420 380" xmlns="http://www.w3.org/2000/svg">
      <!-- Tail feathers, fanned from a common base point -->
      <g>
        <!-- Feather 1 -->
        <path class="peacock-feather" style="animation-delay:.05s" d="M300 300 C260 220 250 140 300 60"/>
        <circle class="peacock-eye-outer" style="animation-delay:.9s" cx="300" cy="60" r="15"/>
        <circle class="peacock-eye-inner" style="animation-delay:1s" cx="300" cy="60" r="7"/>

        <!-- Feather 2 -->
        <path class="peacock-feather" style="animation-delay:.15s" d="M300 300 C280 210 300 120 360 55"/>
        <circle class="peacock-eye-outer" style="animation-delay:1s" cx="360" cy="55" r="15"/>
        <circle class="peacock-eye-inner" style="animation-delay:1.1s" cx="360" cy="55" r="7"/>

        <!-- Feather 3 (center-ish) -->
        <path class="peacock-feather" style="animation-delay:0s" d="M300 300 C300 200 335 110 340 30"/>
        <circle class="peacock-eye-outer" style="animation-delay:.85s" cx="340" cy="30" r="16"/>
        <circle class="peacock-eye-inner" style="animation-delay:.95s" cx="340" cy="30" r="7.5"/>

        <!-- Feather 4 -->
        <path class="peacock-feather" style="animation-delay:.25s" d="M300 300 C320 210 400 140 410 70"/>
        <circle class="peacock-eye-outer" style="animation-delay:1.1s" cx="410" cy="70" r="14"/>
        <circle class="peacock-eye-inner" style="animation-delay:1.2s" cx="410" cy="70" r="6.5"/>

        <!-- Feather 5 -->
        <path class="peacock-feather" style="animation-delay:.35s" d="M300 300 C230 230 190 160 210 90"/>
        <circle class="peacock-eye-outer" style="animation-delay:1.2s" cx="210" cy="90" r="13"/>
        <circle class="peacock-eye-inner" style="animation-delay:1.3s" cx="210" cy="90" r="6"/>

        <!-- Feather 6 -->
        <path class="peacock-feather" style="animation-delay:.2s" d="M300 300 C250 220 240 130 280 45"/>
        <circle class="peacock-eye-outer" style="animation-delay:.95s" cx="280" cy="45" r="14"/>
        <circle class="peacock-eye-inner" style="animation-delay:1.05s" cx="280" cy="45" r="6.5"/>
      </g>

      <!-- Body + neck + head -->
      <path class="peacock-body" d="M300 300 C296 270 292 250 300 235 C308 220 320 218 322 232 C324 246 314 252 306 250
        C306 250 296 260 296 300 Z"/>
      <ellipse class="peacock-body" cx="313" cy="222" rx="9" ry="12"/>
      <circle class="peacock-body" cx="315" cy="214" r="4.5"/>
    </svg>
  </div>

  <div class="leaf-particles" id="leafParticles"></div>

  <div class="container">
    <nav class="shop-nav">
      <a href="<?php echo e(url('/')); ?>" class="shop-logo">
        <img src="<?php echo e(asset('images/logoa.jpeg')); ?>" alt="Sri Vayaluran Herbals">
        <span class="shop-logo-text">Sri Vayaluran<span>Herbals · Est. 1918</span></span>
      </a>
      <a href="<?php echo e(url('/')); ?>" class="back-home"><i class="fa-solid fa-arrow-left"></i> Back to Home</a>
    </nav>

    <div class="shop-hero">
      <div class="eyebrow">Siddha &amp; Ayurvedic Herbals</div>
      <h1 class="shop-title">Shop by Category</h1>
      <p class="shop-sub">Every jar sorted the way our shop shelves have always been — browse the same remedies, three generations in the making.</p>
    </div>
  </div>
</header>

<div class="vine-divider reveal" id="vine1">
  <svg viewBox="0 0 700 46"><path d="M0 23 Q 87 5 175 23 T 350 23 T 525 23 T 700 23" stroke-width="2" fill="none"/><circle cx="175" cy="23" r="4"/><circle cx="350" cy="23" r="4"/><circle cx="525" cy="23" r="4"/></svg>
</div>

<div class="shop-body">
  <div class="container">
    <?php if($categories->isEmpty()): ?>
      <div class="empty reveal">
        <i class="fa-solid fa-leaf"></i>
        No categories yet — add some from the admin panel.
      </div>
    <?php else: ?>
      <div class="count-strip reveal">
        <span class="count-pill"><?php echo e($categories->count()); ?> <?php echo e(Str::plural('Category', $categories->count())); ?> Available</span>
      </div>

      <div class="cat-grid">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="<?php echo e(route('shop.category', $category)); ?>" class="cat-card reveal-item">
            <div class="cat-img">
              <?php if($category->image_url ?? $category->image ?? false): ?>
                <img src="<?php echo e($category->image_url ?? asset('storage/'.$category->image)); ?>" alt="<?php echo e($category->name_en); ?>">
              <?php else: ?>
                🌿
              <?php endif; ?>
              <div class="cat-ring"><i class="fa-solid fa-arrow-right"></i></div>
            </div>
            <div class="cat-body">
              <p class="cat-name-en"><?php echo e($category->name_en); ?></p>
              <?php if($category->name_ta): ?>
                <p class="cat-name-ta"><?php echo e($category->name_ta); ?></p>
              <?php endif; ?>
              <span class="cat-count"><i class="fa-solid fa-mortar-pestle"></i> <?php echo e($category->products_count); ?> <?php echo e(Str::plural('product', $category->products_count)); ?></span>
            </div>
          </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<div class="shop-footer">
  &copy; <span id="year"></span> <span>Sri Vayaluran Herbals</span> — Prepared with care, since 1918.
</div>

<script>
/* Scroll progress */
const progressBar = document.getElementById('progress-bar');
window.addEventListener('scroll', ()=>{
  const scrollTop = window.scrollY;
  const docHeight = document.documentElement.scrollHeight - window.innerHeight;
  progressBar.style.width = (docHeight > 0 ? (scrollTop / docHeight * 100) : 0) + '%';
});

/* Scroll reveals */
const revealEls = document.querySelectorAll('.reveal, .reveal-item, .vine-divider, .empty, .count-strip');
const io = new IntersectionObserver((entries)=>{
  entries.forEach(entry=>{
    if(entry.isIntersecting){ entry.target.classList.add('in-view'); }
  });
}, {threshold:0.12});
revealEls.forEach(el=> io.observe(el));

/* Stagger the category cards slightly */
document.querySelectorAll('.cat-card').forEach((card, i)=>{
  card.style.transitionDelay = Math.min(i * 60, 480) + 'ms';
});

/* Ambient leaf + feather-eye particles in header */
const particleWrap = document.getElementById('leafParticles');
const featherSVG = `<svg viewBox="0 0 24 30" width="100%" height="100%">
  <path d="M12 30 C6 22 6 10 12 1 C18 10 18 22 12 30 Z" fill="none" stroke="#E4C860" stroke-width="1.2"/>
  <circle cx="12" cy="9" r="4.2" fill="#E08A1E"/>
  <circle cx="12" cy="9" r="1.9" fill="#1F4028"/>
</svg>`;
if (particleWrap) {
  for(let i=0;i<18;i++){
    const isFeather = i % 5 === 0; // roughly 1 in 5 particles is a feather-eye
    const leaf = document.createElement('span');
    leaf.className = (isFeather ? 'feather-eye' : (Math.random() > 0.5 ? 'alt' : ''));
    if (isFeather) leaf.innerHTML = featherSVG;
    const size = isFeather ? (14 + Math.random()*6) : (8 + Math.random()*8);
    leaf.style.width = size+'px';
    leaf.style.height = (size*1.25)+'px';
    leaf.style.left = Math.random()*100 + '%';
    const dur = 10 + Math.random()*10;
    leaf.style.animationDuration = dur+'s' + (isFeather ? ', 7s' : '');
    leaf.style.animationDelay = (Math.random()*10)+'s';
    particleWrap.appendChild(leaf);
  }
}

/* Footer year */
document.getElementById('year').textContent = new Date().getFullYear();
</script>

</body>
</html><?php /**PATH C:\xampp\htdocs\SriVayaluranHerbals\resources\views/shop/index.blade.php ENDPATH**/ ?>