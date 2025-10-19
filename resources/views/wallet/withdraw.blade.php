@extends('layout.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white text-center fw-bold">Withdraw / Donate</div>
        <div class="card-body">
            <form method="POST" action="{{ route('wallet.withdraw') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Amount ($)</label>
                    <input type="number" name="amount" class="form-control" min="1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Family ID (optional, for donation)</label>
                    <input type="number" name="family_id" class="form-control" placeholder="Enter family ID if donating">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-danger px-4">Submit</button>
                    <a href="{{ route('wallet.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
