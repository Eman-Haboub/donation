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
  @include('partials.navbar')

  {{-- المحتوى المتغيّر --}}
  <main>
    @yield('content')
  </main>

  {{-- الفوتر --}}
  @include('partials.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
