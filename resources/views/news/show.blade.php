
@extends('layout.app')
@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush
<section class="py-5">
    <div class="container">
        <div class="card shadow-lg">
            <div class="text-center p-3">
                <img src="{{ asset($item->image) }}" class="img-fluid rounded w-75" alt="{{ $item->title }}"  style="height:400px; object-fit:cover;">
            </div>
            <div class="card-body">
                <h2 class="card-title mb-3">{{ $item->title }} </h2>
                <p class="card-text">{{$item->details }}</p>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">⬅ Back</a>
            </div>
        </div>
    </div>
</section>
@endsection
