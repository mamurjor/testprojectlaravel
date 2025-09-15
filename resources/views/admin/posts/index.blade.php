@extends('layouts.adminlayout')
@section('maincontent')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0 fw-bold">📚 Blog Posts</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> New Post
            </a>
        </div>

        {{-- Success flash --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                @if ($posts->count())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Published</th>
                                    <th>Categories</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td style="min-width:260px">
                                            <a href="{{ route('blog.show', $post) }}"
                                                class="fw-semibold text-decoration-none">
                                                {{ $post->title }}
                                            </a>
                                            @if ($post->excerpt)
                                                <div class="text-muted small">{{ Str::limit($post->excerpt, 80) }}</div>
                                            @endif>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $post->author->name }}</span>
                                        </td>
                                        <td>{{ optional($post->published_at)->format('M d, Y') }}</td>
                                        <td>
                                            @foreach ($post->categories as $c)
                                                <a href="{{ route('blog.category', $c) }}"
                                                    class="badge bg-light text-dark border">#{{ $c->name }}</a>
                                            @endforeach
                                        </td>
                                        <td class="text-end" style="white-space: nowrap;">
                                            <a href="{{ route('posts.edit', $post) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>

                                            <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                                class="d-inline-block"
                                                onsubmit="return confirm('Delete this post permanently?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center mt-4">
                        {{ $posts->links() }}
                    </div>
                @else
                    <p class="text-muted text-center my-4">No posts found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
