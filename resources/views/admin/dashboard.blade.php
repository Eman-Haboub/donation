@extends('layout.app')

@section('content')
<div class="container my-5">

    <h2 class="mb-4">Admin Dashboard</h2>

    <!-- إحصائيات سريعة مع أيقونات -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-users fa-3x me-3"></i>
                    <div>
                        <h5 class="card-title">Total Families</h5>
                        <p class="card-text display-6">{{ $totalFamilies }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-hand-holding-heart fa-3x me-3"></i>
                    <div>
                        <h5 class="card-title">Total Donors</h5>
                        <p class="card-text display-6">{{ $totalDonors }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-dollar-sign fa-3x me-3"></i>
                    <div>
                        <h5 class="card-title">Total Donations</h5>
                        <p class="card-text display-6">${{ $totalDonations }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- أحدث العائلات -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">Recent Families</div>
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Alias</th>
                        <th>Region</th>
                        <th>Status</th>
                        <th>Goal</th>
                        <th>Donated</th>
                        <th>Progress</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentFamilies as $family)
                    @php
                        $progress = $family->goal > 0 ? intval(($family->donated / $family->goal) * 100) : 0;
                    @endphp
                    <tr>
                        <td>{{ $family->alias }}</td>
                        <td>{{ $family->public_region }}</td>
                        <td>
                            @if($family->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @elseif($family->status == 'inactive')
                                <span class="badge bg-secondary">Inactive</span>
                            @else
                                <span class="badge bg-danger">Suspended</span>
                            @endif
                        </td>
                        <td>${{ $family->goal }}</td>
                        <td>${{ $family->donated }}</td>
                        <td>
                            <div class="progress" style="height:6px;">
                                <div class="progress-bar bg-warning" style="width: {{ $progress }}%"></div>
                            </div>
                            <small>{{ $progress }}%</small>
                        </td>
                        <td>
                            <a href="{{ route('admin.families.edit', $family) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.families.destroy', $family) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- أحدث المتبرعين -->
    <div class="card">
        <div class="card-header bg-info text-white">Recent Donors</div>
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentDonors as $donor)
                    <tr>
                        <td>{{ $donor->name }}</td>
                        <td>{{ $donor->email }}</td>
                        <td>
                            <form action="{{ route('admin.donors.destroy', $donor) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush
