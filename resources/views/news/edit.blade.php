@extends('layout.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush
<div class="container py-5">
    <h2>Edit News</h2>
    <form action="{{ route('news.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $item->title }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            <img src="{{ asset('storage/' . $item->image) }}" width="150" class="mb-3">
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Details</label>
            <textarea name="details" class="form-control" rows="5" required>{{ $item->details }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update News</button>
    </form>
</div>
@endsection
