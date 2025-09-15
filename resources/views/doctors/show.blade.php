@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container my-4">

        {{-- Back --}}
        <a href="{{ route('doctor.index') }}" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>

        @php
            use Illuminate\Support\Str;

            $coverPath = $doctor->cover_banner ? asset('uploads/doctors/cover/' . $doctor->cover_banner) : null;
            $profilePath = $doctor->profile_photo
                ? asset('uploads/doctors/profile_photo/' . $doctor->profile_photo)
                : null;

            // Membership (support relation or flat column)
            $membershipName = optional($doctor->membershipLevel)->name ?? ($doctor->membership_level ?? null);
            $membershipSlug =
                optional($doctor->membershipLevel)->slug ?? ($membershipName ? Str::slug($membershipName) : null);

            // Membership color
            $memberClass = match ($membershipSlug) {
                'basic' => 'bg-secondary',
                'premium' => 'bg-primary',
                'lifetime' => 'bg-success',
                'founder' => 'bg-warning text-dark',
                default => $membershipName ? 'bg-dark' : 'bg-light text-dark',
            };

            // Status color + icon
            $status = $doctor->status;
            $statusColor = $status === 'approved' ? 'success' : ($status === 'pending' ? 'warning' : 'danger');
            $statusIcon =
                $status === 'approved' ? 'check-circle' : ($status === 'pending' ? 'hourglass-split' : 'x-circle');
        @endphp

        {{-- HERO CARD --}}
        <div class="card border-0 shadow-lg overflow-hidden">
            {{-- Cover banner with gradient overlay --}}
            <div class="position-relative"
                style="min-height: 220px; background:
            linear-gradient(180deg, rgba(0,0,0,.35), rgba(0,0,0,.35)),
            url('{{ $coverPath ?? '' }}') center/cover no-repeat, {{ $coverPath ? '#000' : 'linear-gradient(135deg, #e9f2ff, #f8f9fa)' }};">
                {{-- Top-right quick actions --}}
                <div class="position-absolute top-0 end-0 m-2 d-flex gap-2">
                    <a href="{{ route('doctor.edit', $doctor->id) }}" class="btn btn-light btn-sm">
                        <i class="bi bi-pencil-square me-1"></i> Edit
                    </a>
                    {{-- Delete trigger --}}
                    <button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"
                        data-delete-url="{{ route('doctor.destroy', $doctor->id) }}">
                        <i class="bi bi-trash3 me-1"></i> Delete
                    </button>
                </div>

                {{-- Avatar + name block --}}
                <div class="position-absolute start-0 bottom-0 p-3 p-md-4 d-flex align-items-end gap-3 w-100">
                    <div class="position-relative">
                        <div class="rounded-circle bg-white shadow" style="padding:4px; width: 128px; height: 128px;">
                            @if ($profilePath)
                                <img src="{{ $profilePath }}" class="rounded-circle object-fit-cover w-100 h-100"
                                    alt="Avatar">
                            @else
                                <div
                                    class="rounded-circle bg-light d-flex align-items-center justify-content-center w-100 h-100">
                                    <i class="bi bi-person text-muted" style="font-size: 56px;"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Membership badge on avatar --}}
                        <span
                            class="badge {{ $memberClass }} position-absolute bottom-0 start-0 translate-middle-y px-3 shadow">
                            <i class="bi bi-award me-1"></i>{{ $membershipName ? $membershipName : 'No Membership' }}
                        </span>
                    </div>

                    <div class="text-white">
                        <h3 class="mb-1 fw-bold">{{ $doctor->name }}</h3>
                        <div class="d-flex flex-wrap gap-2">
                            @if ($doctor->specialization)
                                <span class="badge bg-dark-subtle text-white-50 border border-light-subtle">
                                    <i class="bi bi-stethoscope me-1"></i>{{ $doctor->specialization }}
                                </span>
                            @endif
                            @if ($doctor->current_designation)
                                <span class="badge bg-dark-subtle text-white-50 border border-light-subtle">
                                    <i class="bi bi-award me-1"></i>{{ $doctor->current_designation }}
                                </span>
                            @endif
                            <span class="badge bg-{{ $statusColor }}">
                                <i class="bi bi-{{ $statusIcon }} me-1"></i>{{ ucfirst($status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CONTENT --}}
            <div class="card-body p-3 p-md-4">
                {{-- quick info chips --}}
                <div class="row g-2 g-md-3 mb-3">
                    <div class="col-6 col-lg-3">
                        <div class="border rounded-3 p-3 h-100">
                            <div class="small text-muted">Email</div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-envelope-open"></i>
                                <a href="mailto:{{ $doctor->email }}">{{ $doctor->email ?? 'N/A' }}</a>
                                @if ($doctor->email)
                                    <button class="btn btn-sm btn-link p-0 text-muted copy-btn"
                                        data-copy="{{ $doctor->email }}" data-bs-toggle="tooltip" title="Copy">
                                        <i class="bi bi-clipboard"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="border rounded-3 p-3 h-100">
                            <div class="small text-muted">Phone</div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-telephone"></i>
                                <a href="tel:{{ $doctor->phone }}">{{ $doctor->phone ?? 'N/A' }}</a>
                                @if ($doctor->phone)
                                    <button class="btn btn-sm btn-link p-0 text-muted copy-btn"
                                        data-copy="{{ $doctor->phone }}" data-bs-toggle="tooltip" title="Copy">
                                        <i class="bi bi-clipboard"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="border rounded-3 p-3 h-100">
                            <div class="small text-muted">Experience</div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-calendar2-week"></i>
                                <span>{{ $doctor->years_of_experience ? $doctor->years_of_experience . ' years' : 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="border rounded-3 p-3 h-100">
                            <div class="small text-muted">Institution</div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-building"></i>
                                <span>{{ $doctor->institution_name ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Details Grid --}}
                <div class="row g-3">
                    {{-- Basic Info --}}
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-light fw-semibold">
                                <i class="bi bi-card-checklist me-1"></i> Step 1: Basic Info
                            </div>
                            <div class="card-body">
                                <div class="vstack gap-2">
                                    <div class="p-2 bg-body-tertiary rounded">
                                        <strong><i class="bi bi-person me-1"></i> Name:</strong>
                                        <span class="ms-1">{{ $doctor->name }}</span>
                                    </div>
                                    <div class="p-2 bg-body-tertiary rounded">
                                        <strong><i class="bi bi-envelope me-1"></i> Email:</strong>
                                        <a class="ms-1" href="mailto:{{ $doctor->email }}">{{ $doctor->email }}</a>
                                    </div>
                                    <div class="p-2 bg-body-tertiary rounded">
                                        <strong><i class="bi bi-telephone me-1"></i> Phone:</strong>
                                        <a class="ms-1" href="tel:{{ $doctor->phone }}">{{ $doctor->phone }}</a>
                                    </div>
                                    <div class="p-2 bg-body-tertiary rounded">
                                        <strong><i class="bi bi-geo-alt me-1"></i> Location:</strong>
                                        <span class="ms-1">{{ $doctor->location ?? 'N/A' }}</span>
                                    </div>
                                    <div class="p-2 bg-body-tertiary rounded">
                                        <strong><i class="bi bi-file-text me-1"></i> Short Bio:</strong>
                                        <span class="ms-1">{{ $doctor->short_bio ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Professional Info --}}
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-light fw-semibold">
                                <i class="bi bi-briefcase me-1"></i> Step 2: Professional Info
                            </div>
                            <div class="card-body">
                                <div class="row g-2">
                                    <div class="col-sm-6">
                                        <div class="p-2 bg-body-tertiary rounded">
                                            <strong><i class="bi bi-hash me-1"></i> Reg. No:</strong>
                                            <span
                                                class="ms-1">{{ $doctor->medical_registration_number ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="p-2 bg-body-tertiary rounded">
                                            <strong><i class="bi bi-stethoscope me-1"></i> Specialization:</strong>
                                            <span class="ms-1">{{ $doctor->specialization ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="p-2 bg-body-tertiary rounded">
                                            <strong><i class="bi bi-award me-1"></i> Designation:</strong>
                                            <span class="ms-1">{{ $doctor->current_designation ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="p-2 bg-body-tertiary rounded">
                                            <strong><i class="bi bi-building me-1"></i> Institution:</strong>
                                            <span class="ms-1">{{ $doctor->institution_name ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-2 bg-body-tertiary rounded">
                                            <strong><i class="bi bi-book me-1"></i> Education:</strong>
                                            <span class="ms-1">{{ $doctor->educational_background ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-2 bg-body-tertiary rounded">
                                            <strong><i class="bi bi-patch-check me-1"></i> Certifications:</strong>
                                            <span
                                                class="ms-1">{{ $doctor->certifications_and_fellowships ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="p-2 bg-body-tertiary rounded">
                                            <strong><i class="bi bi-stars me-1"></i> Interests:</strong>
                                            <span class="ms-1">{{ $doctor->areas_of_interest ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="p-2 bg-body-tertiary rounded">
                                            <strong><i class="bi bi-translate me-1"></i> Languages:</strong>
                                            <span class="ms-1">{{ $doctor->languages_spoken ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Social & Docs --}}
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light fw-semibold">
                                <i class="bi bi-globe2 me-1"></i> Step 3: Social & Docs
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    {{-- Social buttons --}}
                                    <div class="col-md-8">
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="{{ $doctor->personal_website ?: '#' }}"
                                                class="btn btn-outline-primary @if (!$doctor->personal_website) disabled @endif"
                                                target="_blank">
                                                <i class="bi bi-link-45deg me-1"></i> Website
                                            </a>
                                            <a href="{{ $doctor->linkedin ?: '#' }}"
                                                class="btn btn-outline-primary @if (!$doctor->linkedin) disabled @endif"
                                                target="_blank">
                                                <i class="bi bi-linkedin me-1"></i> LinkedIn
                                            </a>
                                            <a href="{{ $doctor->researchgate ?: '#' }}"
                                                class="btn btn-outline-primary @if (!$doctor->researchgate) disabled @endif"
                                                target="_blank">
                                                <i class="bi bi-journal-richtext me-1"></i> ResearchGate
                                            </a>
                                        </div>
                                    </div>

                                    {{-- CV --}}
                                    <div class="col-md-4 text-md-end">
                                        @if ($doctor->cv)
                                            <a href="{{ asset('uploads/doctors/cv/' . $doctor->cv) }}" target="_blank"
                                                class="btn btn-info">
                                                <i class="bi bi-file-earmark-text me-1"></i> View CV
                                            </a>
                                        @else
                                            <span class="text-muted">CV: N/A</span>
                                        @endif
                                    </div>

                                    {{-- Raw social list/text --}}
                                    <div class="col-12">
                                        <div class="p-2 bg-body-tertiary rounded">
                                            <strong><i class="bi bi-share me-1"></i> Social Links:</strong>
                                            <span class="ms-1">{{ $doctor->social_links ?? '—' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FOOTER ACTIONS --}}
            <div class="card-footer d-flex flex-wrap gap-2 justify-content-end">
                <form action="{{ route('doctor.status', [$doctor->id, 'approved']) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check2-circle me-1"></i> Approve
                    </button>
                </form>
                <form action="{{ route('doctor.status', [$doctor->id, 'pending']) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-hourglass-split me-1"></i> Pending
                    </button>
                </form>
                <form action="{{ route('doctor.status', [$doctor->id, 'cancelled']) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-x-octagon me-1"></i> Cancel
                    </button>
                </form>
            </div>
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
                        নির্বাচিত ডাক্তারের তথ্য মুছে ফেলতে চান? এই কাজটি ফিরিয়ে নেওয়া যাবে না।
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
        {{-- যদি লেআউটে Bootstrap JS bundle আগে থেকে লোড করা থাকে, এই লাইনটি বাদ দিন --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
        </script>

        <script>
            // Tooltips
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));

            // Copy-to-clipboard
            document.querySelectorAll('.copy-btn').forEach(btn => {
                btn.addEventListener('click', async () => {
                    const val = btn.getAttribute('data-copy');
                    try {
                        await navigator.clipboard.writeText(val);
                        const tip = bootstrap.Tooltip.getOrCreateInstance(btn);
                        btn.setAttribute('data-bs-original-title', 'Copied!');
                        tip.show();
                        setTimeout(() => {
                            btn.setAttribute('data-bs-original-title', 'Copy');
                            tip.hide();
                        }, 900);
                    } catch (e) {
                        alert('Copy failed. Please copy manually.');
                    }
                });
            });

            // Delete modal action setter
            const delModal = document.getElementById('deleteModal');
            delModal?.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const url = button.getAttribute('data-delete-url');
                document.getElementById('deleteForm').setAttribute('action', url);
            });
        </script>
    @endpush
@endsection
