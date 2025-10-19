@extends('layout.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush
<div class="container py-5">
    <h2>Add News</h2>
    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Details</label>
            <textarea name="details" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add News</button>
    </form>
</div>
@endsection
