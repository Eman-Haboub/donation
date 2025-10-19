{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
{{-- @extends('layouts.app')

@section('content')
@push('styles')
<style>
    .family-card {
        margin-bottom: 20px;
    }
    .family-card img {
        max-width: 150px;
        height: auto;
        border-radius: 8px;
    }
    .kyc-docs a {
        display: inline-block;
        margin-right: 5px;
        font-size: 14px;
    }
</style>
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush
<div class="container mt-5">
    <h2 class="mb-4">Welcome, {{ auth()->user()->name }}!</h2>
    <div class="mb-4">
        <p><strong>Status:</strong> {{ auth()->user()->status }}</p>
        <p><strong>Role:</strong> {{ auth()->user()->role }}</p>
        <p><strong>Balance:</strong> ${{ auth()->user()->balance }}</p>
        <p><strong>Last Login:</strong> {{ auth()->user()->last_login_at }}</p>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger mt-3">Logout</button>
        </form>
    </div> --}}

    {{-- Private Families --}}
    {{-- @if($privateFamilies->count())
        <h3>Private Family Information</h3>
        @foreach($privateFamilies as $family)
        <div class="card family-card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $family->real_name }}</h5>
                <p><strong>Address:</strong> {{ $family->address }}</p>
                <p><strong>Phone:</strong> {{ $family->phone }}</p>
                <p><strong>Income:</strong> ${{ $family->income }}</p>
                <p><strong>Notes:</strong> {{ $family->notes }}</p>
                <p><strong>Verified:</strong> {{ $family->verified ? 'Yes' : 'No' }}</p>

                @if($family->kyc_documents)
                    <div class="kyc-docs mb-2">
                        <strong>KYC Documents:</strong>
                        @foreach(json_decode($family->kyc_documents) as $doc)
                            <a href="{{ asset($doc) }}" target="_blank">{{ basename($doc) }}</a>
                        @endforeach
                    </div>
                @endif

                <a href="{{ route('families.edit', $family->id) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
        @endforeach
    @endif --}}

    {{-- Public Families --}}
    {{-- @if($publicFamilies->count())
        <h3 class="mt-5">Public Family Information</h3>
        @foreach($publicFamilies as $family)
        <div class="card family-card shadow-sm">
            <div class="card-body d-flex flex-wrap align-items-center">
                <div class="me-3">
                    @if($family->img)
                        <img src="{{ asset($family->img) }}" alt="{{ $family->alias }}">
                    @endif
                </div>
                <div class="flex-fill">
                    <h5 class="card-title">{{ $family->alias }}</h5>
                    <p><strong>Region:</strong> {{ $family->public_region }}</p>
                    <p><strong>Members Count:</strong> {{ $family->members_count }}</p>
                    <p><strong>Status:</strong> {{ $family->status }}</p>
                    <p><strong>Donated:</strong> ${{ $family->donated }} / ${{ $family->goal }}</p>
                    <p><strong>Information:</strong> {{ $family->information }}</p>
                    <a href="{{ route('families.edit', $family->id) }}" class="btn btn-primary mt-2">Edit</a>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection --}}
