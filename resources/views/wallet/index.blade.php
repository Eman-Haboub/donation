@extends('layout.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">My Wallet</h2>
        <p class="text-muted">Manage your balance and track all transactions easily.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body text-center">
            <h4>Current Balance</h4>
            <h2 class="text-success fw-bold">${{ number_format($wallet->balance, 2) }}</h2>
            <div class="mt-3">
                <a href="{{ route('wallet.depositForm') }}" class="btn btn-success me-2">
                    <i class="bi bi-wallet2"></i> Add Balance
                </a>
                <a href="{{ route('wallet.withdrawForm') }}" class="btn btn-danger">
                    <i class="bi bi-cash-stack"></i> Withdraw / Donate
                </a>
            </div>
        </div>
    </div>

    <h4 class="fw-bold mb-3">Transaction History</h4>
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
                @forelse ($transactions as $tx)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($tx->type == 'deposit')
                                <span class="badge bg-success">Deposit</span>
                            @elseif($tx->type == 'withdraw')
                                <span class="badge bg-danger">Withdraw</span>
                            @else
                                <span class="badge bg-info">Donation</span>
                            @endif
                        </td>
                        <td>${{ number_format($tx->amount, 2) }}</td>
                        <td>{{ $tx->description ?? '-' }}</td>
                        <td>{{ $tx->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No transactions yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
