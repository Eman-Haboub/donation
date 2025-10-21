@extends('layout.dashboard')

@section('content')


<section class="hero">
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <h2>{{ isset($donor) ? 'Edit Donor' : 'Add New Donor' }}</h2>
    <p>Home / <span>{{ isset($donor) ? 'Edit Donor' : 'Create Donor' }}</span></p>
  </div>
</section>

<div class="container my-5 form-section">

    <x-alert name="success" />
    <x-alert name="error" />

  <form action="{{ isset($donor) ? route('admin.donors.update', $donor->id) : route('admin.donors.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($donor))
        @method('PUT')
    @endif

    <h4 class="mb-3">Public Donor Information</h4>
    <div class="row g-4 mb-4">

      <div class="col-md-4">
        <label>Donor Name</label>
        <input type="text" name="name" class="form-control" required value="{{ $donor->name ?? '' }}">
      </div>

      <div class="col-md-4">
        <label>Donor Email</label>
        <input type="email" name="email" class="form-control" required value="{{ $donor->email ?? '' }}">
      </div>

      <div class="col-md-4">
        <label>Password</label>
        <input type="password" name="password"  autocomplete="new-password" class="form-control"   @if(!isset($donor)) required @endif>
      </div>

      <div class="col-md-4">
        <label>Confirm Password</label>
        <input  type="password" name="password_confirmation"  autocomplete="new-password" class="form-control"  @if(!isset($donor)) required @endif>
      </div>

    </div>



    <div class="mt-4">
      <button type="submit" class="btn-yellow">{{ isset($donor) ? 'Update Donor' : 'Save Donor' }}</button>
    </div>
  </form>
</div>
@endsection
