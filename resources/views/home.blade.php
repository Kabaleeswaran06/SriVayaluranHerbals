<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sri Vayaluran Herbals — Three Generations of Ayurveda</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700;900&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
/* ============================================================
   SRI VAYALURAN HERBALS — Design tokens
   Forest #16321F / Leaf #3F6B44 / Aged Gold #C9A227
   Turmeric #E08A1E / Parchment #F4ECD8 / Maroon #7A2E2E / Ink #241A10
   ============================================================ */
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
  --ease:cubic-bezier(.22,.68,0,1);
}
*{margin:0;padding:0;box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{
  font-family:var(--font-body);
  background:var(--cream-2);
  color:var(--ink);
  overflow-x:hidden;
  line-height:1.6;
}
@media (prefers-reduced-motion: reduce){
  *{animation-duration:0.01ms !important; animation-iteration-count:1 !important; transition-duration:0.01ms !important; scroll-behavior:auto !important;}
}
img{max-width:100%;display:block;}
a{color:inherit;text-decoration:none;}
ul{list-style:none;}
button{font-family:inherit;cursor:pointer;border:none;background:none;}
:focus-visible{outline:3px solid var(--gold); outline-offset:3px;}
.container{max-width:1240px;margin:0 auto;padding:0 28px;}
.eyebrow{
  font-family:var(--font-body); letter-spacing:.28em; text-transform:uppercase;
  font-size:.72rem; font-weight:600; color:var(--maroon);
  display:flex; align-items:center; gap:12px; margin-bottom:14px;
}
.eyebrow::before{content:'';width:34px;height:1px;background:var(--gold);display:inline-block;}
h1,h2,h3,.font-display{font-family:var(--font-display);}
.section-title{
  font-size:clamp(1.9rem,4vw,3rem);
  color:var(--forest);
  font-weight:600;
  line-height:1.15;
  margin-bottom:18px;
}
.section-sub{
  font-family:var(--font-quote); font-style:italic; font-size:1.15rem;
  color:var(--leaf); max-width:600px; margin-bottom:44px;
}
.btn{
  display:inline-flex; align-items:center; gap:10px;
  padding:15px 34px; border-radius:2px; font-weight:600; font-size:.86rem;
  letter-spacing:.06em; text-transform:uppercase; cursor:pointer;
  transition:transform .35s var(--ease), box-shadow .35s var(--ease), background .35s;
  position:relative; overflow:hidden;
}
.btn-gold{ background:linear-gradient(120deg,var(--gold),var(--turmeric)); color:var(--ink); }
.btn-gold:hover{ transform:translateY(-3px); box-shadow:0 14px 30px -10px rgba(201,162,39,.55); }
.btn-outline{ border:1.5px solid var(--cream); color:var(--cream); }
.btn-outline:hover{ background:rgba(244,236,216,.12); transform:translateY(-3px); }
.btn::after{
  content:''; position:absolute; inset:0; background:rgba(255,255,255,.35);
  transform:translateX(-120%) skewX(-20deg); transition:transform .6s;
}
.btn:hover::after{ transform:translateX(120%) skewX(-20deg); }

/* ---------- Vine divider signature element ---------- */
.vine-divider{ width:100%; height:46px; display:flex; align-items:center; justify-content:center; }
.vine-divider svg{ width:min(720px,90%); height:auto; }
.vine-divider path{ stroke:var(--gold); stroke-dasharray:900; stroke-dashoffset:900; transition:stroke-dashoffset 1.6s var(--ease); }
.vine-divider.in-view path{ stroke-dashoffset:0; }
.vine-divider circle{ fill:var(--turmeric); opacity:0; transition:opacity .6s ease .9s; }
.vine-divider.in-view circle{ opacity:1; }

/* ---------- Loading screen ---------- */
#loader{
  position:fixed; inset:0; z-index:9999; background:var(--forest);
  display:flex; align-items:center; justify-content:center; flex-direction:column; gap:22px;
  transition:opacity .7s var(--ease), visibility .7s var(--ease);
}
#loader.done{ opacity:0; visibility:hidden; }
.pestle-loader{ width:86px; height:86px; position:relative; }
.pestle-loader .bowl{
  position:absolute; bottom:0; left:50%; transform:translateX(-50%);
  width:70px; height:36px; border:4px solid var(--gold); border-top:none;
  border-radius:0 0 40px 40px;
}
.pestle-loader .stick{
  position:absolute; top:0; left:50%; width:9px; height:52px; background:var(--gold-light);
  border-radius:6px; transform-origin:bottom center;
  animation:grind 1.3s ease-in-out infinite;
}
@keyframes grind{
  0%,100%{ transform:translateX(-26px) rotate(-18deg); }
  50%{ transform:translateX(20px) rotate(16deg); }
}
.loader-text{ font-family:var(--font-display); color:var(--cream); letter-spacing:.32em; font-size:.8rem; text-transform:uppercase; }

/* ---------- Scroll progress ---------- */
#progress-bar{
  position:fixed; top:0; left:0; height:3px; width:0%;
  background:linear-gradient(90deg,var(--leaf),var(--gold),var(--turmeric));
  z-index:2000; transition:width .1s linear;
}

/* ---------- Navbar ---------- */
header{
  position:fixed; top:0; left:0; right:0; z-index:1000;
  padding:20px 0; transition:all .4s var(--ease);
  background:transparent;
}
header.scrolled{
  background:rgba(22,50,31,.94); backdrop-filter:blur(10px);
  padding:12px 0; box-shadow:0 10px 30px -18px rgba(0,0,0,.5);
}
nav{ display:flex; align-items:center; justify-content:space-between; }
.logo{ display:flex; align-items:center; gap:12px; }
.logo-mark{ width:42px; height:42px; flex-shrink:0; }
.logo-text{ font-family:var(--font-display); font-size:1.18rem; color:var(--cream); letter-spacing:.03em; line-height:1.1; }
.logo-text span{ display:block; font-family:var(--font-body); font-size:.58rem; letter-spacing:.32em; color:var(--gold); font-weight:600; margin-top:3px; }
.nav-links{ display:flex; align-items:center; gap:38px; }
.nav-links a{
  font-size:.82rem; letter-spacing:.05em; text-transform:uppercase; font-weight:500;
  color:var(--cream); position:relative; padding:6px 0;
}
.nav-links a::after{
  content:''; position:absolute; left:0; bottom:0; width:0; height:1.5px; background:var(--gold);
  transition:width .35s var(--ease);
}
.nav-links a:hover::after{ width:100%; }
.nav-actions{ display:flex; align-items:center; gap:16px; }
.icon-btn{
  width:38px; height:38px; border-radius:50%; display:flex; align-items:center; justify-content:center;
  color:var(--cream); border:1px solid rgba(244,236,216,.3); transition:all .3s;
}
.icon-btn:hover{ background:var(--gold); color:var(--forest); border-color:var(--gold); transform:translateY(-2px); }
.hamburger{ display:none; flex-direction:column; gap:5px; width:30px; }
.hamburger span{ height:2px; background:var(--cream); border-radius:2px; transition:.3s; }

/* ---------- Hero ---------- */
.hero{
  min-height:100vh; position:relative; display:flex; align-items:center; justify-content:center;
  text-align:center; overflow:hidden; padding:120px 20px 60px;
}
.hero-bg{
  position:absolute; inset:0; z-index:0;
  background:
    radial-gradient(circle at 20% 20%, rgba(63,107,68,.55), transparent 55%),
    radial-gradient(circle at 80% 75%, rgba(122,46,46,.4), transparent 55%),
    linear-gradient(160deg,var(--forest) 0%, #0F2416 55%, var(--ink) 100%);
  background-size:220% 220%;
  animation:gradientShift 18s ease infinite;
}
@keyframes gradientShift{
  0%{background-position:0% 30%;} 50%{background-position:100% 70%;} 100%{background-position:0% 30%;}
}
.hero-bg::after{
  content:''; position:absolute; inset:0;
  background:radial-gradient(ellipse at center, transparent 30%, rgba(0,0,0,.55) 100%);
}
.leaf-particles span{
  position:absolute; opacity:.4; animation:floatUp linear infinite, swayX ease-in-out infinite;
  will-change:transform;
}
.leaf-particles span.shape-leaf{ width:12px; height:18px; background:var(--leaf-light); border-radius:0 100% 0 100%; }
.leaf-particles span.shape-leaf.alt{ background:var(--gold-light); border-radius:100% 0 100% 0; }
.leaf-particles span.shape-seed{ width:6px; height:6px; border-radius:50%; background:var(--turmeric); }
.leaf-particles span.shape-petal{ width:10px; height:14px; border-radius:50% 50% 50% 0; background:var(--gold); transform:rotate(45deg); }
@keyframes floatUp{
  0%{ transform:translateY(110vh) rotate(0deg); opacity:0; }
  8%{ opacity:.55; }
  92%{ opacity:.5; }
  100%{ transform:translateY(-10vh) rotate(360deg); opacity:0; }
}
@keyframes swayX{
  0%,100%{ margin-left:0; }
  50%{ margin-left:var(--sway, 24px); }
}
.hero-grid{
  position:relative; z-index:2; max-width:1200px; width:100%;
  display:grid; grid-template-columns:1.05fr .95fr; gap:60px; align-items:center;
  text-align:left;
}
.hero-content{ max-width:600px; }
.hero-emblem{ width:96px; height:96px; margin:0 0 26px; opacity:0; animation:fadeUp 1s var(--ease) .1s forwards; object-fit:contain; border-radius:50%; border:1.5px solid #C9A227; padding:10px; background:rgba(244,236,216,0.05); }
.hero h1{
  font-size:clamp(2.2rem,4.4vw,3.8rem); color:var(--cream); font-weight:700; line-height:1.1;
  opacity:0; animation:fadeUp 1s var(--ease) .3s forwards;
}
.hero h1 em{ font-style:normal; color:var(--gold-light); }
.hero-tagline{
  font-family:var(--font-quote); font-style:italic; color:var(--cream); font-size:1.3rem;
  margin:22px 0 10px; opacity:.9;
  opacity:0; animation:fadeUp 1s var(--ease) .5s forwards;
}
.hero-desc{
  color:rgba(244,236,216,.72); margin:0 0 38px; font-size:.98rem;
  opacity:0; animation:fadeUp 1s var(--ease) .65s forwards;
}
.hero-actions{ display:flex; gap:18px; justify-content:flex-start; flex-wrap:wrap;
  opacity:0; animation:fadeUp 1s var(--ease) .8s forwards; }

.counters{
  position:relative; z-index:2; margin-top:60px; display:grid; grid-template-columns:repeat(2,1fr);
  gap:20px 14px; max-width:460px; width:100%;
  opacity:0; animation:fadeUp 1s var(--ease) 1s forwards;
}
.counter-card{ text-align:left; padding:0; border-left:2px solid rgba(201,162,39,.4); padding-left:14px; }
.counter-num{ font-family:var(--font-display); font-size:clamp(1.6rem,3vw,2.2rem); color:var(--gold-light); font-weight:700; }
.counter-label{ font-size:.68rem; letter-spacing:.14em; text-transform:uppercase; color:rgba(244,236,216,.65); margin-top:4px; }

/* ---- Shop photo frame (right column) ---- */
.hero-visual{
  position:relative; opacity:0; animation:fadeUp 1s var(--ease) .9s forwards;
}
.hero-shop-frame{ position:relative; width:100%; max-width:440px; margin-left:auto; }
.hero-shop-ring{
  position:absolute; top:-26px; right:-26px; width:130px; height:130px;
  border:1.5px dashed var(--gold); border-radius:50%; z-index:0;
  animation:spinSlow 30s linear infinite;
}
@keyframes spinSlow{ from{ transform:rotate(0deg); } to{ transform:rotate(360deg); } }
.hero-shop-main{
  width:100%; aspect-ratio:4/5; object-fit:cover; border-radius:8px;
  border:1px solid rgba(201,162,39,.35); box-shadow:0 40px 80px -30px rgba(0,0,0,.6);
  position:relative; z-index:1;
}
.hero-shop-float{
  position:absolute; bottom:-28px; left:-28px; width:46%; aspect-ratio:4/3; object-fit:cover;
  border-radius:8px; border:4px solid var(--cream-2); box-shadow:0 26px 50px -20px rgba(0,0,0,.5);
  z-index:2;
}
.hero-shop-badge{
  position:absolute; top:22px; left:-14px; z-index:3;
  background:var(--gold); color:var(--forest); padding:11px 16px; border-radius:6px;
  display:flex; flex-direction:column; align-items:center; line-height:1.1;
  box-shadow:0 14px 30px -12px rgba(0,0,0,.5);
  font-family:var(--font-display);
}
.hero-shop-badge .num{ font-size:.58rem; letter-spacing:.14em; text-transform:uppercase; font-weight:600; }
.hero-shop-badge .year{ font-size:1.05rem; font-weight:700; }

@media (max-width:900px){
  .hero-grid{ grid-template-columns:1fr; text-align:left; }
  .hero-visual{ order:-1; max-width:340px; margin:0 auto 20px; }
  .hero-shop-frame{ margin-left:0; }
}
@keyframes fadeUp{ from{opacity:0; transform:translateY(28px);} to{opacity:1; transform:translateY(0);} }

.counters{
  position:relative; z-index:2; margin-top:70px; display:grid; grid-template-columns:repeat(4,1fr);
  gap:14px; max-width:820px; width:100%;
  opacity:0; animation:fadeUp 1s var(--ease) 1s forwards;
}
.counter-card{ text-align:left; padding:0; border-left:2px solid rgba(201,162,39,.4); padding-left:14px; }
.counter-num{ font-family:var(--font-display); font-size:clamp(1.6rem,3vw,2.2rem); color:var(--gold-light); font-weight:700; }
.counter-label{ font-size:.68rem; letter-spacing:.14em; text-transform:uppercase; color:rgba(244,236,216,.65); margin-top:4px; }

.scroll-cue{
  position:absolute; bottom:26px; left:50%; transform:translateX(-50%); z-index:2;
  color:var(--gold-light); font-size:.68rem; letter-spacing:.24em; text-transform:uppercase;
  display:flex; flex-direction:column; align-items:center; gap:8px;
}
.scroll-cue .line{ width:1px; height:34px; background:linear-gradient(var(--gold-light),transparent); animation:scrollCue 1.8s ease-in-out infinite; }
@keyframes scrollCue{ 0%{transform:scaleY(0); transform-origin:top;} 50%{transform:scaleY(1); transform-origin:top;} 51%{transform-origin:bottom;} 100%{transform:scaleY(0); transform-origin:bottom;} }

/* ---------- Reveal on scroll ---------- */
.reveal{ opacity:0; transform:translateY(38px); transition:opacity .9s var(--ease), transform .9s var(--ease); }
.reveal.in-view{ opacity:1; transform:translateY(0); }
.reveal-stagger > *{ opacity:0; transform:translateY(30px); transition:opacity .7s var(--ease), transform .7s var(--ease); }
.reveal-stagger.in-view > *{ opacity:1; transform:translateY(0); }
.reveal-stagger.in-view > *:nth-child(1){transition-delay:.05s;}
.reveal-stagger.in-view > *:nth-child(2){transition-delay:.15s;}
.reveal-stagger.in-view > *:nth-child(3){transition-delay:.25s;}
.reveal-stagger.in-view > *:nth-child(4){transition-delay:.35s;}
.reveal-stagger.in-view > *:nth-child(5){transition-delay:.45s;}
.reveal-stagger.in-view > *:nth-child(6){transition-delay:.55s;}

section{ padding:110px 0; position:relative; }
.section-cream{ background:var(--cream-2); }
.section-forest{ background:var(--forest); color:var(--cream); }
.section-parchment{ background:var(--cream); }

/* ---------- About / Generations ---------- */
.about-grid{ display:grid; grid-template-columns:1.05fr 1fr; gap:70px; align-items:start; }
.gen-timeline{ display:flex; flex-direction:column; gap:0; position:relative; }
.gen-timeline::before{
  content:''; position:absolute; left:29px; top:14px; bottom:14px; width:2px;
  background:linear-gradient(var(--gold), var(--leaf), var(--maroon));
}
.gen-item{ display:flex; gap:24px; padding:26px 0; position:relative; }
.gen-portrait{
  width:60px; height:60px; border-radius:50%; flex-shrink:0; position:relative; z-index:1;
  border:3px solid var(--cream-2); box-shadow:0 0 0 2px var(--gold);
  display:flex; align-items:center; justify-content:center; background:var(--forest);
}
.gen-portrait svg{ width:60%; }
.gen-copy .gen-num{ font-family:var(--font-display); color:var(--gold); font-size:.72rem; letter-spacing:.2em; text-transform:uppercase; }
.gen-copy h3{ font-size:1.2rem; color:var(--forest); margin:4px 0 6px; }
.gen-copy p{ color:#5a5142; font-size:.92rem; max-width:420px; }

.about-story{
  background:var(--cream); border:1px solid rgba(201,162,39,.35); border-radius:4px;
  padding:44px 38px; position:relative;
}
.about-story::before{
  content:'"'; font-family:var(--font-display); font-size:5rem; color:var(--gold); opacity:.5;
  position:absolute; top:0; left:24px; line-height:1;
}
.about-story p{ font-family:var(--font-quote); font-size:1.18rem; font-style:italic; color:var(--ink); margin-bottom:18px; }
.about-story .sign{ font-family:var(--font-display); color:var(--maroon); font-size:.9rem; letter-spacing:.05em; }
.about-badges{ display:flex; gap:26px; margin-top:34px; flex-wrap:wrap; }
.about-badge{ display:flex; align-items:center; gap:10px; }
.about-badge i{ color:var(--gold); font-size:1.3rem; }
.about-badge span{ font-size:.78rem; color:#5a5142; font-weight:500; }

/* ---------- Products ---------- */
.product-toolbar{
  display:flex; gap:20px; justify-content:space-between; align-items:center; margin-bottom:44px;
  flex-wrap:wrap;
}
.search-box{
  display:flex; align-items:center; gap:10px; background:#fff; border:1px solid rgba(63,107,68,.25);
  border-radius:30px; padding:12px 22px; min-width:280px; flex:1; max-width:380px;
}
.search-box input{ border:none; outline:none; font-family:inherit; font-size:.88rem; width:100%; background:transparent; }
.search-box i{ color:var(--leaf); }
.filter-chips{ display:flex; gap:10px; flex-wrap:wrap; }
.chip{
  padding:9px 20px; border-radius:30px; border:1px solid rgba(63,107,68,.3); font-size:.8rem;
  font-weight:500; color:var(--leaf); transition:all .3s;
}
.chip.active, .chip:hover{ background:var(--leaf); color:#fff; border-color:var(--leaf); }

.product-grid{ display:grid; grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:28px; }
.product-card{
  display:block; color:inherit;
  background:rgba(255,255,255,.6); backdrop-filter:blur(14px); border:1px solid rgba(255,255,255,.5);
  border-radius:10px; padding:26px 22px; text-align:center; cursor:pointer;
  box-shadow:0 18px 40px -28px rgba(36,26,16,.4);
  transition:transform .4s var(--ease), box-shadow .4s var(--ease);
}
.product-card:hover{ transform:translateY(-8px); box-shadow:0 26px 50px -20px rgba(36,26,16,.3); }
.product-jar{ width:96px; height:112px; margin:0 auto 18px; }
.product-card h4{ font-size:1.02rem; color:var(--forest); margin-bottom:6px; }
.product-cat{ font-size:.68rem; letter-spacing:.14em; text-transform:uppercase; color:var(--maroon); margin-bottom:10px; }
.product-price{ font-family:var(--font-display); color:var(--gold); font-weight:700; font-size:1.05rem; }
.product-card.hidden{ display:none; }
.category-group{ margin-bottom:56px; }
.category-group.hidden{ display:none; }
.category-heading{
  display:flex; align-items:baseline; gap:12px; margin-bottom:22px; flex-wrap:wrap;
}
.category-heading h3{ font-size:1.3rem; color:var(--forest); font-weight:600; }
.category-heading .cat-ta{ font-family:var(--font-quote); font-style:italic; color:var(--leaf); font-size:1.05rem; }
.category-more{ font-size:.76rem; color:var(--maroon); margin-top:14px; }
.empty-products{ text-align:center; color:#8a7f6a; padding:40px 0; }
.price-from{ display:block; font-size:.62rem; color:var(--maroon); text-transform:uppercase; letter-spacing:.08em; font-weight:600; margin-bottom:2px; }
.popup-variant-list{ list-style:none; padding:0; margin:0 0 18px; width:100%; }
.popup-variant-list li{ display:flex; justify-content:space-between; padding:8px 0; font-size:.9rem; border-bottom:1px dashed rgba(63,107,68,.2); }
.popup-variant-list li span:last-child{ color:var(--gold); font-weight:600; }

/* Marquee */
.marquee-wrap{ margin-top:70px; display:flex; flex-direction:column; gap:22px; }
.marquee-row{ overflow:hidden; width:100%; -webkit-mask-image:linear-gradient(90deg,transparent,#000 8%,#000 92%,transparent); mask-image:linear-gradient(90deg,transparent,#000 8%,#000 92%,transparent); }
.marquee-track{ display:flex; gap:22px; width:max-content; animation:marqueeLeft 34s linear infinite; }
.marquee-row.reverse .marquee-track{ animation:marqueeRight 34s linear infinite; }
@keyframes marqueeLeft{ from{transform:translateX(0);} to{transform:translateX(-50%);} }
@keyframes marqueeRight{ from{transform:translateX(-50%);} to{transform:translateX(0);} }
.marquee-item{
  flex-shrink:0; width:180px; background:#fff; border-radius:8px; padding:16px; text-align:center;
  box-shadow:0 12px 26px -18px rgba(36,26,16,.4); border:1px solid rgba(201,162,39,.2);
}
.marquee-item svg{ width:56px; height:56px; margin:0 auto 10px; }
.marquee-item span{ font-size:.78rem; font-weight:600; color:var(--forest); }

/* ---------- Process video (landscape autoplay simulated) ---------- */
.process-section{ background:var(--ink); color:var(--cream); }
.process-frame{
  position:relative; width:100%; aspect-ratio:16/8; border-radius:8px; overflow:hidden;
  border:1px solid rgba(201,162,39,.3); box-shadow:0 40px 80px -40px rgba(0,0,0,.7);
}
.process-scene{
  position:absolute; inset:0;
  background:linear-gradient(180deg,#2A4A2E 0%, #16321F 55%, #0F2013 100%);
}
.pot{ position:absolute; bottom:8%; left:50%; transform:translateX(-50%); width:120px; height:70px; background:var(--maroon); border-radius:0 0 60px 60px; box-shadow:0 0 0 6px #5c1f1f; }
.pot::before{ content:''; position:absolute; top:-10px; left:-8px; right:-8px; height:14px; background:#5c1f1f; border-radius:50%; }
.steam{ position:absolute; bottom:35%; width:10px; height:60px; background:linear-gradient(rgba(244,236,216,.5),transparent); border-radius:50%; filter:blur(3px); animation:steamRise 3s ease-in infinite; }
.steam1{ left:47%; animation-delay:0s;} .steam2{ left:50%; animation-delay:1s;} .steam3{ left:53%; animation-delay:2s;}
@keyframes steamRise{ 0%{ transform:translateY(0) scaleX(1); opacity:.7;} 100%{ transform:translateY(-90px) scaleX(2); opacity:0;} }
.scene-leaf{ position:absolute; width:22px; height:34px; background:var(--leaf-light); opacity:.5; border-radius:0 100% 0 100%; animation:sway 6s ease-in-out infinite; }
.process-caption{ position:absolute; left:24px; bottom:20px; z-index:3; }
.process-caption .eyebrow{ color:var(--gold-light); }
.process-caption h3{ font-family:var(--font-display); font-size:1.4rem; color:var(--cream); }
.play-badge{
  position:absolute; top:20px; right:20px; display:flex; align-items:center; gap:8px;
  background:rgba(0,0,0,.4); backdrop-filter:blur(6px); padding:8px 16px; border-radius:30px;
  font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:var(--cream);
}
.play-badge .dot{ width:7px; height:7px; border-radius:50%; background:#e03e3e; animation:pulseDot 1.4s ease-in-out infinite; }
@keyframes pulseDot{ 0%,100%{opacity:1;} 50%{opacity:.25;} }
@keyframes sway{ 0%,100%{transform:rotate(-8deg);} 50%{transform:rotate(8deg);} }

/* ---------- Testimonials ---------- */
.testimonial-carousel{ position:relative; max-width:760px; margin:0 auto; min-height:280px; }
.t-card{
  position:absolute; inset:0; background:rgba(255,255,255,.7); backdrop-filter:blur(14px);
  border:1px solid rgba(255,255,255,.5); border-radius:12px; padding:46px 50px; text-align:center;
  opacity:0; transform:translateX(40px) scale(.97); transition:all .7s var(--ease); pointer-events:none;
}
.t-card.active{ opacity:1; transform:translateX(0) scale(1); pointer-events:auto; position:relative; }
.t-stars{ color:var(--turmeric); margin-bottom:16px; font-size:.9rem; letter-spacing:3px; }
.t-quote{ font-family:var(--font-quote); font-style:italic; font-size:1.28rem; color:var(--ink); margin-bottom:22px; }
.t-avatar{ width:52px; height:52px; border-radius:50%; margin:0 auto 10px; background:var(--forest); display:flex; align-items:center; justify-content:center; color:var(--gold); font-family:var(--font-display); font-weight:700; }
.t-name{ font-weight:600; color:var(--forest); font-size:.92rem; }
.t-role{ font-size:.72rem; color:var(--maroon); letter-spacing:.1em; text-transform:uppercase; }
.t-dots{ display:flex; justify-content:center; gap:10px; margin-top:30px; }
.t-dots button{ width:9px; height:9px; border-radius:50%; background:rgba(63,107,68,.3); transition:.3s; }
.t-dots button.active{ background:var(--gold); width:26px; border-radius:6px; }

/* ---------- Brands ---------- */
.brand-grid{ display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:18px; }
.brand-plate{
  background:#fff; border:1px solid rgba(63,107,68,.18); border-radius:8px; padding:22px 10px;
  display:flex; flex-direction:column; align-items:center; gap:8px; filter:grayscale(1); opacity:.65;
  transition:all .4s;
}
.brand-plate:hover{ filter:grayscale(0); opacity:1; transform:translateY(-4px); border-color:var(--gold); }
.brand-plate i{ font-size:1.5rem; color:var(--leaf); }
.brand-plate span{ font-size:.7rem; font-weight:600; color:var(--ink); letter-spacing:.03em; text-align:center; }

/* ---------- Contact ---------- */
.contact-grid{ display:grid; grid-template-columns:1fr 1.1fr; gap:60px; }
.contact-info-item{ display:flex; gap:18px; margin-bottom:28px; }
.contact-info-item i{ width:44px; height:44px; border-radius:50%; background:rgba(201,162,39,.15); color:var(--gold); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.contact-info-item h4{ color:var(--cream); font-size:.95rem; margin-bottom:4px; }
.contact-info-item p{ color:rgba(244,236,216,.68); font-size:.88rem; }
.map-plate{ margin-top:20px; height:170px; border-radius:8px; border:1px dashed rgba(201,162,39,.4); background:repeating-linear-gradient(135deg,rgba(201,162,39,.06) 0 12px,transparent 12px 24px); display:flex; align-items:center; justify-content:center; color:rgba(244,236,216,.5); font-size:.78rem; letter-spacing:.1em; text-transform:uppercase; }
.contact-form{ background:var(--cream-2); border-radius:10px; padding:40px; box-shadow:0 30px 60px -30px rgba(0,0,0,.4); }
.form-row{ display:grid; grid-template-columns:1fr 1fr; gap:16px; }
.field{ margin-bottom:18px; }
.field label{ display:block; font-size:.74rem; letter-spacing:.08em; text-transform:uppercase; color:var(--leaf); margin-bottom:7px; font-weight:600; }
.field input, .field textarea{
  width:100%; padding:13px 15px; border:1px solid rgba(63,107,68,.3); border-radius:5px;
  font-family:inherit; font-size:.9rem; background:#fff; transition:border .3s, box-shadow .3s;
}
.field input:focus, .field textarea:focus{ border-color:var(--gold); box-shadow:0 0 0 3px rgba(201,162,39,.15); outline:none; }
.contact-form .btn-gold{ width:100%; justify-content:center; margin-top:6px; }

/* ---------- Footer ---------- */
footer{ background:var(--ink); color:rgba(244,236,216,.6); padding:60px 0 24px; }
.footer-grid{ display:grid; grid-template-columns:1.4fr 1fr 1fr 1fr; gap:40px; margin-bottom:44px; }
.footer-grid h5{ color:var(--gold); font-family:var(--font-display); font-size:.9rem; margin-bottom:16px; letter-spacing:.05em; }
.footer-grid p, .footer-grid li{ font-size:.85rem; margin-bottom:10px; }
.footer-grid li a:hover{ color:var(--gold-light); }
.footer-social{ display:flex; gap:12px; margin-top:14px; }
.footer-social a{ width:34px; height:34px; border-radius:50%; border:1px solid rgba(244,236,216,.2); display:flex; align-items:center; justify-content:center; transition:.3s; }
.footer-social a:hover{ background:var(--gold); color:var(--ink); border-color:var(--gold); }
.footer-bottom{ border-top:1px solid rgba(244,236,216,.12); padding-top:22px; text-align:center; font-size:.78rem; }

/* ---------- Floating buttons ---------- */
.floating-btns{ position:fixed; right:24px; bottom:24px; z-index:900; display:flex; flex-direction:column; gap:14px; align-items:flex-end; }
.fab{
  width:56px; height:56px; border-radius:50%; display:flex; align-items:center; justify-content:center;
  color:#fff; font-size:1.3rem; box-shadow:0 14px 30px -10px rgba(0,0,0,.4); transition:transform .3s;
}
.fab:hover{ transform:scale(1.1); }
.fab-whatsapp{ background:#25D366; }
.fab-call{ background:var(--maroon); }
.fab-top{
  width:44px; height:44px; background:var(--forest); color:var(--gold); opacity:0; pointer-events:none;
  transition:opacity .3s, transform .3s;
}
.fab-top.show{ opacity:1; pointer-events:auto; }

/* ---------- Modal (login) ---------- */
.modal-overlay{
  position:fixed; inset:0; background:rgba(15,25,17,.7); backdrop-filter:blur(6px); z-index:3000;
  display:flex; align-items:center; justify-content:center; opacity:0; pointer-events:none; transition:opacity .35s;
  padding:20px;
}
.modal-overlay.open{ opacity:1; pointer-events:auto; }
.modal-box{
  background:var(--cream-2); border-radius:10px; width:100%; max-width:400px; padding:40px 34px;
  position:relative; transform:translateY(20px) scale(.97); transition:transform .35s var(--ease);
  border-top:4px solid var(--gold);
}
.modal-overlay.open .modal-box{ transform:translateY(0) scale(1); }
.modal-close{ position:absolute; top:16px; right:16px; font-size:1.1rem; color:var(--leaf); }
.modal-tabs{ display:flex; gap:6px; margin-bottom:24px; background:rgba(63,107,68,.1); border-radius:30px; padding:4px; }
.modal-tabs button{ flex:1; padding:10px; border-radius:30px; font-size:.8rem; font-weight:600; color:var(--leaf); }
.modal-tabs button.active{ background:var(--forest); color:var(--cream); }
.modal-box h3{ font-family:var(--font-display); color:var(--forest); font-size:1.3rem; margin-bottom:22px; text-align:center; }

/* ---------- Product popup ---------- */
.popup-body{ display:flex; flex-direction:column; align-items:center; text-align:center; gap:6px; }
.popup-body .product-jar{ width:120px; height:140px; }
.popup-body h3{ color:var(--forest); font-family:var(--font-display); font-size:1.35rem; }
.popup-body .product-cat{ margin-bottom:4px; }
.popup-body p.desc{ color:#5a5142; font-size:.9rem; margin:10px 0 18px; }
.popup-body .product-price{ font-size:1.3rem; margin-bottom:20px; }

/* ---------- Responsive ---------- */
@media (max-width:980px){
  .about-grid, .contact-grid{ grid-template-columns:1fr; }
  .footer-grid{ grid-template-columns:1fr 1fr; }
  .counters{ grid-template-columns:repeat(2,1fr); row-gap:26px; }
}
@media (max-width:760px){
  .nav-links{ position:fixed; top:0; right:0; height:100vh; width:78%; max-width:320px;
    background:var(--forest); flex-direction:column; justify-content:center; gap:30px;
    transform:translateX(100%); transition:transform .45s var(--ease); }
  .nav-links.open{ transform:translateX(0); }
  .hamburger{ display:flex; }
  .form-row{ grid-template-columns:1fr; }
  .footer-grid{ grid-template-columns:1fr; }
  section{ padding:76px 0; }
  .product-toolbar{ flex-direction:column; align-items:stretch; }
  .search-box{ max-width:none; }
}
.gen-portrait img{
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
}
.process-video{
  position:absolute; inset:0; width:100%; height:100%; object-fit:cover; z-index:0;
}
.map-plate{ margin-top:20px; height:170px; border-radius:8px; border:1px dashed rgba(201,162,39,.4); background:repeating-linear-gradient(135deg,rgba(201,162,39,.06) 0 12px,transparent 12px 24px); display:flex; align-items:center; justify-content:center; color:rgba(244,236,216,.5); font-size:.78rem; letter-spacing:.1em; text-transform:uppercase; }
.map-plate{ margin-top:20px; height:260px; border-radius:8px; overflow:hidden; border:1px solid rgba(201,162,39,.3); }
.map-plate iframe{ display:block; }
.combo-carousel-section .carousel-inner img {
    width: 100%;
    aspect-ratio: 1248 / 502;
    object-fit: cover;
}
</style>
</head>
<body>

<!-- LOADER -->
<div id="loader">
  <div class="pestle-loader">
    <div class="bowl"></div>
    <div class="stick"></div>
  </div>
  <div class="loader-text">Sri Vayaluran Herbals</div>
</div>

<div id="progress-bar"></div>

<!-- NAVBAR -->
<header id="siteHeader">
  <div class="container">
    <nav>
      <a href="#home" class="logo">
        <svg class="logo-mark" viewBox="0 0 100 100" fill="none">
          <circle cx="50" cy="50" r="47" stroke="#C9A227" stroke-width="2"/>
          <path d="M50 78C50 78 30 62 30 42C30 29 39 20 50 20C61 20 70 29 70 42C70 62 50 78 50 78Z" fill="#3F6B44"/>
          <path d="M50 78V30" stroke="#C9A227" stroke-width="1.5"/>
        </svg>
        <span class="logo-text">Sri Vayaluran<span>Herbals · Est. 1918</span></span>
      </a>
      <ul class="nav-links" id="navLinks">
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#products">Products</a></li>
        <li><a href="#process">Our Craft</a></li>
        <li><a href="#reviews">Reviews</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
      <div class="nav-actions">
        <button class="icon-btn" aria-label="User login" onclick="openModal('user')"><i class="fa-solid fa-user"></i></button>
        <a href="{{ route('admin.login') }}" class="icon-btn" aria-label="Admin login"><i class="fa-solid fa-shield-halved"></i></a>
        <button class="hamburger" id="hamburger" aria-label="Menu"><span></span><span></span><span></span></button>
      </div>
    </nav>
  </div>
</header>

<!-- HERO -->
<section class="hero" id="home">
  <div class="hero-bg"></div>
  <div class="leaf-particles" id="leafParticles"></div>
  <div class="hero-grid">
    <div class="hero-content">
      <img src="{{ asset('images/logo3.png') }}" alt="Sri Vayaluran Herbals" class="hero-emblem">
      <h1>Rooted in <em>1918.</em><br>Trusted for Life.</h1>
      <p class="hero-tagline">Three generations. One promise of purity.</p>
      <p class="hero-desc">From my grandfather's first mortar and pestle to the shelves you browse today, Sri Vayaluran Herbals has spent over a century preparing Ayurvedic remedies the way they were meant to be made — slow, honest, and by hand.</p>
      <div class="hero-actions">
        <a href="#products" class="btn btn-gold"><i class="fa-solid fa-leaf"></i> Explore Products</a>
        <a href="#about" class="btn btn-outline"><i class="fa-solid fa-book-open"></i> Our Heritage</a>
      </div>
      <div class="counters">
        <div class="counter-card"><div class="counter-num" data-target="107">0</div><div class="counter-label">Years of Trust</div></div>
        <div class="counter-card"><div class="counter-num" data-target="180">0</div><div class="counter-label">Herbal Products</div></div>
        <div class="counter-card"><div class="counter-num" data-target="52000">0</div><div class="counter-label">Families Served</div></div>
        <div class="counter-card"><div class="counter-num" data-target="3">0</div><div class="counter-label">Generations</div></div>
      </div>
    </div>

    <div class="hero-visual">
      <div class="hero-shop-frame">
        <div class="hero-shop-ring"></div>
        <img src="{{ asset('images/shop-main.jpeg') }}" alt="Sri Vayaluran Herbals shop front" class="hero-shop-main">
        <img src="{{ asset('images/shop-detail.png') }}" alt="Inside Sri Vayaluran Herbals" class="hero-shop-float">
        <div class="hero-shop-badge"><span class="num">Est.</span><span class="year">1918</span></div>
      </div>
    </div>
  </div>
  <div class="scroll-cue"><span>Scroll</span><span class="line"></span></div>
</section>

<!-- ABOUT -->
<section class="section-cream" id="about">
  <div class="container">
    <div class="eyebrow reveal">Our Story</div>
    <h2 class="section-title reveal">A Shop Built by Three Pairs of Hands</h2>
    <p class="section-sub reveal">Every jar on our shelf carries a little of my grandfather, a little of my father, and a little of what I hope to leave behind.</p>

    <div class="about-grid">
      <div class="gen-timeline reveal-stagger">
        <div class="gen-item">
          <div class="gen-portrait">
            <img src="images/sadiyan.jpeg">
          </div>
          <div class="gen-copy">
            <div class="gen-num">Generation One · 1918</div>
            <h3>Sadiyan Chettiyar</h3>
            <p>Began mixing remedies from a single room behind the temple tank, using recipes passed down orally through his own teacher — no shop, no signage, just word of mouth and results.</p>
          </div>
        </div>
        <div class="gen-item">
          <div class="gen-portrait">
           <img src="images/santhanam.jpeg">
          </div>
          <div class="gen-copy">
            <div class="gen-num">Generation Two · 1962</div>
            <h3>Santhanam Chettiyar</h3>
            <p>Opened our first proper storefront and began documenting every formulation in writing, while still grinding each batch by hand in the back room exactly as his father had taught him.</p>
          </div>
        </div>
        <div class="gen-item">
          <div class="gen-portrait">
            <img src="images/kasi.jpeg">
          </div>
          <div class="gen-copy">
            <div class="gen-num">Generation Three · Today</div>
            <h3>Kasi Viswanathan</h3>
            <p>Carries the family forward — sourcing herbs from the same trusted growers, keeping every recipe unchanged, and simply making it easier for you to find us.</p>
          </div>
        </div>
      </div>

      <div>
        <div class="about-story">
          <p>We have never once changed a recipe to cut a cost, and we never will. What my grandfather ground by hand, we still grind the same way — only now, we can tell you about it.</p>
          <div class="sign">— The Vayaluran Family</div>
        </div>
        <div class="about-badges">
          <div class="about-badge"><i class="fa-solid fa-seedling"></i><span>100% Natural Herbs</span></div>
          <div class="about-badge"><i class="fa-solid fa-mortar-pestle"></i><span>Hand-Prepared Batches</span></div>
          <div class="about-badge"><i class="fa-solid fa-certificate"></i><span>AYUSH Certified</span></div>
          <div class="about-badge"><i class="fa-solid fa-hand-holding-heart"></i><span>No Preservatives</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="vine-divider reveal" id="vine1">
  <svg viewBox="0 0 700 46"><path d="M0 23 Q 87 5 175 23 T 350 23 T 525 23 T 700 23" stroke-width="2" fill="none"/><circle cx="175" cy="23" r="4"/><circle cx="350" cy="23" r="4"/><circle cx="525" cy="23" r="4"/></svg>
</div>

<!-- PRODUCTS -->
<section class="section-parchment" id="products">
  <div class="container">
    <div class="eyebrow reveal">Our Shelf</div>
    <h2 class="section-title reveal">Remedies We Still Make By Hand</h2>
    <p class="section-sub reveal">Search or filter to find what your household has always trusted us for.</p>

    
    @php
      $allProducts = $categories->flatMap->products;
    @endphp

    <div class="product-toolbar reveal">
      <div class="search-box">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" id="productSearch" placeholder="Search products — e.g. Thiripala Choora...">
      </div>
      <div class="filter-chips" id="filterChips">
        <button class="chip active" data-filter="all">All</button>
        @foreach ($categories as $cat)
          <button class="chip" data-filter="{{ $cat->id }}">{{ $cat->name_en }}</button>
        @endforeach
      </div>
    </div>

    <div id="productCategories">
      @forelse ($categories as $cat)
        <div class="category-group reveal-stagger in-view" data-cat="{{ $cat->id }}">
          <div class="category-heading">
            <h3>{{ $cat->name_en }}</h3>
            @if ($cat->name_ta)<span class="cat-ta">{{ $cat->name_ta }}</span>@endif
          </div>
          <div class="product-grid">
            @foreach ($cat->products as $product)
              <a href="{{ route('product.show', $product) }}" class="product-card" data-name="{{ strtolower($product->name_en) }}">
                <div class="product-jar">{!! \App\Support\ProductDisplay::visual($product, 96) !!}</div>
                <div class="product-cat">{{ $cat->name_en }}</div>
                <h4>{{ $product->name_en }}</h4>
                @if ($product->name_ta)<div class="tamil-text" style="font-size:.78rem;color:#8a7f6a;margin-bottom:6px;">{{ $product->name_ta }}</div>@endif
                <div class="product-price">{!! \App\Support\ProductDisplay::priceSummary($product) !!}</div>
              </a>
            @endforeach
          </div>
          @if ($cat->total_products > $cat->showing_count)
            <p class="category-more"><i class="fa-solid fa-circle-info"></i> Showing {{ $cat->showing_count }} of {{ $cat->total_products }} — more available in-store.</p>
          @endif
        </div>
      @empty
        <p class="empty-products">No products to show yet — check back soon.</p>
      @endforelse
    </div>

    @if ($allProducts->isNotEmpty())
      <div class="marquee-wrap">
        <div class="marquee-row">
          <div class="marquee-track">
            @for ($i = 0; $i < 2; $i++)
              @foreach ($allProducts->take(6) as $product)
                <div class="marquee-item">{!! \App\Support\ProductDisplay::visual($product, 56) !!}<span>{{ $product->name_en }}</span></div>
              @endforeach
            @endfor
          </div>
        </div>
        <div class="marquee-row reverse">
          <div class="marquee-track">
            @for ($i = 0; $i < 2; $i++)
              @foreach ($allProducts->reverse()->take(6) as $product)
                <div class="marquee-item">{!! \App\Support\ProductDisplay::visual($product, 56) !!}<span>{{ $product->name_en }}</span></div>
              @endforeach
            @endfor
          </div>
        </div>
      </div>
    @endif
  </div>
</section>

<div class="vine-divider reveal" id="vine2">
  <svg viewBox="0 0 700 46"><path d="M0 23 Q 87 5 175 23 T 350 23 T 525 23 T 700 23" stroke-width="2" fill="none"/><circle cx="175" cy="23" r="4"/><circle cx="350" cy="23" r="4"/><circle cx="525" cy="23" r="4"/></svg>
</div>
{{-- Combo Packs Carousel Section --}}
@if ($combos->isNotEmpty())
<section class="combo-carousel-section py-4">
    <div class="container">
        <h2 class="text-center mb-4">Combo Packs</h2>

        <div id="comboCarousel" class="carousel slide" data-bs-ride="carousel">

            {{-- Indicators --}}
            <div class="carousel-indicators">
                @foreach ($combos as $i => $combo)
                    <button type="button" data-bs-target="#comboCarousel" data-bs-slide-to="{{ $i }}"
                            class="{{ $i === 0 ? 'active' : '' }}"
                            aria-current="{{ $i === 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $i + 1 }}"></button>
                @endforeach
            </div>

            {{-- Slides --}}
            <div class="carousel-inner rounded shadow-sm">
                @foreach ($combos as $i => $combo)
                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                        <a href="{{ route('combos.show', $combo->slug) }}">
                            <img src="{{ Storage::url($combo->banner_image) }}"
                                 class="d-block w-100"
                                 alt="{{ $combo->title }}">
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Controls --}}
            <button class="carousel-control-prev" type="button" data-bs-target="#comboCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#comboCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
@endif
<!-- PROCESS / VIDEO -->
<section class="process-section" id="process">
  <div class="container">
    <div class="eyebrow reveal">Our Craft</div>
    <h2 class="section-title reveal" style="color:var(--cream)">Watch How Each Batch Is Made</h2>
    <p class="section-sub reveal" style="color:var(--leaf-light)">The same slow, wood-fire process my grandfather used — nothing rushed, nothing skipped.</p>

    <div class="process-frame reveal">
      <video class="process-video" autoplay muted loop playsinline poster="{{ asset('images/shop-detail.jpg') }}">
        <source src="{{ asset('videos/process.mp4') }}" type="video/mp4">
      </video>
      <div class="play-badge"><span class="dot"></span> Live at our kitchen</div>
      <div class="process-caption">
        <div class="eyebrow" style="margin-bottom:6px;">01 · Slow Simmer</div>
        <h3>Herbs, ghee, and patience — three hours, no shortcuts.</h3>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="section-cream" id="reviews">
  <div class="container">
    <div class="eyebrow reveal" style="justify-content:center;">Customer Voices</div>
    <h2 class="section-title reveal" style="text-align:center;">Three Generations of Families, Not Just Ours</h2>

    @if ($reviews->isNotEmpty())
      <div class="testimonial-carousel reveal" id="tCarousel">
        @foreach ($reviews as $review)
          <div class="t-card {{ $loop->first ? 'active' : '' }}">
            <div class="t-stars">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</div>
            <p class="t-quote">"{{ $review->review_text }}"</p>
            <div class="t-avatar">{{ strtoupper(substr($review->customer_name, 0, 1)) }}</div>
            <div class="t-name">{{ $review->customer_name }}</div>
            <div class="t-role">{{ $review->role }}</div>
          </div>
        @endforeach
      </div>
      <div class="t-dots" id="tDots"></div>
    @else
      <p class="empty-products" style="text-align:center;">No featured reviews yet — mark some as featured in the admin panel.</p>
    @endif
  </div>
</section>

<!-- BRANDS -->
<section class="section-parchment">
  <div class="container">
    <div class="eyebrow reveal">Trusted Partners</div>
    <h2 class="section-title reveal">The Growers &amp; Certifiers Behind Our Herbs</h2>
    <div class="brand-grid reveal-stagger">
      <div class="brand-plate"><i class="fa-solid fa-award"></i><span>AYUSH Certified</span></div>
      <div class="brand-plate"><i class="fa-solid fa-leaf"></i><span>Western Ghats Growers Co-op</span></div>
      <div class="brand-plate"><i class="fa-solid fa-flask"></i><span>Tamil Nadu Herbal Board</span></div>
      <div class="brand-plate"><i class="fa-solid fa-seedling"></i><span>Organic Farms Collective</span></div>
      <div class="brand-plate"><i class="fa-solid fa-shield-heart"></i><span>ISO 9001 Quality</span></div>
      <div class="brand-plate"><i class="fa-solid fa-mountain-sun"></i><span>Nilgiris Herb Traders</span></div>
    </div>
  </div>
</section>

<!-- CONTACT -->
<section class="section-forest" id="contact">
  <div class="container">
    <div class="contact-grid">
      <div class="reveal">
        <div class="eyebrow">Visit Us</div>
        <h2 class="section-title" style="color:var(--cream)">Come See the Shop That Started It All</h2>
        <div class="contact-info-item">
          <i class="fa-solid fa-location-dot"></i>
          <div><h4>Address</h4><p>110, Big Bazaar Street, Tiruchirapalli , Tamil Nadu 620008</p></div>
        </div>
        <div class="contact-info-item">
          <i class="fa-solid fa-phone"></i>
          <div><h4>Call Us</h4><p>+91 9942716135 · +91 6369323238</p></div>
        </div>
        <div class="contact-info-item">
          <i class="fa-solid fa-clock"></i>
          <div><h4>Shop Hours</h4><p>Mon–Sat: 9:00 AM – 8:30 PM · Sun: 10:00 AM – 1:00 PM</p></div>
        </div>
        <div class="contact-info-item">
          <i class="fa-solid fa-envelope"></i>
          <div><h4>Email</h4><p>kasiviswanathan110@gmail.com</p></div>
        </div>
        <div class="map-plate">
          <iframe
            src="https://www.google.com/maps?q=Sri+Vayaluran+Naattu+Marunthu+Vyabaram,10.8213643,78.6970539&output=embed"
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>

      <form class="contact-form reveal" onsubmit="return handleContactSubmit(event)">
        <h3 style="font-family:var(--font-display); color:var(--forest); margin-bottom:22px; font-size:1.3rem;">Send Us a Message</h3>
        <div class="form-row">
          <div class="field"><label>Name</label><input type="text" required placeholder="Your name"></div>
          <div class="field"><label>Phone</label><input type="tel" required placeholder="Your phone number"></div>
        </div>
        <div class="field"><label>Email</label><input type="email" required placeholder="you@example.com"></div>
        <div class="field"><label>Message</label><textarea rows="4" required placeholder="How can we help?"></textarea></div>
        <button type="submit" class="btn btn-gold"><i class="fa-solid fa-paper-plane"></i> Send Message</button>
      </form>
    </div>
  </div>
</section>

<footer>
  <div class="container">
    <div class="footer-grid">
      <div>
        <h5>Sri Vayaluran Herbals</h5>
        <p>A family-run Ayurvedic shop preparing traditional remedies by hand since 1918. Three generations, one unchanged promise.</p>
        <div class="footer-social">
          <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
          <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
        </div>
      </div>
      <div>
        <h5>Explore</h5>
        <ul>
          <li><a href="#about">About Us</a></li>
          <li><a href="#products">Products</a></li>
          <li><a href="#process">Our Craft</a></li>
          <li><a href="#reviews">Reviews</a></li>
        </ul>
      </div>
      <div>
        <h5>Categories</h5>
        <ul>
          <li><a href="#products">Herbal Oils</a></li>
          <li><a href="#products">Churna &amp; Powders</a></li>
          <li><a href="#products">Tonics</a></li>
          <li><a href="#products">Skin &amp; Hair Care</a></li>
        </ul>
      </div>
      <div>
        <h5>Account</h5>
        <ul>
          <li><a href="#" onclick="openModal('user');return false;">My Profile</a></li>
          <li><a href="{{ route('admin.login') }}">Admin Login</a></li>
          <li><a href="#contact">Contact Us</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">© <span id="year"></span> Sri Vayaluran Herbals. All remedies prepared with care, since 1918.</div>
  </div>
</footer>

<!-- FLOATING BUTTONS -->
<div class="floating-btns">
  <button class="fab fab-top" id="backTop" aria-label="Back to top"><i class="fa-solid fa-arrow-up"></i></button>
  <a class="fab fab-call" href="tel:+919876543210" aria-label="Call now"><i class="fa-solid fa-phone"></i></a>
  <a class="fab fab-whatsapp" href="https://wa.me/919876543210" target="_blank" aria-label="WhatsApp us"><i class="fa-brands fa-whatsapp"></i></a>
</div>

<!-- CUSTOMER LOGIN MODAL (placeholder — no customer accounts built yet) -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal-box">
    <button class="modal-close" onclick="closeModal()" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
    <h3 id="modalTitle">Customer Login</h3>
    <form onsubmit="event.preventDefault(); closeModal();">
      <div class="field"><label>Email or Phone</label><input type="text" required placeholder="Enter email or phone"></div>
      <div class="field"><label>Password</label><input type="password" required placeholder="Enter password"></div>
      <button type="submit" class="btn btn-gold" style="width:100%; justify-content:center; margin-top:8px;">Login</button>
    </form>
  </div>
</div>

<!-- PRODUCT POPUP MODAL -->
<!-- <div class="modal-overlay" id="productModalOverlay">
  <div class="modal-box" style="max-width:420px;">
    <button class="modal-close" onclick="closeProductModal()" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
    <div class="popup-body" id="popupBody"></div>
  </div>
</div> -->

<script>
/* ================= FILTER + SEARCH (products are already server-rendered) ================= */
const chipsWrap = document.getElementById('filterChips');
const searchInput = document.getElementById('productSearch');

function applyFilters(filter){
  const q = searchInput.value.trim().toLowerCase();
  document.querySelectorAll('.category-group').forEach(group=>{
    const matchesCat = filter === 'all' || group.dataset.cat === filter;
    let visibleCount = 0;
    group.querySelectorAll('.product-card').forEach(card=>{
      const matchesSearch = card.dataset.name.includes(q);
      const show = matchesCat && matchesSearch;
      card.classList.toggle('hidden', !show);
      if (show) visibleCount++;
    });
    group.classList.toggle('hidden', visibleCount === 0);
  });
}

chipsWrap.querySelectorAll('.chip').forEach(chip=>{
  chip.addEventListener('click', ()=>{
    chipsWrap.querySelectorAll('.chip').forEach(c=>c.classList.remove('active'));
    chip.classList.add('active');
    applyFilters(chip.dataset.filter);
  });
});
searchInput.addEventListener('input', ()=>{
  const activeChip = chipsWrap.querySelector('.chip.active');
  applyFilters(activeChip ? activeChip.dataset.filter : 'all');
});




/* ================= LOGIN MODAL ================= */
const modalOverlay = document.getElementById('modalOverlay');
function openModal(type){
  modalOverlay.classList.add('open');
}
function closeModal(){ modalOverlay.classList.remove('open'); }
modalOverlay.addEventListener('click', e=>{ if(e.target === modalOverlay) closeModal(); });

/* ================= CONTACT FORM ================= */
function handleContactSubmit(e){
  e.preventDefault();
  alert('Thank you — your message has been noted. We will get back to you shortly.');
  e.target.reset();
  return false;
}

/* ================= LOADER ================= */
window.addEventListener('load', ()=>{
  setTimeout(()=>{ document.getElementById('loader').classList.add('done'); }, 700);
});

/* ================= SCROLL PROGRESS + HEADER ================= */
const progressBar = document.getElementById('progress-bar');
const header = document.getElementById('siteHeader');
const backTop = document.getElementById('backTop');
window.addEventListener('scroll', ()=>{
  const scrollTop = window.scrollY;
  const docHeight = document.documentElement.scrollHeight - window.innerHeight;
  progressBar.style.width = (scrollTop / docHeight * 100) + '%';
  header.classList.toggle('scrolled', scrollTop > 40);
  backTop.classList.toggle('show', scrollTop > 500);
});
backTop.addEventListener('click', ()=> window.scrollTo({top:0, behavior:'smooth'}));

/* ================= MOBILE NAV ================= */
const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('navLinks');
hamburger.addEventListener('click', ()=>{
  navLinks.classList.toggle('open');
  hamburger.classList.toggle('active');
});
navLinks.querySelectorAll('a').forEach(a=> a.addEventListener('click', ()=> navLinks.classList.remove('open')));

/* ================= REVEAL ON SCROLL ================= */
const revealEls = document.querySelectorAll('.reveal, .reveal-stagger, .vine-divider');
const io = new IntersectionObserver((entries)=>{
  entries.forEach(entry=>{
    if(entry.isIntersecting){ entry.target.classList.add('in-view'); }
  });
}, {threshold:0.15});
revealEls.forEach(el=> io.observe(el));

/* ================= ANIMATED COUNTERS ================= */
const counters = document.querySelectorAll('.counter-num');
let countersStarted = false;
function startCounters(){
  if(countersStarted) return;
  countersStarted = true;
  counters.forEach(el=>{
    const target = parseInt(el.dataset.target, 10);
    const duration = 1800;
    const startTime = performance.now();
    function tick(now){
      const progress = Math.min((now - startTime) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      el.textContent = Math.floor(eased * target).toLocaleString();
      if(progress < 1) requestAnimationFrame(tick);
      else el.textContent = target.toLocaleString();
    }
    requestAnimationFrame(tick);
  });
}
const counterObserver = new IntersectionObserver((entries)=>{
  entries.forEach(entry=>{ if(entry.isIntersecting) startCounters(); });
}, {threshold:0.4});
counterObserver.observe(document.querySelector('.counters'));

/* ================= TESTIMONIAL CAROUSEL ================= */
const tCards = document.querySelectorAll('.t-card');
const tDotsWrap = document.getElementById('tDots');
let tIndex = 0;
if (tCards.length && tDotsWrap) {
  tCards.forEach((_,i)=>{
    const dot = document.createElement('button');
    if(i===0) dot.classList.add('active');
    dot.addEventListener('click', ()=> showTestimonial(i));
    tDotsWrap.appendChild(dot);
  });
  function showTestimonial(i){
    tCards[tIndex].classList.remove('active');
    tDotsWrap.children[tIndex].classList.remove('active');
    tIndex = i;
    tCards[tIndex].classList.add('active');
    tDotsWrap.children[tIndex].classList.add('active');
  }
  if (tCards.length > 1) {
    setInterval(()=>{ showTestimonial((tIndex+1) % tCards.length); }, 4800);
  }
}

/* ================= LEAF PARTICLES ================= */
/* ================= LEAF PARTICLES ================= */
const particleWrap = document.getElementById('leafParticles');
const shapes = ['shape-leaf', 'shape-leaf alt', 'shape-seed', 'shape-petal'];
for(let i=0;i<26;i++){
  const leaf = document.createElement('span');
  leaf.className = shapes[Math.floor(Math.random()*shapes.length)];
  leaf.style.left = Math.random()*100 + '%';
  leaf.style.setProperty('--sway', (Math.random()*50 - 25) + 'px');
  const dur = 9 + Math.random()*12;
  leaf.style.animationDuration = dur+'s, '+(dur*0.6)+'s';
  leaf.style.animationDelay = (Math.random()*12)+'s, '+(Math.random()*4)+'s';
  leaf.style.transform = `scale(${0.7 + Math.random()*0.8})`;
  particleWrap.appendChild(leaf);
}

/* ================= FOOTER YEAR ================= */
document.getElementById('year').textContent = new Date().getFullYear();
</script>
</body>
</html>
