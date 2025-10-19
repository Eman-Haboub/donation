@extends('layout.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<style>
    /* تحسين أزرار الكارد */
    .btn-group-custom .btn {
        margin-right: 5px;
    }
    .need-badge {
        font-size: 0.8rem;
        margin-right: 3px;
        margin-bottom: 3px;
    }
</style>
@endpush

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="text-warning fw-bold mb-0">Families in Need</h1>
            <h5 class="text-muted">Helping families across Gaza to rebuild their lives</h5>
        </div>
        <div>
            <a href="{{ route('families.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Add Family
            </a>
        </div>
    </div>

    <div class="row g-4">
        @if ($families->isEmpty())
            <div class="col-12 text-center">
                <div class="alert alert-info">No families available at the moment.</div>
            </div>
        @else
            @foreach ($families as $family)
                @php
                    $progress = ($family->goal > 0) ? intval(($family->donated / $family->goal) * 100) : 0;
                @endphp

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset($family->img ? $family->img : 'images/placeholder.jpg') }}"
                             onerror="this.src='{{ asset('images/placeholder.jpg') }}'"
                             class="card-img-top"
                             alt="{{ $family->alias }}"
                             style="height:220px; object-fit:cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-dark fw-bold">{{ $family->alias }}</h5>
                            <p class="card-text text-muted small mb-2">
                                {{ Str::limit($family->information, 120) }}
                            </p>

                            <!-- Progress Bar -->
                            <div class="mb-2">
                                <div class="d-flex justify-content-between small">
                                    <span>{{ $progress }}% Funded</span>
                                    <span>Goal: ${{ $family->goal }}</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-warning"
                                         role="progressbar"
                                         style="width: {{ $progress }}%">
                                    </div>
                                </div>
                            </div>

                            <!-- Needs -->
                            @if($family->needs->isNotEmpty())
                                <div class="mb-2">
                                    <strong class="small text-muted">Needs:</strong><br>
                                    @foreach($family->needs as $need)
                                        <span class="badge bg-info text-dark need-badge">
                                            {{ ucfirst($need->type) }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <div class="mt-auto d-flex flex-wrap btn-group-custom">
                                <a href="{{ route('donations.create', $family->id) }}" class="btn btn-sm btn-warning text-white me-1 mb-1">
                                    <i class="fas fa-hand-holding-heart"></i> Donate
                                </a>
                                <a href="{{ route('families.show', $family->id) }}" class="btn btn-sm btn-outline-warning me-1 mb-1">
                                    Read more
                                </a>

                                <a href="{{ route('families.edit', $family->id) }}" class="btn btn-sm btn-primary me-1 mb-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('families.destroy', $family->id) }}" method="POST" class="d-inline mb-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this family?');">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
