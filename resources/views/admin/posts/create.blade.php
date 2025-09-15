@extends('layouts.adminlayout')
@section('maincontent')
    <div class="container my-5">
        <div class="card border-0 shadow-lg rounded-3">
            <div class="card-header bg-gradient bg-primary text-white py-3 d-flex align-items-center">
                <i class="bi bi-pencil-square me-2 fs-4"></i>
                <h4 class="mb-0">✍️ Create New Post</h4>
            </div>
            <div class="card-body p-4">

                {{-- Error Alert --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>⚠️ Please fix the following:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Title & Slug --}}
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Post Title</label>
                            <input type="text" class="form-control form-control-lg shadow-sm" name="title"
                                value="{{ old('title') }}" placeholder="Enter a catchy title..." required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Slug <small class="text-muted">(optional)</small></label>
                            <input type="text" class="form-control shadow-sm" name="slug" value="{{ old('slug') }}"
                                placeholder="auto-generated if empty">
                        </div>
                    </div>

                    {{-- Excerpt --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Excerpt</label>
                        <textarea class="form-control shadow-sm" name="excerpt" rows="2" placeholder="A short summary for your post...">{{ old('excerpt') }}</textarea>
                    </div>

                    {{-- Featured Image --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Featured Image</label>
                        <input type="file" class="form-control shadow-sm" name="featured_image" accept="image/*">
                        <small class="text-muted">Upload a main image for this post (jpg, png, webp).</small>
                    </div>
                    {{-- Content --}}

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Content</label>
                        <textarea id="content" class="form-control" name="content" rows="10" required>{{ old('content') }}</textarea>
                    </div>


                    {{-- Categories --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Categories</label>
                        <div class="row g-2">
                            @foreach ($categories as $cat)
                                <div class="col-md-4">
                                    <div class="form-check border rounded p-2 shadow-sm h-100">
                                        <input class="form-check-input" type="checkbox" name="categories[]"
                                            value="{{ $cat->id }}" id="cat{{ $cat->id }}">
                                        <label class="form-check-label" for="cat{{ $cat->id }}">
                                            {{ $cat->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Status & Publish Date --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select shadow-sm" name="status">
                                <option value="draft">📝 Draft</option>
                                <option value="published">✅ Published</option>

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Publish Date</label>
                            <input type="datetime-local" class="form-control shadow-sm" name="published_at">
                        </div>
                    </div>

                    {{-- Save Button --}}
                    <div class="text-end">
                        <button class="btn btn-gradient btn-primary px-5 py-2 shadow-sm fw-semibold" type="submit">
                            <i class="bi bi-save2 me-1"></i> Save Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                placeholder: 'Write your post content here...',
                tabsize: 2,
                height: 400,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],

                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endpush
