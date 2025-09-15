{{-- resources/views/admin/pages/index.blade.php --}}
@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Pages</h4>
            <a href="{{ route('pages.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> New Page
            </a>

        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger mb-2">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Filter / Sort --}}
        <form class="row g-2 mb-3" method="get">
            <div class="col-md-4">
                <input type="text" name="q" value="{{ $q }}" class="form-control"
                    placeholder="Search by title or slug">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="all" {{ $status === 'all' ? 'selected' : '' }}>All statuses</option>
                    <option value="published" {{ $status === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ $status === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="sort" class="form-select">
                    <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest first</option>
                    <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Oldest first</option>
                    <option value="title_asc" {{ $sort === 'title_asc' ? 'selected' : '' }}>Title A → Z</option>
                    <option value="title_desc" {{ $sort === 'title_desc' ? 'selected' : '' }}>Title Z → A</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-secondary w-100">Apply</button>
            </div>
        </form>

        @if ($pages->count())
            {{-- Bulk toolbar --}}
            <form action="{{ route('pages.bulk') }}" method="post" id="bulkForm">
                @csrf
                <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkAll">
                        <label class="form-check-label" for="checkAll">Select all</label>
                    </div>

                    <select name="action" class="form-select" style="max-width:200px;">
                        <option value="">Bulk action</option>
                        <option value="publish">Publish</option>
                        <option value="draft">Mark as Draft</option>
                        <option value="delete">Delete</option>
                    </select>
                    <button class="btn btn-outline-primary" type="submit">Apply</button>

                    <span class="ms-auto small text-muted">
                        Page {{ $pages->firstItem() }}–{{ $pages->lastItem() }} of {{ $pages->total() }}
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th style="width:40px;">
                                    <input class="form-check-input" type="checkbox" id="checkAllTop">
                                </th>
                                <th style="width:70px;">Thumb</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th style="width:110px;">Status</th>
                                <th style="width:180px;">Updated</th>
                                <th style="width:160px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $p)
                                <tr>
                                    <td>
                                        <input class="form-check-input row-check" type="checkbox" name="ids[]"
                                            value="{{ $p->id }}" id="row{{ $p->id }}">
                                    </td>
                                    <td>
                                        @if ($p->featured_image)
                                            <img src="{{ asset($p->featured_image) }}" alt="" class="rounded"
                                                style="width:60px;height:40px;object-fit:cover;">
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('pages.edit', $p->id) }}"
                                            class="fw-semibold text-decoration-none">
                                            {{ $p->title }}
                                        </a>
                                        <div class="small text-muted">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($p->content), 80) }}
                                        </div>
                                    </td>
                                    <td class="text-muted">/{{ $p->slug }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $p->status === 'published' ? 'bg-success' : 'bg-secondary' }}">
                                            @if ($p->status === 'published')
                                                <i class="bi bi-check-circle me-1"></i> Published
                                            @else
                                                <i class="bi bi-hourglass-split me-1"></i> Draft
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        {{ optional($p->updated_at)->format('d M Y, h:i A') }}
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            <a href="{{ route('pages.edit', $p->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </a>

                                            @if ($p->status === 'published')
                                                <a href="{{ route('page.public.show', $p->slug) }}" target="_blank"
                                                    class="btn btn-sm btn-outline-success">
                                                    <i class="bi bi-box-arrow-up-right me-1"></i> View
                                                </a>
                                            @endif

                                            <form action="{{ route('pages.destroy', $p->id) }}" method="post"
                                                onsubmit="return confirm('Delete this page?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>

            <div class="mt-3">
                {{ $pages->links() }}
                <div class="text-muted small mt-1">Note: bulk selection applies to the current page only.</div>
            </div>
        @else
            <div class="text-center text-muted py-5">No pages found.</div>
        @endif
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
@endpush
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const master = document.getElementById('checkAll');
            const master2 = document.getElementById('checkAllTop');
            const checks = document.querySelectorAll('.row-check');
            const bulkForm = document.getElementById('bulkForm');

            function syncMasters() {
                const all = Array.from(checks);
                const allChecked = all.every(x => x.checked);
                const anyChecked = all.some(x => x.checked);
                [master, master2].forEach(m => {
                    if (!m) return;
                    m.checked = allChecked;
                    m.indeterminate = !allChecked && anyChecked;
                });
            }

            [master, master2].forEach(m => m?.addEventListener('change', () => {
                checks.forEach(c => c.checked = m.checked);
                syncMasters();
            }));

            checks.forEach(c => c.addEventListener('change', syncMasters));
            syncMasters();

            bulkForm?.addEventListener('submit', function(e) {
                const action = bulkForm.querySelector('select[name="action"]').value;
                const anySel = bulkForm.querySelectorAll('.row-check:checked').length > 0;
                if (!action || !anySel) {
                    e.preventDefault();
                    alert('Please select an action and at least one page.');
                } else if (action === 'delete' && !confirm('Delete selected pages?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endpush
