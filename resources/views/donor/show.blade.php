@extends('layout.app')

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
    .need-card {
        padding: 10px;
        border-radius: 6px;
        color: #fff;
    }
    .need-food { background-color: #f39c12; }
    .need-medicine { background-color: #27ae60; }
    .need-rent { background-color: #2980b9; }

    .wallet-section {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 25px;
    }
</style>
@endpush

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm h-100">
                <div class="row g-0 h-100">



                    <!-- المحتوى -->
                    <div class="col-md-7 h-100">
                        <div class="card-body p-4 h-100 d-flex flex-column justify-content-between">
                            <div>
                                <h3 class="fw-bold">{{ $donor->name }}</h3>

                                <p class="text-muted">{{ $donor->email }}</p>

                             

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // 🔔 إخفاء التنبيهات بعد 5 ثوانٍ بشكل ناعم
    setTimeout(() => {
        const alerts = document.querySelectorAll('.auto-dismiss');
        alerts.forEach(alert => {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
</script>
@endpush
