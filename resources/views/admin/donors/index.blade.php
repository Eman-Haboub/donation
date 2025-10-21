@extends('layout.dashboard')

@section('content')

    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h2>Display Donors </h2>
            <p>Home / <span>Display Donors</span></p>
        </div>
    </section>

    <div class="container my-5">

        <x-alert name="success" />
        <x-alert name="error" />

        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h2>Donors Management</h2>
            <a href="{{ route('admin.donors.create') }}" class="btn" style="background-color: #ffc107">Add New Donor</a>
        </div>

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donors as $donor)
                <tr>
                    <td>{{ $donor->name }}</td>
                    <td>{{ $donor->email }}</td>
                    <td>
                        <a href="{{ route('admin.donors.edit', $donor) }}" class="btn btn-sm btn-primary">Edit</a>

                        <form action="{{ route('admin.donors.destroy', $donor) }}" method="POST" style="display:inline">
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

    {{$donors->withQueryString()->links()}}
@endsection
