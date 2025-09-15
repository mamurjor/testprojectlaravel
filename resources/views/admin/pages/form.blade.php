{{-- resources/views/pages/form.blade.php --}}
@extends('layouts.adminlayout')

@section('title', $page->exists ? 'Edit Page' : 'Create Page')

@section('maincontent')
    <div class="container py-4">

        {{-- Header Bar --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0 fw-semibold">
                    {{ $page->exists ? 'Edit Page' : 'Create Page' }}
                </h4>
                <small class="text-muted">Manage your static page content, SEO and publish options</small>
            </div>
            <a href="{{ route('pages.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        {{-- Alerts --}}
        @if ($errors->any())
            <div class="alert alert-danger shadow-sm">
                <div class="fw-semibold mb-2">Please fix the following:</div>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif

        <form action="{{ $page->exists ? route('pages.update', $page) : route('pages.store') }}" method="post"
            enctype="multipart/form-data" id="pageForm">
            @csrf
            @if ($page->exists)
                @method('PUT')
            @endif

            <div class="row g-4">
                {{-- Main Column --}}
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">

                            {{-- Title + Slug --}}
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-type"></i></span>
                                        <input type="text" name="title" id="titleInput" class="form-control"
                                            value="{{ old('title', $page->title) }}" required
                                            placeholder="Enter page title">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Slug</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-link-45deg"></i></span>
                                        <input type="text" name="slug" id="slugInput" class="form-control"
                                            value="{{ old('slug', $page->slug) }}" placeholder="auto from title">
                                    </div>
                                    <small class="text-muted">Leave blank to auto-generate from title</small>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="mt-4">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <label class="form-label fw-semibold m-0">Content</label>
                                    <span class="badge rounded-pill bg-primary-subtle text-primary-emphasis">
                                        <i class="bi bi-pencil-square me-1"></i> Rich Text
                                    </span>
                                </div>
                                @php $content = old('content', $page->content); @endphp
                                <textarea name="content" id="contentEditor" class="form-control" rows="12">{!! $content !!}</textarea>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Side Column --}}
                <div class="col-lg-4">

                    {{-- Publish Card --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white py-3">
                            <div class="fw-semibold"><i class="bi bi-rocket-takeoff me-2"></i>Publish Settings</div>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                @php $status = old('status', $page->status ?: 'draft'); @endphp
                                <select name="status" class="form-select">
                                    <option value="draft" {{ $status === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ $status === 'published' ? 'selected' : '' }}>Published
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Publish At (optional)</label>
                                <input type="datetime-local" name="published_at" class="form-control"
                                    value="{{ old('published_at', $page->published_at ? $page->published_at->format('Y-m-d\TH:i') : '') }}">
                                <small class="text-muted">Schedule for future publishing if needed</small>
                            </div>
                        </div>
                    </div>

                    {{-- Featured Image (robust URL resolver) --}}
                    @php
                        $rawFi = $page->featured_image;
                        $fiUrl = asset('images/placeholder-banner.png');
                        if (!empty($rawFi)) {
                            if (preg_match('#^https?://#i', $rawFi)) {
                                $fiUrl = $rawFi;
                            } elseif (str_starts_with($rawFi, '/storage')) {
                                $fiUrl = asset(ltrim($rawFi, '/'));
                            } elseif (str_starts_with($rawFi, 'storage/')) {
                                $fiUrl = asset($rawFi);
                            } elseif (str_starts_with($rawFi, 'public/')) {
                                $fiUrl = asset(preg_replace('#^public/#', 'storage/', $rawFi));
                            } else {
                                $fiUrl = asset(ltrim($rawFi, '/'));
                            }
                        }
                    @endphp

                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white py-3">
                            <div class="fw-semibold"><i class="bi bi-image me-2"></i>Featured Image {{ $fiUrl }}
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start gap-3">
                                <div class="flex-grow-1">
                                    <input type="file" name="featured_image" id="fiInput" class="form-control"
                                        accept=".jpg,.jpeg,.png,.webp,.gif">
                                    <small class="text-muted d-block mt-2">Recommended: 1200×600px (JPG/PNG/WebP)</small>
                                </div>
                                <img id="fiPreview" src="{{ $fiUrl }}" onerror="this.src='{{ $fiUrl }}'"
                                    alt="Featured" class="border rounded"
                                    style="height: 90px; aspect-ratio: 3/1; object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    {{-- SEO Accordion --}}
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <div class="fw-semibold"><i class="bi bi-search me-2"></i>SEO (Meta)</div>
                        </div>
                        <div class="card-body p-0">
                            <div class="accordion accordion-flush" id="seoAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="metaHead">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#metaBody" aria-expanded="false"
                                            aria-controls="metaBody">
                                            Meta Options
                                        </button>
                                    </h2>
                                    <div id="metaBody" class="accordion-collapse collapse" aria-labelledby="metaHead"
                                        data-bs-parent="#seoAccordion">
                                        <div class="accordion-body">
                                            <div class="mb-3">
                                                <label class="form-label">Meta Title</label>
                                                <input type="text" name="meta_title" class="form-control"
                                                    value="{{ old('meta_title', $page->meta_title) }}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Meta Keywords (comma separated)</label>
                                                <input type="text" name="meta_keywords" class="form-control"
                                                    value="{{ old('meta_keywords', $page->meta_keywords) }}">
                                            </div>

                                            <div class="mb-0">
                                                <label class="form-label">Meta Description</label>
                                                <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $page->meta_description) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div> {{-- item --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sticky Action Bar --}}
            <div class="action-bar bg-white border-top shadow-sm mt-4 py-3 position-sticky bottom-0">
                <div class="container d-flex justify-content-end gap-2">
                    <button class="btn btn-success px-4" type="submit">
                        <i class="bi bi-save2 me-1"></i> {{ $page->exists ? 'Update' : 'Create' }}
                    </button>
                    <a class="btn btn-outline-secondary px-4" href="{{ route('pages.index') }}">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <style>
        .action-bar {
            z-index: 1020;
        }

        .card {
            border-radius: .8rem;
        }

        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, .05);
        }

        .form-label {
            font-weight: 600;
        }

        .note-editor.note-frame {
            border-radius: .6rem;
            overflow: hidden;
        }
    </style>
@endpush

@push('script')
    <script>
        (function() {
            // Auto-slug from title
            const titleEl = document.getElementById('titleInput');
            const slugEl = document.getElementById('slugInput');
            let userEditedSlug = false;

            const slugify = (text) => text.toString()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .toLowerCase().trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

            slugEl?.addEventListener('input', () => userEditedSlug = slugEl.value.trim().length > 0);
            titleEl?.addEventListener('input', () => {
                if (!userEditedSlug && slugEl) slugEl.value = slugify(titleEl.value);
            });

            // Featured image live preview (client-side)
            const fiInput = document.getElementById('fiInput');
            const fiPreview = document.getElementById('fiPreview');
            fiInput?.addEventListener('change', (e) => {
                const file = e.target.files?.[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = () => fiPreview.src = reader.result;
                reader.readAsDataURL(file);
            });

            // Summernote init (image/video OFF)
            const $editor = $('#contentEditor');
            $editor.summernote({
                placeholder: 'Write content here…',
                height: 420,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']], // <-- only link; picture/video removed
                    ['view', ['codeview', 'help']]
                ]
            });
        })();
    </script>
@endpush
