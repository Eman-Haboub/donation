@extends('layout.app')
@section('title', content: __('Donate'))

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
        <style>
            .card {
                transition: none !important;
            }

            .card:hover {
                transform: none !important;
                box-shadow: none !important;
            }

            .donate-btn {
                background-color: #ff8c00;
                color: white;
                font-weight: bold;
                border: none;
                border-radius: 8px;
                padding: 10px 25px;
                transition: 0.3s;
            }

            .donate-btn:hover {
                background-color: #e67e00;
                color: #fff;
            }

            .family-details {
                background: #f9f9f9;
                border-radius: 10px;
                padding: 15px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            }

            .family-details p {
                margin: 5px 0;
                font-size: 15px;
            }

            /* payment methods */
            .payment-option {
                border: 1px solid #ddd;
                border-radius: 10px;
                padding: 10px;
                text-align: center;
                cursor: pointer;
                transition: 0.3s;
                background-color: #fff;
            }

            .payment-option:hover {
                border-color: #ff8c00;
                background-color: #fff7e6;
            }

            .payment-option input[type="radio"] {
                display: none;
            }

            .payment-option.selected {
                border-color: #ff8c00;
                background-color: #fff3d9;
                box-shadow: 0 0 5px rgba(255, 140, 0, 0.5);
            }
        </style>
    @endpush
    <div class="container">
        <div class="donation-card">
            <h4 class="text-center mb-4">
                @if (isset($family))
                    Donate to {{ $family->alias }}
                @else
                    Quick Donation
                @endif
            </h4>
            <x-alert name="success" />
            <x-alert name="error" />
            {{-- بطاقة العائلة (تظهر فقط إذا كانت موجودة أو تم اختيارها لاحقًا) --}}
            <div id="selected-family" class="mb-3" style="display: {{ isset($family) ? 'block' : 'none' }}">
                @if (isset($family))
                    <div class="card p-2 mb-3">
                        <div class="row g-2 align-items-center">
                            <div class="col-auto" style="width:90px;">
                                <img id="family-img" src="{{ asset($family->img ?? 'images/placeholder.jpg') }}"
                                    alt="{{ $family->alias }}"
                                    style="width:90px; height:70px; object-fit:cover; border-radius:8px;">
                            </div>
                            <div class="col">
                                <div id="family-name" class="fw-bold">{{ $family->alias }}</div>
                                <div id="family-info" class="small text-muted">{{ Str::limit($family->information, 80) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card p-2 mb-3" id="family-card" style="display:none;">
                        <div class="row g-2 align-items-center">
                            <div class="col-auto" style="width:90px;">
                                <img id="family-img" src="" alt=""
                                    style="width:90px; height:70px; object-fit:cover; border-radius:8px;">
                            </div>
                            <div class="col">
                                <div id="family-name" class="fw-bold"></div>
                                <div id="family-info" class="small text-muted"></div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- الفورم --}}
            <form action="{{ route('donations.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Select Family</label>
                    <select class="form-select" id="familySelect" name="family_id" required>
                        <option value="" disabled selected>Select Family</option>
                        @foreach ($families as $f)
                            <option value="{{ $f->id }}" data-alias="{{ $f->alias }}"
                                data-info="{{ Str::limit($f->information, 80) }}"
                                data-img="{{ asset($f->img ?? 'images/placeholder.jpg') }}">
                                {{ $f->alias }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <div class="d-flex gap-2">
                        <input type="number" step="0.01" name="amount" class="form-control" placeholder="e.g., 15"
                            required>
                        <select name="currency" class="form-select" style="width:120px;">
                            <option>USD</option>
                            <option>EUR</option>
                            <option>ILS</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="donor_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="donor_email" class="form-control" required>
                    </div>
                </div>
                {{-- <!-- طرق الدفع -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Payment Method</label>
                    <div class="row g-3">
                        <div class="col-md-3 col-6">
                            <label class="payment-option d-flex align-items-center justify-content-center gap-2"
                                onclick="selectPayment(this)">
                                <input type="radio" name="payment_method" value="paypal" required>
                                <i class="bi bi-paypal text-primary" style="font-size: 1.3rem;"></i>
                                <span>PayPal</span>
                            </label>
                        </div>

                        <div class="col-md-3 col-6">
                            <label class="payment-option d-flex align-items-center justify-content-center gap-2"
                                onclick="selectPayment(this)">
                                <input type="radio" name="payment_method" value="bank_transfer">
                                <i class="bi bi-bank text-success" style="font-size: 1.3rem;"></i>
                                <span>Bank</span>
                            </label>
                        </div>

                        <div class="col-md-3 col-6">
                            <label class="payment-option d-flex align-items-center justify-content-center gap-2"
                                onclick="selectPayment(this)">
                                <input type="radio" name="payment_method" value="credit_card">
                                <i class="bi bi-credit-card-2-front text-danger" style="font-size: 1.3rem;"></i>
                                <span>Credit Card</span>
                            </label>
                        </div>

                        <div class="col-md-3 col-6">
                            <label class="payment-option d-flex align-items-center justify-content-center gap-2"
                                onclick="selectPayment(this)">
                                <input type="radio" name="payment_method" value="wallet">
                                <i class="bi bi-wallet2 text-warning" style="font-size: 1.3rem;"></i>
                                <span>Wallet</span>
                            </label>
                        </div>
                    </div>
                </div>
 --}}
                <div class="text-center mt-3">
                    <button type="submit" class="btn donate-btn m-2">Donate Now</button>
                </div>
            </form>
        </div>
    </div>

    {{-- JavaScript لعرض بيانات العائلة المختارة --}}
    <script>
        document.getElementById('familySelect').addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            const alias = selected.dataset.alias;
            const info = selected.dataset.info;
            const img = selected.dataset.img;

            // عرض البطاقة وتعبئتها
            const card = document.getElementById('family-card');
            card.style.display = 'block';
            document.getElementById('family-img').src = img;
            document.getElementById('family-name').textContent = alias;
            document.getElementById('family-info').textContent = info;
        });
    </script>
@endsection
