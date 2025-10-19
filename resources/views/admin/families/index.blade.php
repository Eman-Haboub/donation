@extends('layout.app')

@section('content')
<div class="container my-5">
    <h2>Families Management</h2>
    <table class="table table-striped mt-3">
        <thead>
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
                    <a href="{{ route('admin.families.edit', $family) }}" class="btn btn-sm btn-primary">Edit</a>
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
@endsection
