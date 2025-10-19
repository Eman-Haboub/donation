@extends('layout.app')
@section('title', __('Gallery'))
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
@endpush
@section('content')

    <style>
        .hero {
            background: url("/storage/about/2.jpg") center/cover no-repeat;
            padding-top: 100px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
        }
    </style>
    <div class="d">
        <section class="hero">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h2>Gallery </h2>
                <p>Home // <span>Gallery</span></p>
            </div>
        </section>
    </div>

    <div class="container py-5">
        <div class="text-center mb-4">
            <h4 class="gallery-title">Gallery</h4>
            <p class="text-muted">
                This gallery presents powerful photos and videos from Gaza, capturing daily life, resilience, and the
                ongoing struggle of families under difficult conditions.
            </p>
        </div>

        <!-- Video Section -->
       <!-- Video Section -->
        <div class="gallery-video mb-4">
            <span class="play-btn"> <img src="{{ asset('storage/Gallery/يارب فرج همهم.jpg') }}"
       alt="video poster"
       class="w-100"
       style="height:500px; object-fit:cover;"></span>
        </div>
        <br>
        <!-- Gallery Grid -->
        <div class="row g-3 mb-5">
            <div class="col-md-4 col-sm-6">
                <img src="{{ asset('storage/Gallery/1-1679495.webp') }}" class="gallery-img rounded" alt="Gallery 1"style="height: 300px;">
            </div>
            <div class="col-md-4 col-sm-6">
                <img src="{{ asset('storage/Gallery/483077.jpeg') }}" class="gallery-img rounded" alt="Gallery 2"style="height: 300px;">
            </div>
            <div class="col-md-4 col-sm-6">
                <img src="{{ asset('storage/Gallery/F89VhzvXoAAlS3o-jpg.webp') }}" class="gallery-img rounded" alt="Gallery 3" style="height: 300px;">
            </div>
            <div class="col-md-4 col-sm-6">
                <img src="{{ asset('storage/Gallery/image-1706099100.webp') }}" class="gallery-img rounded" alt="Gallery 4" style="height: 300px; ">
            </div>
            <div class="col-md-4 col-sm-6">
                <img src="{{ asset('storage/Gallery/image1170x530cropped.jpg') }}"class="gallery-img rounded" alt="Gallery 5" style="height: 300px;">
            </div>
            <div class="col-md-4 col-sm-6">
                <img src="{{ asset('storage/Gallery/image_870x_65868cd6e452c.webp') }}" class="gallery-img rounded" alt="Gallery 6" style="height: 300px;">
            </div>
            <div class="col-md-4 col-sm-6">
                <img src="{{ asset('storage/home/22.jpg') }}"  class="gallery-img rounded" alt="Gallery 4" style="height: 300px;">

            </div>
            <div class="col-md-4 col-sm-6">
                <img src="{{ asset('storage/home/10.webp') }}" class="gallery-img rounded" alt="Gallery 5" style="height: 300px;">
            </div>
            <div class="col-md-4 col-sm-6">
                <img src="{{ asset('storage/home/19.png') }}" class="gallery-img rounded" alt="Gallery 6" style="height: 300px;">
            </div>
        </div>
    </div>



    <!-- Pagination -->
    <nav class="mt-4 d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#"><i class="fas fa-arrow-right"></i></a></li>
        </ul>
    </nav>
    </div>


    @include('sections.contact')
@endsection
