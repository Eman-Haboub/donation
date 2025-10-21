<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> @yield('title', __('title'))</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-papX0V+zN8b+..." crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="{{ asset('css/Accredited.css') }}">
    @stack('styles')
</head>
<body>

  {{-- الشريط العلوي --}}
  @include('partials.topbar')

  {{-- القائمة --}}
  <nav class="navbar navbar-expand-lg navbar-dark bg-brown sticky-top">
        <div class="container">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.families.*') ? 'active' : '' }}"
                            href="{{ route('admin.families.index') }}"> families </a>
                    </li>

                    <li>
                        <a class="nav-link {{ request()->routeIs('admin.donors.*') ? 'active' : '' }}"
                            href="{{ route('admin.donors.index') }}"> donors </a>
                    </li>
                    {{-- <li>
                        <a class="nav-link {{ request()->routeIs('blog') ? 'active' : '' }}"
                            href="{{ route('blog') }}">Blog</a>
                    </li> --}}
                </ul>

                <div class="d-flex align-items-center">

                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">Logout</button>
                    </form>


                </div>

            </div>
        </div>
    </nav>


  {{-- المحتوى المتغيّر --}}
  <main>
    @yield('content')
  </main>

  {{-- الفوتر --}}
  @include('partials.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
