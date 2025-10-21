@extends('layout.dashboard')

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/Accredited.css') }}">
    @endpush

<section class="hero">
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <h2>{{ isset($family) ? 'Edit Family' : 'Add New Family' }}</h2>
    <p>Home / <span>{{ isset($family) ? 'Edit Family' : 'Create Family' }}</span></p>
  </div>
</section>

<div class="container my-5 form-section">

    <x-alert name="success" />
    <x-alert name="error" />

  <form action="{{ isset($family) ? route('admin.families.update', $family->id) : route('admin.families.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($family))
        @method('PUT')
    @endif

    <h4 class="mb-3">Public Family Information</h4>
    <div class="row g-4 mb-4">
      <div class="col-md-4">
        <label>Alias</label>
        <input type="text" name="alias" class="form-control" required value="{{ $family->alias ?? '' }}">
      </div>
      <div class="col-md-4">
        <label>Public Region</label>
        <input type="text" name="public_region" class="form-control" required value="{{ $family->public_region ?? '' }}">
      </div>
      <div class="col-md-4">
        <label>Members Count</label>
        <input type="number" name="members_count" class="form-control" required value="{{ $family->members_count ?? '' }}">
      </div>
    </div>

    <div class="row g-4 mb-4">
      <div class="col-md-6">
        <label>Information</label>
        <textarea name="information" class="form-control" rows="4" required>{{ $family->information ?? '' }}</textarea>
      </div>
      <div class="col-md-6">
        <label>Status</label>
        <select name="status" class="form-select" required>
          <option value="active" {{ isset($family) && $family->status=='active' ? 'selected' : '' }}>Active</option>
          <option value="inactive" {{ isset($family) && $family->status=='inactive' ? 'selected' : '' }}>Inactive</option>
          <option value="suspended" {{ isset($family) && $family->status=='suspended' ? 'selected' : '' }}>Suspended</option>
        </select>
      </div>
    </div>

    <div class="row g-4 mb-4">
      <div class="col-md-6">
        <label>Goal</label>
        <input type="number" name="goal" class="form-control" value="{{ $family->goal ?? 100 }}">
      </div>
      <div class="col-md-6">
        <label>Donated</label>
        <input type="number" name="donated" class="form-control" value="{{ $family->donated ?? 0 }}">
      </div>
    </div>

    <div class="mb-4">
      <label>Upload Family Image</label>
      <input type="file" name="img" class="form-control">
      @if(isset($family) && $family->img)
        <img src="{{ asset('storage/'.$family->img) }}" alt="" width="100" class="mt-2">
      @endif
    </div>

    <h4 class="mb-3">Private Family Information</h4>
    <div class="row g-4 mb-4">
      <div class="col-md-6">
        <label>Real Name</label>
        <input type="text" name="real_name" class="form-control" required value="{{ $family->real_name ?? '' }}">
      </div>
      <div class="col-md-6">
        <label>Address</label>
        <textarea name="address" class="form-control" rows="2" required>{{ $family->address ?? '' }}</textarea>
      </div>
    </div>

    <div class="row g-4 mb-4">
      <div class="col-md-6">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ $family->phone ?? '' }}">
      </div>
      <div class="col-md-6">
        <label>Income</label>
        <input type="number" step="0.01" name="income" class="form-control" value="{{ $family->income ?? '' }}">
      </div>
    </div>

    <div class="row g-4 mb-4">
      <div class="col-md-6">
        <label>Notes</label>
        <textarea name="notes" class="form-control" rows="3">{{ $family->notes ?? '' }}</textarea>
      </div>
      <div class="col-md-6">
        <label>National ID (Encrypted)</label>
        <input type="text" name="national_id_encrypted" class="form-control" value="{{ $family->national_id_encrypted ?? '' }}">
      </div>
    </div>

    <div class="mb-4">
      <label>KYC Documents</label>
      <input type="file" name="kyc_documents[]" class="form-control" multiple>
    </div>

    <hr class="my-5">
    <h4 class="mb-3">Family Needs</h4>

    <div class="row g-4 mb-4">
      <div class="col-md-6">
        <label>Need Category</label>
        <select name="type" class="form-select" required>
          <option value="">Select Need</option>
          <option value="food" {{ isset($familyNeed) && $familyNeed->type=='food' ? 'selected' : '' }}>Food</option>
          <option value="medicine" {{ isset($familyNeed) && $familyNeed->type=='medicine' ? 'selected' : '' }}>Medicine</option>
          <option value="rent" {{ isset($familyNeed) && $familyNeed->type=='rent' ? 'selected' : '' }}>House Rent</option>
        </select>
      </div>
      <div class="col-md-6">
        <label>Need Description</label>
        <textarea name="need_description" class="form-control" rows="3" placeholder="Describe the family's need..." required>{{ $familyNeed->description ?? '' }}</textarea>
      </div>
    </div>

    <div class="mt-4">
      <button type="submit" class="btn-yellow">{{ isset($family) ? 'Update Family' : 'Save Family' }}</button>
    </div>
  </form>
</div>
@endsection
