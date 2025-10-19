@extends('layout.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white text-center fw-bold">Add Balance</div>
        <div class="card-body">
            <form method="POST" action="{{ route('wallet.deposit') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Amount ($)</label>
                    <input type="number" name="amount" class="form-control" min="1" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-4">Deposit</button>
                    <a href="{{ route('wallet.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
