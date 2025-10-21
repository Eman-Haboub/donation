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



            @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'family'))
                <a class="btn btn-warning ms-3" href="{{ route('families.create') }}">
                    Get Accredited
                </a>
            @endif



            @if(auth()->check())
                <a class="btn btn-warning ms-3 d-flex align-items-center" href="{{ route('wallet.index') }}">
                    <i class="fas fa-wallet me-2" style="color: #000;"></i> My Wallet
                </a>
            @endif

            <!-- Dropdown صورة -->
            @if (Auth::check() )
                <div class="dropdown ps-2 pe-2">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ auth()->user()->avatar ?? '/images/default-avatar.png' }}" alt="Avatar" width="40" height="40" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="text-dark text-decoration-none ps-3" href="
                                @if(auth()->check() && auth()->user()->role === 'family')
                                    {{ route('families.show', auth()->user()->id) }}
                                @elseif(auth()->check() && auth()->user()->role === 'donor')
                                    {{ route('donor.show' , auth()->user()->id) }}
                                @endif ">
                                Profile
                            </a>


                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item"> logout </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a class="btn btn-warning ms-3" href="{{ route('login') }}">Login</a>
                <a class="btn btn-warning ms-3" href="{{ route('register') }}">Register</a>
            @endif




                {{-- <a class="btn btn-warning ms-3" href="{{ route('wallet.index') }}">Open Wallet</a> --}}




            </div>
        </div>
</nav>
