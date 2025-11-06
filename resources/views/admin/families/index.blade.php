@extends('layout.dashboard')


@section('content')

    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h2>Display Families </h2>
            <p>Home / <span>Display Families</span></p>
        </div>
    </section>

    <div class="container my-5">

        <x-alert name="success" />
        <x-alert name="error" />

        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h2>Families Management</h2>
            <a href="{{ route('admin.families.create') }}" class="btn" style="background-color: #ffc107">Add New Family</a>
        </div>


        <table class="table table-border table-striped mt-3">
            <thead class="table-success">
                <tr>
                    <th>Alias</th>
                    <th>Region</th>
                    <th>Status</th>
                    <th>Members</th>
                    <th>Goal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($families as $family)
                <tr>
                    <td>{{ $family->alias }}</td>
                    <td>{{ $family->public_region }}</td>
                    <td>{{ $family->status }}</td>
                    <td>{{ $family->members_count }}</td>
                    <td>${{ $family->goal }}</td>
                    <td>
                        {{-- <a href="{{ route('admin.families.edit', $family) }}" class="btn btn-sm btn-primary">Edit</a> --}}
                        <a href="{{ route('admin.families.show', $family) }}" class="btn btn-sm btn-success">Show</a>
                        <form action="{{ route('admin.families.destroy', $family) }}" method="POST" style="display:inline">
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
        {{$families->withQueryString()->links()}}

@endsection
