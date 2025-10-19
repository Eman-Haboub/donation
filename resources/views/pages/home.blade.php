@extends('layout.app')

@section('title', __('home'))

@section('content')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush
  {{-- الهيرو --}}
  @include('sections.hero')
  @include('sections.box')

  {{-- البطاقات --}}
  @include('sections.cards')

  {{-- القضايا --}}

  {{-- من نحن --}}
  @include('sections.about')

  {{-- الأخبار والمدونة --}}
  @include('sections.news')

  {{-- المعرض --}}
  @include('sections.gallery')

  {{-- تواصل معنا --}}
  @include('sections.contact')

@endsection
