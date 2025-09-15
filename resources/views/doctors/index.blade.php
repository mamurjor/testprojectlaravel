@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container py-3">

        {{-- Header Row --}}
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mb-3">
            <h2 class="mb-0">Doctors List</h2>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('doctor.export.excel') }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-excel me-1"></i> Download Excel
                </a>
                <a href="{{ route('doctor.export.pdf') }}" class="btn btn-danger">
                    <i class="bi bi-file-earmark-pdf me-1"></i> Download PDF
                </a>
                <a class="btn btn-primary" href="{{ route('doctor.create') }}">
                    <i class="bi bi-person-plus-fill me-1"></i> Create New Doctor
                </a>
            </div>
        </div>

        {{-- Flash messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Search --}}
        <form method="GET" action="{{ route('doctor.index') }}" class="mb-3">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" name="search" class="form-control" placeholder="Search by name, email, phone..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-filter-square me-1"></i> Search
                </button>
            </div>
        </form>

        {{-- Table --}}
        <div class="table-responsive shadow-sm rounded-3">
            <table class="table table-bordered table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th class="d-none d-md-table-cell">Email</th>
                        <th class="d-none d-md-table-cell">Phone</th>
                        <th class="d-none d-md-table-cell">Specialization</th>
                        {{-- <th class="d-none d-md-table-cell">Membership</th> --}}
                        <th class="d-none d-md-table-cell">Status</th>
                        {{-- <th class="d-none d-md-table-cell">Member Assign</th> --}}
                        <th width="260">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($doctors as $doctor)
                        <tr>
                            <td>{{ $loop->iteration + ($doctors->currentPage() - 1) * $doctors->perPage() }}</td>
                            <td>
                                @if ($doctor->profile_photo)
                                    <img src="{{ asset('uploads/doctors/profile_photo/' . $doctor->profile_photo) }}"
                                        width="40" height="40" class="rounded-circle object-fit-cover"
                                        alt="photo">
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $doctor->name }}</td>
                            <td class="d-none d-md-table-cell">{{ $doctor->email }}</td>
                            <td class="d-none d-md-table-cell">{{ $doctor->phone }}</td>
                            <td class="d-none d-md-table-cell">{{ $doctor->specialization ?? 'N/A' }}</td>
                            {{-- <td class="d-none d-md-table-cell">
                                @if ($doctor->membershipLevel)
                                    <span
                                        class="badge
                                    @if ($doctor->membershipLevel->slug == 'basic') bg-secondary
                                    @elseif($doctor->membershipLevel->slug == 'premium') bg-primary
                                    @elseif($doctor->membershipLevel->slug == 'lifetime') bg-success
                                    @elseif($doctor->membershipLevel->slug == 'founder') bg-warning text-dark
                                    @else bg-dark @endif">
                                        <i class="bi bi-award me-1"></i>{{ $doctor->membershipLevel->name }}
                                    </span>
                                @else
                                    <span class="badge bg-light text-dark"><i class="bi bi-dash-circle me-1"></i>No
                                        Membership</span>
                                @endif
                            </td> --}}
                            <td class="d-none d-md-table-cell">
                                @php
                                    $statusColor =
                                        $doctor->status == 'approved'
                                            ? 'success'
                                            : ($doctor->status == 'pending'
                                                ? 'warning'
                                                : 'danger');
                                    $statusIcon =
                                        $doctor->status == 'approved'
                                            ? 'check-circle'
                                            : ($doctor->status == 'pending'
                                                ? 'hourglass-split'
                                                : 'x-circle');
                                @endphp
                                <span class="badge bg-{{ $statusColor }}">
                                    <i class="bi bi-{{ $statusIcon }} me-1"></i>{{ ucfirst($doctor->status) }}
                                </span>
                            </td>
                            {{-- <td class="d-none d-md-table-cell">
                                <form method="POST" action="{{ route('doctors.membership.update', $doctor) }}"
                                    class="d-flex gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="membership_level_id" class="form-select form-select-sm w-auto">
                                        @foreach ($levels as $level)
                                            <option value="{{ $level->id }}" @selected(optional($doctor->membershipLevel)->id === $level->id)>
                                                {{ $level->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-primary">
                                        <i class="bi bi-link-45deg me-1"></i>Assign
                                    </button>
                                </form>
                            </td> --}}
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <a class="btn btn-info btn-sm" href="{{ route('doctor.show', $doctor->id) }}">
                                        <i class="bi bi-eye me-1"></i> View
                                    </a>
                                    <a class="btn btn-success btn-sm" href="{{ route('doctor.edit', $doctor->id) }}">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>

                                    <form action="{{ route('doctor.status', [$doctor->id, 'approved']) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="bi bi-check2-circle me-1"></i> Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('doctor.status', [$doctor->id, 'pending']) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="bi bi-hourglass me-1"></i> Pending
                                        </button>
                                    </form>

                                    <form action="{{ route('doctor.status', [$doctor->id, 'cancelled']) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-x-octagon me-1"></i> Cancel
                                        </button>
                                    </form>

                                    {{-- Delete --}}

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">
                                <i class="bi bi-inboxes me-1"></i> No doctors found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $doctors->withQueryString()->links() }}
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
                        নির্বাচিত ডাক্তারের তথ্য মুছে ফেলতে চান? এই কাজটি ফেরত নেওয়া যাবে না।
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
        <script>
            document.getElementById('deleteModal')?.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const url = button.getAttribute('data-delete-url');
                const form = document.getElementById('deleteForm');
                form.setAttribute('action', url);
            });
        </script>
    @endpush
@endsection
