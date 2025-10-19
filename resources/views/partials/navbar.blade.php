<nav class="navbar navbar-expand-lg navbar-dark bg-brown sticky-top">
    <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                        href="{{ route('home') }}">Home</a>
                </li>
                <li>
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                        href="{{ route('about') }}">About</a>
                </li>
                <li>
                    <a class="nav-link {{ request()->routeIs('families.index') ? 'active' : '' }}"
                        href="{{ route('families.index') }}">Our Causes</a>
                </li>
                <li>
                    <a class="nav-link {{ request()->routeIs('blog') ? 'active' : '' }}"
                        href="{{ route('blog') }}">Blog</a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <a class="btn btn-warning" href="{{ route('donations.quick') }}">Donate</a>

                @php
                    $user = auth()->user();
                @endphp

            <a class="btn btn-warning ms-3" href="{{ route('families.create') }}" >
    {{-- @if(!$user)
        href="{{ route('login') }}"
    @elseif($user->hasRole('family'))
        href="{{ route('family.profile') }}"
    @elseif($user->hasRole('donor'))
        href="{{ route('donor.families') }}"
    @else
        href="#" onclick="alert('You cannot access this feature.'); return false;"
    @endif --}}
 Get Accredited
</a>


@if(auth()->check())
   <a class="btn btn-warning ms-3 d-flex align-items-center" href="{{ route('wallet.index') }}">
    <i class="fas fa-wallet me-2" style="color: #000;"></i> My Wallet
</a>
@endif


                {{-- <a class="btn btn-warning ms-3" href="{{ route('wallet.index') }}">Open Wallet</a> --}}




            </div>
        </div>
</nav>
