@extends('layout.dashboard')

@section('content')

<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h2>Display News </h2>
        <p>Dashboard / <span>News Management</span></p>
    </div>
</section>

<div class="container my-5">

    <x-alert name="success" />
    <x-alert name="error" />

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h2>News Management</h2>
        <a href="{{ route('admin.news.create') }}" class="btn" style="background-color: #ffc107">Add New News</a>
    </div>

    <table class="table table-border table-striped mt-3">
        <thead class="table-success">
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Details</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($news as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>
                    @if($item->image)
                        <img src="{{ asset($item->image) }}" width="100" style="object-fit:cover;">
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ Str::limit($item->details, 50) }}</td>
                <td>
                    <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-primary">Edit</a>
                    <a href="{{ route('admin.news.show', $item) }}" class="btn btn-sm btn-success">Show</a>
                    <form action="{{ route('admin.news.destroy', $item) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $news->withQueryString()->links() }}
    </div>

</div>

@endsection
