{{-- resources/views/admin/contact_messages/index.blade.php --}}
@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container py-4">

        {{-- Header + Quick Stats --}}
        <div class="card border-0 shadow-lg mb-4 overflow-hidden">
            <div class="card-header text-white" style="background:linear-gradient(90deg,#0d6efd,#6f42c1)">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <h3 class="mb-0 fw-bold">📨 Contact Messages</h3>
                    @if (session('success'))
                        <span class="badge bg-success-subtle text-success-emphasis rounded-pill px-3 py-2 shadow-sm">
                            ✅ {{ session('success') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    {{-- Search --}}
                    <div class="col-12 col-md-6">
                        <form method="get" class="d-flex gap-2">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-body-tertiary border-0 rounded-pill-start">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" name="q" value="{{ $q }}"
                                    class="form-control border-0 bg-body-tertiary rounded-pill-end"
                                    placeholder="Search by name / email / phone">
                            </div>
                            <button class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm">Search</button>
                        </form>
                    </div>

                    {{-- Quick Actions --}}
                    <div class="col-12 col-md-auto d-flex gap-2">
                        <button class="btn btn-outline-secondary rounded-pill px-3" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#filtersOffcanvas">
                            <i class="bi bi-sliders2"></i> Filters
                        </button>
                        <a href="{{ route('admin.contact.index') }}" class="btn btn-outline-dark rounded-pill px-3">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </a>
                    </div>

                    {{-- Mini Stats (optional) --}}
                    <div class="col-12">
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge rounded-pill bg-primary-subtle text-primary-emphasis px-3 py-2">
                                <i class="bi bi-envelope-paper me-1"></i> Total: {{ $messages->total() }}
                            </span>
                            <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis px-3 py-2">
                                <i class="bi bi-bell me-1"></i> New: {{ $messages->where('is_read', false)->count() }}
                            </span>
                            <span class="badge rounded-pill bg-success-subtle text-success-emphasis px-3 py-2">
                                <i class="bi bi-check2-circle me-1"></i> Read:
                                {{ $messages->where('is_read', true)->count() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="card border-0 shadow-lg">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-light position-sticky top-0" style="z-index:1">
                        <tr>
                            <th class="text-nowrap">SL</th>
                            <th>From</th>
                            <th>Email</th>
                            <th class="d-none d-md-table-cell">Phone</th>
                            <th class="text-nowrap">Received</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @forelse($messages as $m)
                            <tr class="hover-row">
                                {{-- ✅ Pagination-aware Serial Number (starts at 1) --}}
                                <td class="fw-semibold text-secondary">
                                    {{ $messages->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-circle">{{ strtoupper(substr($m->name, 0, 1)) }}</div>
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold">{{ $m->name }}</span>
                                            <small class="text-muted d-md-none">{{ $m->phone }}</small>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <a href="mailto:{{ $m->email }}" class="link-primary text-decoration-none">
                                        <i class="bi bi-envelope-open me-1"></i>{{ $m->email }}
                                    </a>
                                </td>

                                <td class="d-none d-md-table-cell">{{ $m->phone }}</td>

                                <td class="text-muted">
                                    <i class="bi bi-clock me-1"></i>{{ $m->created_at->diffForHumans() }}
                                </td>

                                <td>
                                    @if ($m->is_read)
                                        <span class="badge rounded-pill bg-success-subtle text-success-emphasis px-3 py-2">
                                            <i class="bi bi-check2-circle me-1"></i> Read
                                        </span>
                                    @else
                                        <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis px-3 py-2">
                                            <i class="bi bi-dot me-1"></i> New
                                        </span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm"
                                            href="{{ route('admin.contact.show', $m) }}">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                      
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-5">
                                    <div class="text-center text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                        <div class="fw-semibold">No messages found</div>
                                        <small>Try adjusting filters or clearing the search.</small>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="card-footer bg-body-tertiary">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <small class="text-muted">
                        Showing {{ $messages->firstItem() }}–{{ $messages->lastItem() }} of {{ $messages->total() }}
                    </small>
                    <nav>
                        {{ $messages->onEachSide(1)->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- Offcanvas Filters --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="filtersOffcanvas" aria-labelledby="filtersOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="filtersOffcanvasLabel"><i class="bi bi-sliders2 me-2"></i>Filters</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form method="get" class="vstack gap-3">
                <div>
                    <label class="form-label">Keyword</label>
                    <input type="text" name="q" value="{{ $q }}" class="form-control"
                        placeholder="Name / Email / Phone">
                </div>
                <div>
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Any</option>
                        <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
                        <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                    </select>
                </div>
                <div class="row g-2">
                    <div class="col-6">
                        <label class="form-label">From</label>
                        <input type="date" name="from" value="{{ request('from') }}" class="form-control">
                    </div>
                    <div class="col-6">
                        <label class="form-label">To</label>
                        <input type="date" name="to" value="{{ request('to') }}" class="form-control">
                    </div>
                </div>
                <div>
                    <label class="form-label">Per Page</label>
                    <select name="per_page" class="form-select">
                        @foreach ([10, 20, 50, 100] as $n)
                            <option value="{{ $n }}" {{ (int) request('per_page') === $n ? 'selected' : '' }}>
                                {{ $n }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="d-grid gap-2 mt-2">
                    <button class="btn btn-primary"><i class="bi bi-funnel me-1"></i> Apply Filters</button>
                    <a href="{{ route('admin.contact.index') }}" class="btn btn-outline-secondary">Clear All</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Tiny CSS tweaks --}}
    <style>
        .hover-row:hover {
            background-color: var(--bs-table-hover-bg);
        }

        .avatar-circle {
            width: 38px;
            height: 38px;
            display: inline-grid;
            place-items: center;
            border-radius: 50%;
            font-weight: 700;
            background: rgba(13, 110, 253, .12);
            color: #0d6efd;
        }

        @media (max-width: 576px) {

            /* Mobile: stack-like divider */
            table.table tbody tr {
                border-bottom: 1px solid var(--bs-border-color);
            }
        }
    </style>
@endsection
