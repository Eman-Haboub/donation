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

                    <!-- الصورة -->
                    <div class="col-md-5 h-100">
                        <img src="{{ asset($family->img ?? 'images/placeholder.jpg') }}" class="card-img-top"
                             alt="{{ $family->alias }}" style="height:400px; object-fit:cover;">
                    </div>

                    <!-- المحتوى -->
                    <div class="col-md-7 h-100">
                        <div class="card-body p-4 h-100 d-flex flex-column justify-content-between">
                            <div>
                                <h3 class="fw-bold">{{ $family->alias }}</h3>
                                <small class="text-muted d-block mb-3">{{ $family->public_region }}</small>

                                @php
                                    $progress = ($family->goal > 0) ? intval(($family->donated / $family->goal) * 100) : 0;
                                @endphp

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between small">
                                        <span>{{ $progress }}% Donated</span>
                                        <span>Goal: ${{ $family->goal }}</span>
                                    </div>
                                    <div class="progress" style="height:6px;">
                                        <div class="progress-bar bg-warning" style="width: {{ $progress }}%"></div>
                                    </div>
                                </div>

                                <p class="text-muted">{{ $family->information }}</p>

                                <hr>

                                <h5>Private Information</h5>
                                <ul class="list-unstyled mb-3">
                                    <li><strong>Real Name:</strong> {{ $family->real_name }}</li>
                                    <li><strong>Address:</strong> {{ $family->address }}</li>
                                    <li><strong>Phone:</strong> {{ $family->phone ?? 'N/A' }}</li>
                                    <li><strong>Members:</strong> {{ $family->members_count }}</li>
                                    <li><strong>Monthly Income:</strong> {{ $family->income ? '$'.$family->income : 'N/A' }}</li>
                                    <li><strong>Status:</strong>
                                        @if ($family->status == 'active')
                                            <span class="badge bg-success">Active</span>
                                        @elseif($family->status == 'inactive')
                                            <span class="badge bg-secondary">Inactive</span>
                                        @else
                                            <span class="badge bg-danger">Suspended</span>
                                        @endif
                                    </li>
                                    <li><strong>National ID:</strong> {{ $family->national_id_encrypted ?? 'N/A' }}</li>
                                    <li><strong>Verified:</strong> {{ $family->verified ? 'Yes' : 'No' }}</li>
                                    <li><strong>Notes:</strong> {{ $family->notes ?? 'No notes' }}</li>
                                </ul>

                                <h5>Family Needs</h5>
                                @if($family->needs->isEmpty())
                                    <p class="text-muted">This family has not listed any needs yet.</p>
                                @else
                                    <div class="row g-3">
                                        @foreach($family->needs as $need)
                                            @php
                                                $needClass = 'need-card';
                                                if ($need->type == 'food') $needClass .= ' need-food';
                                                elseif ($need->type == 'medicine') $needClass .= ' need-medicine';
                                                elseif ($need->type == 'rent') $needClass .= ' need-rent';
                                            @endphp
                                            <div class="col-md-6">
                                                <div class="{{ $needClass }}">
                                                    <h6 class="fw-bold">{{ ucfirst($need->type) }}</h6>
                                                    <p class="small mb-0">{{ $need->description }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- 💰 قسم المحفظة والتبرعات -->
                                <hr class="my-4">

                                <div class="wallet-section">

                                    <!-- ✅ تنبيهات النجاح أو الخطأ -->
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show text-center auto-dismiss" role="alert">
                                            <strong><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @elseif (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show text-center auto-dismiss" role="alert">
                                            <strong><i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <div class="text-center mb-4">
                                        <h4 class="fw-bold text-primary">Family Wallet & Donations</h4>
                                    </div>

                                    <div class="text-center mb-4">
                                        <h5 class="text-success fw-bold">Current Balance</h5>
                                        <h3 class="fw-bold text-success mb-3">${{ number_format($wallet->balance, 2) }}</h3>

                                        <!-- زر التبرع -->
                                        <form action="{{ route('wallet.withdraw') }}" method="POST" class="d-inline-block">
                                            @csrf
                                            <input type="hidden" name="family_id" value="{{ $family->id }}">
                                            <div class="input-group mb-3" style="max-width: 300px; margin:auto;">
                                                <input type="number" name="amount" class="form-control" placeholder="Amount ($)" min="1" required>
                                                <button type="submit" class="btn btn-warning fw-bold">Donate</button>
                                            </div>
                                        </form>
                                    </div>

                                    <h5 class="fw-bold mb-3">Donation History</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover align-middle">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                    <th>Description</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($transactions as $tx)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            @if($tx->type == 'deposit')
                                                                <span class="badge bg-success">Deposit</span>
                                                            @elseif($tx->type == 'donation')
                                                                <span class="badge bg-info">Donation</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ ucfirst($tx->type) }}</span>
                                                            @endif
                                                        </td>
                                                        <td>${{ number_format($tx->amount, 2) }}</td>
                                                        <td>{{ $tx->description ?? '-' }}</td>
                                                        <td>{{ $tx->created_at->format('Y-m-d H:i') }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center text-muted">No donations yet.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                            <div class="mt-3">
                                <a href="{{ route('families.index') }}" class="btn btn-outline-secondary w-100">Back to Families</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
 <form action="{{ route('admin.families.destroy', $family) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
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
