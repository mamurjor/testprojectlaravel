{{-- resources/views/pages/show.blade.php --}}
@extends('layouts.front') {{-- আপনার ফ্রন্ট লেআউট --}}
@section('content')
    <section class="container py-5">
        <h1 class="mb-3">{{ $page->title }}</h1>
        @if ($page->featured_image)
            <img src="{{ asset($page->featured_image) }}" alt="{{ $page->title }}" class="img-fluid mb-4">
        @endif
        <article class="content">
            {!! $page->content !!}
        </article>
    </section>
@endsection
