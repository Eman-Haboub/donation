@extends('layout.app')

@section('content')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/Accredited.css') }}">
@endpush

<section class="hero">
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <h2>{{ isset($family) ? 'Edit Family' : 'Add New Family' }}</h2>
    <p>Home // <span>{{ isset($family) ? 'Edit Family' : 'Create Family' }}</span></p>
  </div>
</section>

<div class="container my-5 form-section">

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ isset($family) ? route('families.update', $family->id) : route('families.store') }}"
        method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($family))
        @method('PUT')
    @endif

    {{-- Public Info --}}
    <h4 class="mb-3">Public Family Information</h4>
    <div class="row g-4 mb-4">
      <div class="col-md-4">
        <label>Alias</label>
        <input type="text" name="alias" class="form-control"
               value="{{ old('alias', $family->alias ?? '') }}" required>
      </div>
      <div class="col-md-4">
        <label>Public Region</label>
        <input type="text" name="public_region" class="form-control"
               value="{{ old('public_region', $family->public_region ?? '') }}" required>
      </div>
      <div class="col-md-4">
        <label>Members Count</label>
        <input type="number" name="members_count" class="form-control"
               value="{{ old('members_count', $family->members_count ?? '') }}" required>
      </div>
    </div>

    <div class="row g-4 mb-4">
      <div class="col-md-6">
        <label>Information</label>
        <textarea name="information" class="form-control" rows="4" required>{{ old('information', $family->information ?? '') }}</textarea>
      </div>
      <div class="col-md-6">
        <label>Status</label>
        <select name="status" class="form-select" required>
          @php $status = old('status', $family->status ?? 'active'); @endphp
          <option value="active" {{ $status=='active' ? 'selected' : '' }}>Active</option>
          <option value="inactive" {{ $status=='inactive' ? 'selected' : '' }}>Inactive</option>
          <option value="suspended" {{ $status=='suspended' ? 'selected' : '' }}>Suspended</option>
        </select>
      </div>
    </div>

    <div class="row g-4 mb-4">
      <div class="col-md-6">
        <label>Goal</label>
        <input type="number" name="goal" class="form-control"
               value="{{ old('goal', $family->goal ?? 100) }}">
      </div>
      <div class="col-md-6">
        <label>Donated</label>
        <input type="number" name="donated" class="form-control"
               value="{{ old('donated', $family->donated ?? 0) }}">
      </div>
    </div>

    <div class="mb-4">
      <label>Upload Family Image</label>
      <input type="file" name="img" class="form-control">
      @if(isset($family) && $family->img)
        <div class="mt-2">
          <img src="{{ asset('storage/'.$family->img) }}" alt="Family Image" width="120" class="rounded shadow-sm">
        </div>
      @endif
    </div>

    {{-- Private Info --}}
    <h4 class="mb-3">Private Family Information</h4>
    <div class="row g-4 mb-4">
      <div class="col-md-6">
        <label>Real Name</label>
        <input type="text" name="real_name" class="form-control"
               value="{{ old('real_name', $family->real_name ?? '') }}" required>
      </div>
      <div class="col-md-6">
        <label>Address</label>
        <textarea name="address" class="form-control" rows="2" required>{{ old('address', $family->address ?? '') }}</textarea>
      </div>
    </div>

    <div class="row g-4 mb-4">
      <div class="col-md-6">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control"
               value="{{ old('phone', $family->phone ?? '') }}">
      </div>
      <div class="col-md-6">
        <label>Income</label>
        <input type="number" step="0.01" name="income" class="form-control"
               value="{{ old('income', $family->income ?? '') }}">
      </div>
    </div>

    <div class="row g-4 mb-4">
      <div class="col-md-6">
        <label>Notes</label>
        <textarea name="notes" class="form-control" rows="3">{{ old('notes', $family->notes ?? '') }}</textarea>
      </div>
      <div class="col-md-6">
        <label>National ID (Encrypted)</label>
        <input type="text" name="national_id_encrypted" class="form-control"
               value="{{ old('national_id_encrypted', $family->national_id_encrypted ?? '') }}">
      </div>
    </div>

    <div class="mb-4">
      <label>KYC Documents</label>
      <input type="file" name="kyc_documents[]" class="form-control" multiple>
    </div>

    <hr class="my-5">

    {{-- Family Needs --}}
    <h4 class="mb-3">Family Needs</h4>

    <div class="row g-4 mb-4">
      <div class="col-md-6">
        <label>Need Category</label>
        <select name="type" class="form-select" required>
          @php $type = old('type', $familyNeed->type ?? ''); @endphp
          <option value="">Select Need</option>
          <option value="food" {{ $type=='food' ? 'selected' : '' }}>Food</option>
          <option value="medicine" {{ $type=='medicine' ? 'selected' : '' }}>Medicine</option>
          <option value="rent" {{ $type=='rent' ? 'selected' : '' }}>House Rent</option>
        </select>
      </div>
      <div class="col-md-6">
        <label>Need Description</label>
        <textarea name="need_description" class="form-control" rows="3" required>{{ old('need_description', $familyNeed->description ?? '') }}</textarea>
      </div>
    </div>

    <div class="mt-4">
      <button type="submit" class="btn-yellow w-100 py-2">
        {{ isset($family) ? 'Update Family' : 'Save Family' }}
      </button>
    </div>
  </form>
</div>
@endsection
