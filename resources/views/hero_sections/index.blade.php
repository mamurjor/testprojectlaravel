@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container py-3">

        {{-- Flash --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-lg overflow-hidden">

            {{-- Fancy Header --}}
            <div class="p-3 p-md-4 text-white position-relative"
                style="background: linear-gradient(135deg,#4158D0 0%,#C850C0 46%,#FFCC70 100%);">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <span class="bg-white bg-opacity-25 p-2 rounded">
                            <i class="bi bi-image fs-4"></i>
                        </span>
                        <div>
                            <h4 class="mb-0 fw-semibold">Hero Sections</h4>
                            <small class="opacity-75">Manage home page hero sliders & banners</small>
                        </div>
                    </div>
                    <a href="{{ route('herosections.create') }}" class="btn btn-light btn-sm shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i> New Hero
                    </a>
                </div>

                {{-- Toolbar --}}

            </div>

            {{-- Table --}}
            <div class="card-body p-0">
                <div class="table-responsive" style="max-height:70vh;">
                    <table class="table table-hover align-middle mb-0 table-nowrap">
                        <thead class="table-light position-sticky top-0 z-1">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title & Subtitle</th>
                                <th>Badge</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th class="text-center" width="140">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($heroes as $hero)
                                <tr>
                                    <td class="text-muted">{{ $hero->id }}</td>

                                    {{-- Image + tiny overlay --}}
                                    <td>
                                        <div class="position-relative" style="width:84px;height:56px;">
                                            @if ($hero->image)
                                                <img src="{{ asset('uploads/slider/' . $hero->image) }}"
                                                    class="rounded object-fit-cover w-100 h-100 shadow-sm" alt="img">
                                            @else
                                                <div
                                                    class="rounded bg-body-tertiary w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                                    <i class="bi bi-image"></i>
                                                </div>
                                            @endif
                                            @if ($hero->is_active)
                                                <span class="badge bg-success position-absolute top-0 start-0 m-1">
                                                    <i class="bi bi-lightning-charge-fill"></i>
                                                </span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Title & Subtitle --}}
                                    <td style="min-width:260px;">
                                        <div class="fw-semibold">{{ $hero->title ?: 'Untitled' }}</div>
                                        <div class="text-muted small text-truncate" style="max-width:420px;">
                                            {{ $hero->subtitle ?: '—' }}
                                        </div>
                                    </td>

                                    {{-- Badge (icon + text) --}}
                                    <td>
                                        @if ($hero->badge_text || $hero->badge_icon)
                                            <span class="badge rounded-pill bg-info-subtle text-info-emphasis border">
                                                @if ($hero->badge_icon)
                                                    <i class="{{ $hero->badge_icon }} me-1"></i>
                                                @endif
                                                {{ $hero->badge_text ?: 'Badge' }}
                                            </span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>

                                    {{-- Sort order --}}
                                    <td>
                                        <span class="badge bg-dark-subtle text-dark-emphasis">
                                            <i class="bi bi-list-ol me-1"></i> {{ $hero->sort_order }}
                                        </span>
                                    </td>

                                    {{-- Status pill --}}
                                    <td>
                                        @if ($hero->is_active)
                                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                                Active</span>
                                        @else
                                            <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>
                                                Inactive</span>
                                        @endif
                                    </td>

                                    {{-- Actions --}}
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('herosections.edit', $hero) }}"
                                                class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-delete-url="{{ route('herosections.destroy', $hero) }}"
                                                data-bs-toggle-second="tooltip" title="Delete">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                            <button type="button"
                                                class="btn btn-sm btn-outline-secondary dropdown-toggle dropdown-toggle-split"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="visually-hidden">Toggle</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('herosections.edit', $hero) }}">
                                                        <i class="bi bi-pencil-square me-2"></i>Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        data-delete-url="{{ route('herosections.destroy', $hero) }}">
                                                        <i class="bi bi-trash3 me-2"></i>Delete
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                            <div class="mb-3">No hero sections found</div>
                                            <a href="{{ route('herosections.create') }}" class="btn btn-primary">
                                                <i class="bi bi-plus-circle me-1"></i> Create your first hero
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Footer: pagination + summary --}}
            @if ($heroes->hasPages())
                <div class="card-footer bg-white d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div class="small text-muted">
                        @php
                            $from = ($heroes->currentPage() - 1) * $heroes->perPage() + 1;
                            $to = ($heroes->currentPage() - 1) * $heroes->perPage() + $heroes->count();
                        @endphp
                        Showing <strong>{{ $from }}</strong>–<strong>{{ $to }}</strong> of
                        <strong>{{ $heroes->total() }}</strong>
                    </div>
                    <div>
                        {{ $heroes->withQueryString()->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Delete Confirm Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="deleteModalLabel">
                            <i class="bi bi-exclamation-triangle me-1 text-danger"></i> Confirm Deletion
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        নির্বাচিত Hero সেকশনটি মুছে ফেলতে চান? এই কাজটি ফিরিয়ে নেওয়া যাবে না।
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash3 me-1"></i> Yes, Delete
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        {{-- যদি layout-এ Bootstrap bundle না থাকে, নিচের লাইন যোগ রাখুন --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> --}}

        <script>
            const delModal = document.getElementById('deleteModal');
            const delForm = document.getElementById('deleteForm');

            delModal?.addEventListener('show.bs.modal', function(event) {
                const btn = event.relatedTarget;
                const url = btn?.getAttribute('data-delete-url');
                console.log('[DeleteModal] trigger:', btn);
                console.log('[DeleteModal] url:', url);
                delForm?.setAttribute('action', url ?? '');
            });

            delForm?.addEventListener('submit', function(e) {
                const action = delForm.getAttribute('action');
                console.log('[DeleteForm] submit action:', action);
                if (!action) {
                    e.preventDefault();
                    alert('Delete URL সেট হয়নি।');
                }
            });
        </script>
    @endpush
@endsection
