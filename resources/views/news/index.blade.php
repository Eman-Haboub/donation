@extends('layout.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">@lang('All News & Updates')</h2>
        <div class="row g-4">
            @foreach($news as $item)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        @if($item->image)
                            <img src="{{ asset($item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height:200px; object-fit:cover;">
                        @else
                            <img src="{{ asset('images/default-news.jpg') }}" class="card-img-top" alt="No Image" style="height:200px; object-fit:cover;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ Str::limit($item->details, 100) }}</p>
                            <a href="{{ route('news.show', $item->id) }}" class="btn btn-outline-warning mt-auto">@lang('Read More')</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $news->links() }} {{-- pagination --}}
        </div>
    </div>
</section>
@endsection
