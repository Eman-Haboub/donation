@if (session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        .card {
            transition: none !important;
        }

        .card:hover {
            transform: none !important;
        }

        .family-img {
            width: 100%;
            object-fit: cover;
            border-top-left-radius: .25rem;
            border-bottom-left-radius: .25rem;
        }

        @media (max-width: 992px) {
            .family-img {
                border-radius: .25rem .25rem 0 0;
                height: 250px;
            }
        }
    </style>
@endpush
<div class="container my-5">
    <div class="row g-4">
        <h1 class="text-center mb-4">Recent Families</h1>
        <h5 class="text-center mb-4 text-muted">We help families in need across Gaza</h5>

        @foreach ($families as $family)
            @php
                $progress = $family->goal > 0 ? intval(($family->donated / $family->goal) * 100) : 0;
            @endphp

            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                    <img src="{{ asset($family->img ?? 'images/placeholder.jpg') }}" class="card-img-top"
                        alt="{{ $family->alias }}" style="height:220px; object-fit:cover;">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-dark">{{ $family->alias }}</h5>
                        <p class="card-text text-muted" style="font-size: 14px;">
                            {{ Str::limit($family->information, 100) }}
                        </p>

                        <div class="mb-2">
                            <div class="d-flex justify-content-between small text-muted">
                                <span>{{ $progress }}% Donated</span>
                                <span>Goal: ${{ $family->goal }}</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-warning" role="progressbar"
                                    style="width: {{ $progress }}%"></div>
                            </div>
                        </div>

                        <div class="mt-auto d-flex justify-content-between">
                            <!-- زر التبرع -->
                            <a href="{{ route('donations.create', $family->id) }}"
                                class="btn btn-sm btn-warning"> <i class="fas fa-hand-holding-heart"></i>Donate</a>




                            @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'donor'))

                            <a href="{{ route('families.show', $family->id) }}"
                                class="btn btn-sm btn-outline-warning px-3">Read More</a>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('families.index') }}" class="btn btn-warning px-4 py-2">
            View All Families
        </a>
    </div>
</div>
