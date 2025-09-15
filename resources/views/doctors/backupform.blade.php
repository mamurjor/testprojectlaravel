@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container">
        <h2>{{ $doctor->exists ? 'Edit Doctor' : 'Doctor Registration' }}</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ $doctor->exists ? route('doctor.update', $doctor->id) : route('doctor.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if ($doctor->exists)
                @method('PUT')
            @endif

            <!-- Tabs -->
            <ul class="nav nav-tabs" id="formTabs">
                <li class="nav-item"><a class="nav-link active" href="#step1" data-bs-toggle="tab">Step 1: Basic Info</a></li>
                <li class="nav-item"><a class="nav-link" href="#step2" data-bs-toggle="tab">Step 2: Professional Info</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#step3" data-bs-toggle="tab">Step 3: Social & Docs</a></li>
            </ul>

            <div class="tab-content border p-3 mt-2">
                <!-- Step 1 -->
                <div class="tab-pane fade show active" id="step1">
                    @php
                        $fieldsStep1 = ['name', 'email', 'phone', 'full_name_en', 'full_name_bn'];
                    @endphp
                    @foreach ($fieldsStep1 as $field)
                        <div class="mb-3">
                            <label>{{ ucwords(str_replace('_', ' ', $field)) }} @if (in_array($field, ['name', 'email', 'phone']))
                                    *
                                @endif
                            </label>
                            <input
                                type="{{ in_array($field, ['password', 'password_confirmation']) ? 'password' : 'text' }}"
                                name="{{ $field }}" class="form-control @error($field) is-invalid @enderror"
                                value="{{ old($field, $doctor->$field) }}">
                            @error($field)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <!-- Step 2 -->
                <div class="tab-pane fade" id="step2">
                    @php
                        $fieldsStep2 = [
                            'medical_registration_number',
                            'specialization',
                            'current_designation',
                            'institution_name',
                            'years_of_experience',
                            'educational_background',
                            'certifications_and_fellowships',
                            'areas_of_interest',
                            'languages_spoken',
                        ];
                    @endphp
                    @foreach ($fieldsStep2 as $field)
                        <div class="mb-3">
                            <label>{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                            @if (in_array($field, ['educational_background', 'certifications_and_fellowships', 'areas_of_interest']))
                                <textarea name="{{ $field }}" class="form-control @error($field) is-invalid @enderror">{{ old($field, $doctor->$field) }}</textarea>
                            @else
                                <input type="text" name="{{ $field }}"
                                    class="form-control @error($field) is-invalid @enderror"
                                    value="{{ old($field, $doctor->$field) }}">
                            @endif
                            @error($field)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <!-- Step 3 -->
                <div class="tab-pane fade" id="step3">
                    @php
                        $fieldsStep3 = [
                            'short_bio',
                            'personal_website',
                            'linkedin',
                            'researchgate',
                            'cv',
                            'profile_photo',
                            'cover_banner',
                            'social_links',
                            'membership_id',
                            'membership_level',
                        ];
                    @endphp
                    @foreach ($fieldsStep3 as $field)
                        <div class="mb-3">
                            <label>{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                            @if (in_array($field, ['cv', 'profile_photo', 'cover_banner']))
                                <input type="file" name="{{ $field }}"
                                    class="form-control @error($field) is-invalid @enderror">
                                @if ($doctor->$field)
                                    <small>Current:
                                        @if (in_array($field, ['cv']))
                                            <a href="{{ asset('storage/' . $doctor->$field) }}"
                                                target="_blank">Download</a>
                                        @else
                                            <img src="{{ asset('storage/' . $doctor->$field) }}" width="80">
                                        @endif
                                    </small>
                                @endif
                            @elseif($field === 'short_bio' || $field === 'social_links')
                                <textarea name="{{ $field }}" class="form-control @error($field) is-invalid @enderror">{{ old($field, $doctor->$field) }}</textarea>
                            @else
                                <input type="text" name="{{ $field }}"
                                    class="form-control @error($field) is-invalid @enderror"
                                    value="{{ old($field, $doctor->$field) }}">
                            @endif
                            @error($field)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-3">
                <button type="button" class="btn btn-secondary" id="prevBtn">Previous</button>
                <button type="button" class="btn btn-info" id="nextBtn">Next</button>
                <button type="submit" class="btn btn-success">{{ $doctor->exists ? 'Update' : 'Register' }}</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {
            let $tabs = $('#formTabs .nav-link');
            let current = 0;

            function showTab(i) {
                $tabs.eq(i).tab('show');
                $("#prevBtn").toggle(i > 0);
                $("#nextBtn").toggle(i < $tabs.length - 1);
            }
            $("#nextBtn").click(() => {
                if (current < $tabs.length - 1) showTab(++current);
            });
            $("#prevBtn").click(() => {
                if (current > 0) showTab(--current);
            });
            showTab(current);
        });
    </script>
@endsection
