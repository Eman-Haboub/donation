@extends('layout.app')
@section('title', __('Blog'))
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
@endpush
@section('content')

<style>
    .hero {
    background: url("/storage/Blog/2b2081ec32e3b2a923775a9566b0b8ce.jpg") center/cover no-repeat;
    padding-top: 100px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
}
</style>
    <div class="d">
        <section class="hero">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h2> Blog </h2>
                <p>Home // <span>Blog</span></p>
            </div>
        </section>
    </div>





    <div class="container my-5">
        <div class="row   ">
            <!-- Blog Content -->
            <div class="col-lg-8 ">

                <!-- Blog Post -->
                <div class="blog-post">
                    <div>
                    <img src="{{ asset('storage/Blog/sally_and_suhaib_children_of_the_war_in_gaza_01.jpg') }}">
                    </div>
                    <span class="date-badge">26 Jan</span>
                    <h5 class="mt-3">Lasts blog post with image</h5>
                    <p class="blog-meta">
                        <i>posted by admin </i>
                        <i class="fa fa-comments"></i>12 &nbsp;
                        <i class="fa-regular fa-heart"></i>403
                    </p>
                    <p>In this post, we share a glimpse of Gaza’s daily reality through stories and images. Despite
                        hardships, the people continue to show resilience and hope for a better future. Their strength,
                        solidarity, and determination inspire us all to never give up, even in the face of challenges.
                        Families strive to maintain normalcy, children play amidst the rubble, and communities come together
                        to support one another. Every small act of kindness and courage reflects the enduring spirit of
                        Gaza, reminding us that even in difficult times, hope and humanity can thrive.</p>
                    <a href="#" class="read-more">Read More</a>
                </div>

                <!-- Blog Post -->
                <div class="blog-post">
                    <img src="{{ asset('storage/Blog/sally_and_suhaib_children_of_the_war_in_gaza_02.jpg') }}"
                        alt="Post Image" width="100" height="auto">
                    <span class="date-badge">26 Jan</span>
                    <h5 class="mt-3">Lasts blog post with image</h5>
                    <p class="blog-meta">
                        <i class="fa fa-comments"></i>12 &nbsp;
                        <i class="fa-regular fa-heart"></i>403
                    </p>
                    <p>
                        Through this post, we offer a window into everyday life in Gaza, capturing moments of struggle,
                        resilience, and hope. Despite facing ongoing challenges, the people continue to live with courage
                        and optimism. From neighbors helping each other to children finding joy in simple things, every act
                        reflects the strength of their community. These stories remind us that even in hardship, human
                        spirit,
                        compassion, and hope remain unbroken.
                    </p>
                    <a href="#" class="read-more">Read More</a>
                </div>


                <nav class="d-flex justify-content-end ">
                    <ul class="pagination">
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4 sidebar">
                <!-- Search -->
                <div class="search-box">
                    <input type="text" placeholder="Enter Keyword">
                    <button><i class="fa fa-search"></i></button>
                </div>

                <!-- Categories -->
                <h6>Categories</h6>
                <ul class="list-unstyled">
                    <li>Blog Post</li>
                    <li>Our Post</li>
                </ul>

                <!-- Latest Post -->
                <h6>Latest Post</h6>
                <div class="d-flex latest-post mb-2">
                    <img src="{{ asset('storage/Blog/9affdabc-9224-4e0b-aef4-2b0be5d26f21.jpg') }}">
                    <div><small>Lasts blog post with image</small><br>
                        <small><i class="fa fa-user"></i> Admin</small>
                    </div>
                </div>
                <div class="d-flex latest-post mb-2">
                    <img src="{{ asset('storage/Blog/0ee74dd4b04911d547baf94cf8f3514e.jpg') }}">
                    <div><small>Lasts blog post with image</small><br>
                        <small><i class="fa fa-user"></i> Admin</small>
                    </div>
                </div>
                <div class="d-flex latest-post mb-2">
                    <img src="{{ asset('storage/Blog/1b637f641bc9bce8b7bf6e3ae49f9370.jpg') }}">
                    <div><small>Lasts blog post with image</small><br>
                        <small><i class="fa fa-user"></i> Admin</small>
                    </div>
                </div>

                <!-- Archives -->
                <h6>Archives</h6>
                <ul class="list-unstyled">
                    <li>January 2023</li>
                    <li>February 2023</li>
                </ul>

                <!-- Keywords -->
                <h6>Keywords</h6>
                <span class="keyword">Child</span>
                <span class="keyword">Health</span>
                <span class="keyword">Education</span>
                <span class="keyword">Unemployment</span>
                <span class="keyword">Human rights</span>
                <span class="keyword">+12</span>
            </div>
        </div>
    </div>
    @include('sections.contact')
@endsection
