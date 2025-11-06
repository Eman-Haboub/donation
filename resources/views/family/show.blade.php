@extends('layout.app')

@push('styles')
    <style>
        .family-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .family-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .need-card {
            padding: 10px;
            border-radius: 6px;
            color: #fff;
            height: 100%;
        }

        .need-food {
            background-color: #f39c12;
        }

        .need-medicine {
            background-color: #27ae60;
        }

        .need-rent {
            background-color: #2980b9;
        }

        .wallet-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
        }

        @media (max-width: 992px) {
            .family-row {
                flex-direction: column;
            }

            .family-img {
                height: 250px;
                border-radius: 10px 10px 0 0;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container my-5">
        <div class="family-card">
            <div class="d-flex family-row flex-wrap">

                <!-- الصورة -->
                <div class="col-lg-5 p-0">
                    <img src="{{ asset(($family->img ?? 'images/placeholder.jpg')) }}" alt="{{ $family->alias }}"
                        class="family-img">
                </div>

                <!-- المحتوى -->
                <div class="col-lg-7 p-4">
                    <h3 class="fw-bold">{{ $family->alias }}</h3>
                    <small class="text-muted d-block mb-3">{{ $family->public_region }}</small>

                    @php
                        $progress = $family->goal > 0 ? intval(($family->donated / $family->goal) * 100) : 0;
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
                        <li><strong>Monthly Income:</strong> {{ $family->income ? '$' . $family->income : 'N/A' }}</li>
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
                    @if ($family->needs->isEmpty())
                        <p class="text-muted">This family has not listed any needs yet.</p>
                    @else
                        <div class="row g-3">
                            @foreach ($family->needs as $need)
                                @php
                                    $needClass = 'need-card';
                                    if ($need->type == 'food') {
                                        $needClass .= ' need-food';
                                    } elseif ($need->type == 'medicine') {
                                        $needClass .= ' need-medicine';
                                    } elseif ($need->type == 'rent') {
                                        $needClass .= ' need-rent';
                                    }
                                @endphp
                                <div class="col-md-6 d-flex">
                                    <div class="{{ $needClass }} flex-fill">
                                        <h6 class="fw-bold">{{ ucfirst($need->type) }}</h6>
                                        <p class="small mb-0">{{ $need->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <hr>
                    <div class="wallet-section">

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show text-center auto-dismiss">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show text-center auto-dismiss">
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="text-center mb-4">
                            <h4 class="fw-bold text-primary">Family Wallet & Donations</h4>
                            <h5 class="text-success fw-bold mt-3">Current Balance</h5>
                            <h3 class="fw-bold text-success mb-3">${{ number_format($wallet->balance, 2) }}</h3>

                            <form action="{{ route('wallet.withdraw') }}" method="POST" class="d-inline-block">
                                @csrf
                                <input type="hidden" name="family_id" value="{{ $family->id }}">
                                <div class="input-group mb-3" style="max-width:300px;margin:auto;">
                                    <input type="number" name="amount" class="form-control" placeholder="Amount ($)"
                                        min="1" required>
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
                                                @if ($tx->type == 'deposit')
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

                    <div class="mt-3 d-flex gap-2">
                        @if (auth()->check() && auth()->id() == $family->user_id)
                            <a href="{{ route('families.edit', $family->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endif
                        <a href="{{ route('families.index') }}" class="btn btn-outline-secondary w-100">Back to
                            Families</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        setTimeout(() => {
            document.querySelectorAll('.auto-dismiss').forEach(alert => {
                alert.classList.remove('show');
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
@endpush
