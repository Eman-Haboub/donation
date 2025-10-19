@extends('layout.app')

@section('content')
<div class="container my-5">
    <h2>Donors Management</h2>
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
@endsection
