<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">@lang('News & Updates ')</h2>
        <h5 class="text-center mb-4">Stay informed about our projects, events, and success stories</h5>
        <div class="row g-4">
            @foreach($news as $item)
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="{{ asset($item->image) }}" class="card-img-top" alt="{{ $item->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ Str::limit($item->details, 100) }}</p>
                            <a href="{{ route('news.show', $item->id) }}" class="btn btn-outline-warning">
                                @lang('Read More')
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="text-center mt-4">
        {{-- route('families.index') --}}
  <a href="{{ route('news.index') }}" class="btn btn-warning">
    View All News
</a>

</div>

</section>
