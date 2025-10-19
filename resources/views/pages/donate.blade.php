@extends('layout.app')
@section('title', content: __('About'))
  <style>
    body {
      background: #f8fbff;
      font-family: 'Poppins', sans-serif;
    }

    .donation-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      padding: 30px;
      max-width: 600px;
      margin: 60px auto;
    }

    .donation-card h4 {
      font-weight: 600;
      margin-bottom: 20px;
      text-align: center;
      color: #333;
    }

    .custom-amount {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .donate-btn {
      background-color: #ff6600; /* 🟧 برتقالي */
      border: none;
      font-weight: 600;
      padding: 10px 30px;
      border-radius: 10px;
    }

    .donate-btn:hover {
      background-color: #e65c00;
    }

    .text-small {
      font-size: 0.9rem;
      color: #666;
    }

    .error-text {
      color: #e74c3c;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

 <form action="{{ route('donations.store') }}" method="POST">
  @csrf

  {{-- ✅ اختيار العائلة --}}
  <div class="mb-3">
    <label class="form-label fw-semibold">Select Family</label>
    <select class="form-select" name="family_id" required>
      <option value="" disabled selected>Select Family</option>
      @foreach ($families as $family)
        <option value="{{ $family->id }}">{{ $family->alias }}</option>
      @endforeach
    </select>
  </div>

  {{-- ✅ المبلغ --}}
  <div class="mb-3">
    <label class="form-label fw-semibold">Custom Amount</label>
    <div class="custom-amount">
      <input type="number" class="form-control" name="amount" placeholder="e.g., 15" required>
      <select class="form-select" name="currency" style="width: 100px;">
        <option>USD</option>
        <option>EUR</option>
        <option>ILS</option>
      </select>
    </div>
  </div>

  {{-- ✅ معلومات المتبرع --}}
  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label fw-semibold">Full Name</label>
      <input type="text" class="form-control" name="donor_name" placeholder="Enter your name" required>
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label fw-semibold">Email</label>
      <input type="email" class="form-control" name="donor_email" placeholder="Enter your email" required>
    </div>
  </div>

  <div class="text-center mt-4">
    <button type="submit" class="btn donate-btn">Donate Now</button>
  </div>
</form>

@endsection
