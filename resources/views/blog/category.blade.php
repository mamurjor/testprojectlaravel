@extends('layouts.app')
@section('content')
    <div class="container my-5">

        {{-- Header / Breadcrumb --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-end mb-3">
            <div>
                <h1 class="h3 fw-bold mb-1">Category: {{ $category->name }}</h1>
                @if ($category->description)
                    <p class="text-muted mb-0">{{ $category->description }}</p>
                @endif
            </div>
            <span class="badge bg-primary-subtle text-primary mt-2 mt-md-0">
                {{ $posts->total() }} post{{ $posts->total() > 1 ? 's' : '' }}
            </span>
        </div>

        @if ($posts->count())
            <div class="row g-4">
                @foreach ($posts as $post)
                    @php
                        $img = $post->featured_image
                            ? asset('uploads/post_featured_image/' . $post->featured_image)
                            : 'https://picsum.photos/seed/' . $post->id . '/1000/700';
                    @endphp
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <a href="{{ route('blog.show', $post) }}" class="text-decoration-none">
                                <img src="{{ $img }}" class="card-img-top" alt="{{ $post->title }}"
                                    loading="lazy">
                            </a>
                            <div class="card-body">
                                <div class="small text-muted mb-1">
                                    <i
                                        class="bi bi-calendar3 me-1"></i>{{ optional($post->published_at)->format('M d, Y') }}
                                </div>
                                <h5 class="card-title mb-2">
                                    <a href="{{ route('blog.show', $post) }}"
                                        class="stretched-link text-decoration-none text-dark">
                                        {{ $post->title }}
                                    </a>
                                </h5>
                                @if ($post->excerpt)
                                    <p class="card-text text-muted mb-0">
                                        {{ \Illuminate\Support\Str::limit($post->excerpt, 120) }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->links() }}
            </div>
        @else
            <div class="alert alert-light border text-center" role="alert">
                No posts in this category.
            </div>
        @endif

    </div>
@endsection
