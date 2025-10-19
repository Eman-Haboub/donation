@extends('layout.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4"> Search results</h2>

     @if($results->isEmpty())
        <div class="alert alert-warning">
<h5>There are no flights to search for you </h5>        </div>
    @else
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
                            </div>
</div>
@endsection

