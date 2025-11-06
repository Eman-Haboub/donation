@extends('layout.dashboard')

@section('content')
    <div class="container my-5">

        <h2 class="mb-4">Admin Dashboard</h2>

     <!-- إحصائيات سريعة مع أيقونات -->
<div class="row mb-4">
    <div class="col-md-3"> <!-- غيّرنا العرض من 4 إلى 3 لتتناسب 4 بطاقات في صف واحد -->
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

    <div class="col-md-3">
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

    <div class="col-md-3">
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

    <!-- بطاقة جديدة لأحدث الأخبار -->
    <div class="col-md-3">
        <div class="card text-white bg-info mb-3">
            <div class="card-body d-flex align-items-center">
                <i class="fas fa-newspaper fa-3x me-3"></i>
                <div>
                    <h5 class="card-title">Latest News</h5>
                    <p class="card-text display-6">{{ $totalNews }}</p>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- أحدث العائلات -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                Recent Families

                <a class="p-2 text-decoration-none rounded text-dark" href="{{route('admin.families.index')}}" style="background-color: #ffc107"> All families </a>
            </div>
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
                                {{-- <a href="{{ route('admin.families.edit', $family) }}" class="btn btn-sm btn-primary">Edit</a> --}}
                                <a href="{{ route('admin.families.show', $family) }}" class="btn btn-sm btn-success">Show</a>

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
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                Recent Donors
                <a class="p-2 text-decoration-none rounded text-dark" href="{{route('admin.donors.index')}}" style="background-color: #ffc107"> All Donors </a>

            </div>

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
                                <a href="{{ route('admin.donors.show', $donor) }}" class="btn btn-sm btn-primary">Show</a>
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
<!-- أحدث الرسائل -->
<div class="card mt-4">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
        Recent Messages

    </div>

    <div class="card-body p-0">
        @if($recentMessages->count() > 0)
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentMessages as $msg)
                    <tr>
                        <td>{{ $msg->name }}</td>
                        <td>{{ $msg->email }}</td>
                        <td>{{ Str::limit($msg->subject, 25) }}</td>
                        <td>{{ Str::limit($msg->message, 40) }}</td>
                        <td>{{ $msg->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('messages.show', $msg->id) }}" class="btn btn-sm btn-info">View</a>
                            <form action="{{ route('messages.destroy', $msg->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this message?')"
                                    class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="p-3 text-center text-muted">
                No messages received yet.
            </div>
        @endif
    </div>

</div>
<!-- أحدث الأخبار -->
<div class="card mt-4">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
        Recent News
       
    </div>

    <div class="card-body p-0">
        @if($recentNews->count() > 0)
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Details</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentNews as $item)
                    <tr>
                        <td>{{ Str::limit($item->title, 30) }}</td>
                        <td>
                            @if($item->image)
                                <img src="{{ asset($item->image) }}" width="80" style="object-fit:cover;">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ Str::limit($item->details, 50) }}</td>
                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this news item?')"
                                    class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="p-3 text-center text-muted">
                No news available yet.
            </div>
        @endif
    </div>
</div>

    </div>

@endsection

@push('scripts')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush
