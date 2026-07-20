<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title') — Sri Vayaluran Herbals Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<aside class="sidebar">
  <div class="brand">
    <span>Sri Vayaluran<small>Admin Panel</small></span>
  </div>
  <nav>
    <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"><i class="fa-solid fa-tags"></i> Categories</a>
    <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}"><i class="fa-solid fa-boxes-stacked"></i> Products</a>
    <a href="{{ route('admin.reviews.index') }}" class="{{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}"><i class="fa-solid fa-star"></i> Reviews</a>
  </nav>
  <div class="user-box">
    <div class="uname"><i class="fa-solid fa-circle-user"></i> {{ auth()->user()->name ?? 'Admin' }}</div>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="logout-link" style="background:none;border:none;cursor:pointer;padding:0;">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
      </button>
    </form>
  </div>
</aside>

<main class="main">
  @if (session('success'))
    <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
  @endif
  @if (session('error'))
    <div class="alert alert-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}</div>
  @endif
  @if ($errors->any())
    <div class="alert alert-error">
      <i class="fa-solid fa-triangle-exclamation"></i>
      <span>
        @foreach ($errors->all() as $error) {{ $error }}<br> @endforeach
      </span>
    </div>
  @endif

  @yield('content')
</main>
</body>
</html>
