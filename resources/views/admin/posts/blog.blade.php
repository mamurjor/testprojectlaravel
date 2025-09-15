@extends('layouts.app')

@section('content')
    <style>
        /* Minimal modern touches */
        .card-zoom {
            overflow: hidden;
            border-radius: 16px;
        }

        .card-zoom img {
            transition: transform .5s ease;
        }

        .card-zoom:hover img {
            transform: scale(1.06);
        }

        .card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, .65) 0%, rgba(0, 0, 0, .15) 60%, rgba(0, 0, 0, 0) 100%);
            color: #fff;
            display: flex;
            align-items: end;
            padding: 1rem;
            border-radius: 16px;
        }

        .post-meta {
            font-size: .85rem;
            color: rgba(255, 255, 255, .9);
        }

        .badge-soft {
            background-color: rgba(255, 255, 255, .15);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, .25);
        }

        .list-clean .list-group-item {
            border: 0;
            padding-left: 0;
            padding-right: 0;
        }

        .list-clean .list-group-item+.list-group-item {
            border-top: 1px dashed rgba(0, 0, 0, .08);
        }
    </style>

    <div class="container my-5">
        <div class="row gx-4">
            {{-- Sidebar: Categories --}}
            <aside class="col-lg-3 mb-4 mb-lg-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Categories</h5>

                        <form method="GET" action="{{ route('blog.index') }}" class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" placeholder="Search posts..."
                                    value="{{ request('q') }}">
                                <button class="btn btn-outline-secondary" type="submit"><i
                                        class="bi bi-search"></i></button>
                            </div>
                        </form>

                        <ul class="list-group list-group-flush list-clean">
                            @forelse($categories as $cat)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a class="text-decoration-none"
                                        href="{{ route('blog.category', $cat) }}">{{ $cat->name }}</a>
                                    <i class="bi bi-chevron-right small text-muted"></i>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">No categories</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </aside>

            {{-- Main: Modern Grid --}}
            <main class="col-lg-9">
                <div class="d-flex justify-content-between align-items-end mb-3">
                    <div>
                        <h1 class="h4 fw-bold mb-1">Blog</h1>
                        <div class="text-muted small">
                            Showing {{ $posts->firstItem() ?? 0 }}–{{ $posts->lastItem() ?? 0 }} of {{ $posts->total() }}
                            posts
                        </div>
                    </div>
                    <form method="GET" action="{{ route('blog.index') }}" class="d-none d-md-block">
                        <input type="hidden" name="q" value="{{ request('q') }}">
                        <select class="form-select form-select-sm" name="sort" onchange="this.form.submit()">
                            <option value="" {{ request('sort') === '' ? 'selected' : '' }}>Newest</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                        </select>
                    </form>
                </div>

                @if ($posts->count())
                    {{-- Magazine-style responsive grid --}}
                    <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
                        @foreach ($posts as $post)
                            @php
                                $raw = $post->featured_image ?? 'https://picsum.photos/seed/' . $post->id . '/1000/700';
                                $img = Str::startsWith($raw, ['http://', 'https://'])
                                    ? $raw
                                    : asset('uploads/post_featured_image/' . $raw);
                                $firstCat = $post->categories->first();
                            @endphp
                            <div class="col">
                                <div class="position-relative card-zoom shadow-sm">
                                    <a href="{{ route('blog.show', $post) }}" class="text-decoration-none">
                                        <img src="{{ $img }}" class="w-100" alt="{{ $post->title }}"
                                            loading="lazy">
                                        <div class="card-overlay">
                                            <div class="w-100">
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    @if ($firstCat)
                                                        <a href="{{ route('blog.category', $firstCat) }}"
                                                            class="badge badge-soft text-decoration-none">{{ $firstCat->name }}</a>
                                                    @endif
                                                    <span class="post-meta">
                                                        <i
                                                            class="bi bi-calendar3 me-1"></i>{{ optional($post->published_at)->format('M d, Y') }}
                                                        @if ($post->author?->name)
                                                            • {{ $post->author->name }}
                                                        @endif
                                                    </span>
                                                </div>
                                                <h5 class="mb-2 text-white">{{ $post->title }}</h5>
                                                @if ($post->excerpt)
                                                    <div class="text-white-50 small">
                                                        {{ \Illuminate\Support\Str::limit($post->excerpt, 110) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                {{-- Tags under card (optional) --}}
                                @if ($post->categories->count())
                                    <div class="mt-2">
                                        @foreach ($post->categories as $c)
                                            <a href="{{ route('blog.category', $c) }}"
                                                class="badge bg-light text-dark border me-1 mb-1 text-decoration-none">#{{ $c->name }}</a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center mt-4">
                        {{ $posts->withQueryString()->links() }}
                    </div>
                @else
                    <div class="alert alert-light border text-center" role="alert">
                        No posts found.
                    </div>
                @endif
            </main>
        </div>
    </div>
@endsection
