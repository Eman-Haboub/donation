@extends('layout.app')
@section('title', content: __('About'))
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
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
                <h2>About Us</h2>
                <p>Home // <span>About</span></p>
            </div>
        </section>
    </div>

    <!-- About Section -->
    <section class="container py-5">
        <div class="row mb-4">
            <div class="col-12 text-start">
                <h3 class="about-title">Our Beginning</h3>
                <p class="text-muted">About Us</p>
            </div>
        </div>
        <div class="row align-items-center">
            <!-- Image -->
            <div class="col-md-6 mb-4">
                <img src="{{ asset('storage/about/4.jpg') }}" class="img-fluid about-img" alt="about"
                    style="width: 500px; height: 400px;">
            </div>
            <!-- Text -->
            <div class="col-md-6 about-text">
                <p style="border-left: 5px solid orange; ">
                    We help families in Gaza who need urgent support. Our journey started with a small team and a big idea.
                </p>
                <p>
                    Our team is dedicated to creating meaningful solutions that impact communities positively.
                    We focus on innovation, collaboration, and delivering results that truly make a difference.
                </p>
                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <div class="mission-box">
                            <h5>Our Mission</h5>
                            <p class="text-muted">
                                To provide education, health care, and food to those who need it most. Every small effort
                                counts.
                            </p>

                            <p class="text-muted">
                                Our mission is to provide education, healthcare, food, and emotional
                                support to those who need it most. Every small effort counts, and together we can
                                build hope for the future.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="vision-box">
                            <h5>Our Vision</h5>
                            <p class="text-muted">
                                We envision a future where every family in Gaza lives
                                with dignity, safety, and hope. Our vision guides every action and decision we make.
                            </p>
                            <p class="text-muted">
                                We strive to create lasting change by supporting families with
                                essential resources and opportunities, so every child can dream and thrive.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="our-value">
        <div class="container d-flex flex-column flex-lg-row align-items-center gap-5">

            <div class="images">

                <img src="{{ asset('storage/about/1.jpg') }}" alt="Image 1" class="img1">
                <img src="{{ asset('storage/about/3.jpg') }}" alt="Image 2" class="img2">
            </div>


            <div class="content">
                <h2><span>Our</span> Value</h2>

                <div class="value-item">
                    <div class="icon">✔</div>
                    <div class="text">
                        <h3>Accredit Causes</h3>
                        <p>We focus on verified causes that truly make a difference.</p>
                    </div>
                </div>

                <div class="value-item">
                    <div class="icon">✔</div>
                    <div class="text">
                        <h3>Focused Support</h3>
                        <p>We provide help directly to those who need it most.</p>
                    </div>
                </div>

                <div class="value-item">
                    <div class="icon">✔</div>
                    <div class="text">
                        <h3>Data Driven</h3>
                        <p>We track our progress carefully to reach the right people.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <h2>Join Us?</h2>
        <p>
            Help make a difference in Gaza. Your support can change lives.
        </p>
    </section>
     @include('sections.box')


  <section class="team-section">
    <div class="container">
        <h2>Our Team</h2>
        <p class="subtitle">A committed team working to support families in Gaza.</p>

        <div class="team-grid">
            <div class="team-card">
                <img src="{{ asset('storage/about/sama.jpg') }}" alt="Sama Seyam" class="team-img">
                <h3>Sama Seyam </h3>
                <p>Worked with passion to bring this project to life</p>
            </div>

            <div class="team-card">
                <img src="{{ asset('storage/about/malak.jpg') }}" alt="Malak Zaqout" class="team-img">
                <h3>Malak Zaqout</h3>
                <p> Contributed ideas and effort to every stage</p>
            </div>

            <div class="team-card">
                <img src="{{ asset('storage/about/Fatima.jpg') }}" alt="Fatima Nassar" class="team-img">
                <h3>Fatima Nassar</h3>
                <p>Added creativity and teamwork to the process</p>
            </div>

            <div class="team-card">
                <img src="{{ asset('storage/about/Eman.jpg') }}" alt="Eman Haboub" class="team-img">
                <h3>Eman Haboub</h3>
                <p>Played an active role in building and shaping the project</p>
            </div>
        </div>
    </div>
</section>


@include('sections.contact')
@endsection
