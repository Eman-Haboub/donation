@extends('layout.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Search results</h2>

    @if($families->isEmpty())
        <div class="alert alert-warning">
            <h5>There are no families to show</h5>
        </div>
    @else
        @foreach($families as $family)
        <div class="col-md-7 h-100 mb-4">
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
                </div>
            </div>
        </div>
                    <a href="{{ route('donations.quick') }}" class="btn btn-outline-warning w-100" style="border-radius: 6px;"> <i class="fas fa-hand-holding-heart"></i>Donate</a>

        @endforeach
    @endif
</div>
@endsection
