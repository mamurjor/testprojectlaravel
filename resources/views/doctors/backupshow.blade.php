@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container mt-4">
        <a href="{{ route('doctor.index') }}" class="btn btn-secondary mb-3">← Back to List</a>

        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4>Doctor Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Profile Section -->
                    <div class="col-md-3 text-center mb-4">
                        <div class="position-relative d-inline-block">
                            @if ($doctor->profile_photo)
                                <img src="{{ asset('uploads/doctors/profile_photo/' . $doctor->profile_photo) }}"
                                    class="img-fluid rounded shadow-sm" width="220" alt="Profile Photo">
                            @else
                                <span class="text-muted">No Profile Photo</span>
                            @endif

                            <!-- Membership Level Badge -->
                            @if ($doctor->membership_level)
                                <span class="badge bg-info position-absolute top-0 start-0 m-2 shadow">
                                    {{ ucfirst($doctor->membership_level) }}
                                </span>
                            @endif

                            <!-- Status Badge -->
                            <span
                                class="badge
                            bg-{{ $doctor->status == 'approved' ? 'success' : ($doctor->status == 'pending' ? 'warning' : 'danger') }}
                            position-absolute top-0 end-0 m-2 shadow">
                                {{ ucfirst($doctor->status) }}
                            </span>
                        </div>

                        <!-- Cover Banner -->
                        @if ($doctor->cover_banner)
                            <div class="mt-3 position-relative d-inline-block w-100">
                                <img src="{{ asset('uploads/doctors/cover/' . $doctor->cover_banner) }}"
                                    class="img-fluid rounded shadow-sm" alt="Cover Banner">
                                <span class="badge bg-dark position-absolute bottom-0 start-0 m-2">
                                    Cover Banner
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Details Section -->
                    <div class="col-md-9">

                        <!-- Step 1: Basic Info -->
                        <fieldset class="border rounded p-3 mb-4">
                            <legend class="float-none w-auto px-3 text-primary fw-bold">Step 1: Basic Info</legend>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-2 bg-light rounded"><strong>Name:</strong> {{ $doctor->name }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-2 bg-light rounded"><strong>Email:</strong> {{ $doctor->email }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-2 bg-light rounded"><strong>Phone:</strong> {{ $doctor->phone }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-2 bg-light rounded"><strong>Location:</strong> {{ $doctor->location }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="p-2 bg-light rounded"><strong>Short Bio:</strong> {{ $doctor->short_bio }}
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Step 2: Professional Info -->
                        <fieldset class="border rounded p-3 mb-4">
                            <legend class="float-none w-auto px-3 text-success fw-bold">Step 2: Professional Info</legend>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-2 bg-light rounded"><strong>Medical Reg. No:</strong>
                                        {{ $doctor->medical_registration_number }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-2 bg-light rounded"><strong>Specialization:</strong>
                                        {{ $doctor->specialization }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-2 bg-light rounded"><strong>Designation:</strong>
                                        {{ $doctor->current_designation }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-2 bg-light rounded"><strong>Institution:</strong>
                                        {{ $doctor->institution_name }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-2 bg-light rounded"><strong>Experience:</strong>
                                        {{ $doctor->years_of_experience }} years</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-2 bg-light rounded"><strong>Education:</strong>
                                        {{ $doctor->educational_background }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-2 bg-light rounded"><strong>Certifications:</strong>
                                        {{ $doctor->certifications_and_fellowships }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-2 bg-light rounded"><strong>Interests:</strong>
                                        {{ $doctor->areas_of_interest }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-2 bg-light rounded"><strong>Languages:</strong>
                                        {{ $doctor->languages_spoken }}</div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Step 3: Social & Docs -->
                        <fieldset class="border rounded p-3 mb-4">
                            <legend class="float-none w-auto px-3 text-danger fw-bold">Step 3: Social & Docs</legend>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-2 bg-light rounded"><strong>Website:</strong> <a
                                            href="{{ $doctor->personal_website }}"
                                            target="_blank">{{ $doctor->personal_website }}</a></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-2 bg-light rounded"><strong>LinkedIn:</strong> <a
                                            href="{{ $doctor->linkedin }}" target="_blank">{{ $doctor->linkedin }}</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-2 bg-light rounded"><strong>ResearchGate:</strong> <a
                                            href="{{ $doctor->researchgate }}"
                                            target="_blank">{{ $doctor->researchgate }}</a></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-2 bg-light rounded">
                                        <strong>CV:</strong>
                                        @if ($doctor->cv)
                                            <a href="{{ asset('uploads/doctors/cv/' . $doctor->cv) }}" target="_blank"
                                                class="btn btn-sm btn-info">View CV</a>
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="p-2 bg-light rounded"><strong>Social Links:</strong>
                                        {{ $doctor->social_links }}</div>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="card-footer text-end">
                <form action="{{ route('doctor.status', [$doctor->id, 'approved']) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
                <form action="{{ route('doctor.status', [$doctor->id, 'pending']) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-warning">Pending</button>
                </form>
                <form action="{{ route('doctor.status', [$doctor->id, 'cancelled']) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
