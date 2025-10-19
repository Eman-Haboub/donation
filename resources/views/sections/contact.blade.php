

<section class="contact-section">
    <h5>CONTACT</h5>
    <h2><span class="highlight-get">Get</span> in touch</h2>
    <p>
     Send us your questions, suggestions, or support requests and we’ll respond promptly
    </p>

    <div class="container">

        {{-- عرض رسالة النجاح أو الخطأ --}}
        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        {{-- عرض أخطاء التحقق من المدخلات --}}
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
              </div>
              <div class="col-md-6">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
              </div>
            </div>
            <input type="text" name="subject" class="form-control mt-2" placeholder="Subject" required>
            <textarea name="message" class="form-control mt-2" rows="5" placeholder="Message" required></textarea>
            <button type="submit" class="btn btn-yellow mt-2">Get Started</button>
        </form>
    </div>
</section>
