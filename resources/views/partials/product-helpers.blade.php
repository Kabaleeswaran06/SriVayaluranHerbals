{{-- Shared product-visual/price helpers — @include this before using $productVisual / $priceSummary --}}
@php
  if (! isset($jarColors)) {
    $jarColors = ['#3F6B44','#7A2E2E','#C9A227','#6E9B6E','#E08A1E','#E4C860'];
  }
  $productVisual = function($product, $size) use ($jarColors) {
    if ($product->image_url) {
      return '<img src="'.$product->image_url.'" alt="'.e($product->name_en).'" style="width:'.$size.'px;height:'.($size*1.16).'px;object-fit:cover;border-radius:6px;">';
    }
    $color = $jarColors[$product->id % count($jarColors)];
    return '<svg viewBox="0 0 96 112" width="'.$size.'" height="'.($size*1.16).'" xmlns="http://www.w3.org/2000/svg">
        <rect x="30" y="6" width="36" height="14" rx="3" fill="#C9A227"/>
        <path d="M22 24C22 20 26 18 30 18H66C70 18 74 20 74 24V96C74 103 68 108 60 108H36C28 108 22 103 22 96V24Z" fill="'.$color.'" opacity="0.92"/>
        <rect x="26" y="46" width="44" height="24" fill="#F4ECD8" opacity="0.9"/>
        <line x1="30" y1="54" x2="66" y2="54" stroke="'.$color.'" stroke-width="2"/>
        <line x1="30" y1="60" x2="58" y2="60" stroke="'.$color.'" stroke-width="2"/>
      </svg>';
  };
  $priceSummary = function($product) {
    $variants = $product->variants;
    if ($variants->isEmpty()) return '';
    if ($variants->count() === 1) return '₹'.rtrim(rtrim(number_format($variants[0]->price, 2), '0'), '.');
    $min = $variants->min('price');
    return '<span class="price-from">From</span>₹'.rtrim(rtrim(number_format($min, 2), '0'), '.');
  };
  $formatMoney = function($value) {
    return rtrim(rtrim(number_format($value, 2), '0'), '.');
  };
@endphp