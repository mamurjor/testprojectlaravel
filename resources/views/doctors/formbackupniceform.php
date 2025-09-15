@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container py-3">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
            <h2 class="mb-0">
                <i class="bi bi-person-vcard me-2"></i>
                {{ $doctor->exists ? 'Edit Doctor' : 'Doctor Registration' }}
            </h2>
            <a href="{{ route('doctor.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Back to list
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ $doctor->exists ? route('doctor.update', $doctor->id) : route('doctor.store') }}" method="POST"
            enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            @if ($doctor->exists)
                @method('PUT')
            @endif

            {{-- Step Nav (Pills) --}}
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <ul class="nav nav-pills nav-fill gap-2" id="formTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active d-flex align-items-center justify-content-center gap-2"
                                id="step1-tab" data-bs-toggle="tab" data-bs-target="#step1" type="button" role="tab">
                                <span class="badge rounded-pill bg-primary">1</span> Basic Info
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center justify-content-center gap-2" id="step2-tab"
                                data-bs-toggle="tab" data-bs-target="#step2" type="button" role="tab">
                                <span class="badge rounded-pill bg-primary">2</span> Professional Info
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center justify-content-center gap-2" id="step3-tab"
                                data-bs-toggle="tab" data-bs-target="#step3" type="button" role="tab">
                                <span class="badge rounded-pill bg-primary">3</span> Social & Docs
                            </button>
                        </li>
                    </ul>

                    {{-- Progress --}}
                    <div class="progress mt-3" style="height: 8px;">
                        <div class="progress-bar" role="progressbar" style="width: 33%;" id="formProgress"></div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="formTabsContent">
                {{-- STEP 1: BASIC --}}
                <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light fw-semibold">
                            <i class="bi bi-card-checklist me-1"></i> Basic Information
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                {{-- name --}}
                                <div class="col-md-6">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $doctor->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- email --}}
                                <div class="col-md-6">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $doctor->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- phone --}}
                                <div class="col-md-6">
                                    <label class="form-label">Phone <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone', $doctor->phone) }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- full_name_en --}}
                                <div class="col-md-6">
                                    <label class="form-label">Full Name (EN)</label>
                                    <input type="text" name="full_name_en"
                                        class="form-control @error('full_name_en') is-invalid @enderror"
                                        value="{{ old('full_name_en', $doctor->full_name_en) }}">
                                    @error('full_name_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- full_name_bn --}}
                                <div class="col-md-6">
                                    <label class="form-label">Full Name (BN)</label>
                                    <input type="text" name="full_name_bn"
                                        class="form-control @error('full_name_bn') is-invalid @enderror"
                                        value="{{ old('full_name_bn', $doctor->full_name_bn) }}">
                                    @error('full_name_bn')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STEP 2: PROFESSIONAL --}}
                <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light fw-semibold">
                            <i class="bi bi-briefcase me-1"></i> Professional Information
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @php
                                    $fieldsStep2 = [
                                        'medical_registration_number' => ['icon' => 'hash'],
                                        'specialization' => ['icon' => 'stethoscope'],
                                        'current_designation' => ['icon' => 'award'],
                                        'institution_name' => ['icon' => 'building'],
                                        'years_of_experience' => ['icon' => 'calendar2-week'],
                                    ];
                                @endphp
                                @foreach ($fieldsStep2 as $field => $meta)
                                    <div class="col-md-6">
                                        <label class="form-label">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i
                                                    class="bi bi-{{ $meta['icon'] }}"></i></span>
                                            <input type="text" name="{{ $field }}"
                                                class="form-control @error($field) is-invalid @enderror"
                                                value="{{ old($field, $doctor->$field) }}">
                                            @error($field)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Long text fields --}}
                                @php
                                    $textAreas = [
                                        'educational_background' => 'book',
                                        'certifications_and_fellowships' => 'patch-check',
                                        'areas_of_interest' => 'stars',
                                        'languages_spoken' => 'translate',
                                    ];
                                @endphp
                                @foreach ($textAreas as $field => $icon)
                                    <div class="col-12">
                                        <label class="form-label">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i
                                                    class="bi bi-{{ $icon }}"></i></span>
                                            <textarea name="{{ $field }}" rows="3" class="form-control @error($field) is-invalid @enderror">{{ old($field, $doctor->$field) }}</textarea>
                                            @error($field)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STEP 3: SOCIAL & DOCS --}}
                <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="step3-tab">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light fw-semibold">
                            <i class="bi bi-globe2 me-1"></i> Social Profiles & Documents
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                {{-- short_bio --}}
                                <div class="col-12">
                                    <label class="form-label">Short Bio</label>
                                    <textarea name="short_bio" rows="3" class="form-control @error('short_bio') is-invalid @enderror">{{ old('short_bio', $doctor->short_bio) }}</textarea>
                                    @error('short_bio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- links --}}
                                @php
                                    $links = [
                                        'personal_website' => [
                                            'icon' => 'link-45deg',
                                            'placeholder' => 'https://example.com',
                                        ],
                                        'linkedin' => [
                                            'icon' => 'linkedin',
                                            'placeholder' => 'https://linkedin.com/in/username',
                                        ],
                                        'researchgate' => [
                                            'icon' => 'journal-richtext',
                                            'placeholder' => 'https://www.researchgate.net/profile/...',
                                        ],
                                    ];
                                @endphp
                                @foreach ($links as $field => $meta)
                                    <div class="col-md-6">
                                        <label class="form-label">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i
                                                    class="bi bi-{{ $meta['icon'] }}"></i></span>
                                            <input type="text" name="{{ $field }}"
                                                class="form-control @error($field) is-invalid @enderror"
                                                placeholder="{{ $meta['placeholder'] }}"
                                                value="{{ old($field, $doctor->$field) }}">
                                            @error($field)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach

                                {{-- social_links --}}
                                <div class="col-12">
                                    <label class="form-label">Social Links (JSON or comma separated)</label>
                                    <textarea name="social_links" rows="2" class="form-control @error('social_links') is-invalid @enderror">{{ old('social_links', $doctor->social_links) }}</textarea>
                                    @error('social_links')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Membership fields (optional text) --}}
                                <div class="col-md-6">
                                    <label class="form-label">Membership ID</label>
                                    <input type="text" name="membership_id"
                                        class="form-control @error('membership_id') is-invalid @enderror"
                                        value="{{ old('membership_id', $doctor->membership_id) }}">
                                    @error('membership_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Membership Level</label>
                                    <input type="text" name="membership_level"
                                        class="form-control @error('membership_level') is-invalid @enderror"
                                        value="{{ old('membership_level', $doctor->membership_level) }}">
                                    @error('membership_level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Files --}}
                                <div class="col-md-4">
                                    <label class="form-label">CV (PDF/Doc)</label>
                                    <input type="file" name="cv"
                                        class="form-control @error('cv') is-invalid @enderror" accept=".pdf,.doc,.docx">
                                    @error('cv')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if ($doctor->cv)
                                        <small class="d-block mt-1">
                                            Current: <a href="{{ asset('storage/' . $doctor->cv) }}"
                                                target="_blank">Download</a>
                                        </small>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Profile Photo</label>
                                    <input type="file" name="profile_photo" id="profilePhotoInput"
                                        class="form-control @error('profile_photo') is-invalid @enderror"
                                        accept="image/*">
                                    @error('profile_photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-2">
                                        <img id="profilePhotoPreview"
                                            src="{{ $doctor->profile_photo ? asset('storage/' . $doctor->profile_photo) : '' }}"
                                            alt="" class="rounded border"
                                            style="max-width:120px; max-height:120px; {{ $doctor->profile_photo ? '' : 'display:none;' }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Cover Banner</label>
                                    <input type="file" name="cover_banner" id="coverBannerInput"
                                        class="form-control @error('cover_banner') is-invalid @enderror"
                                        accept="image/*">
                                    @error('cover_banner')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-2">
                                        <img id="coverBannerPreview"
                                            src="{{ $doctor->cover_banner ? asset('storage/' . $doctor->cover_banner) : '' }}"
                                            alt="" class="rounded border w-100"
                                            style="max-height:120px; {{ $doctor->cover_banner ? '' : 'display:none;' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sticky Action Bar --}}
            <div class="card shadow-sm border-0 mt-3 position-sticky bottom-0" style="z-index: 9;">
                <div class="card-body d-flex flex-wrap gap-2 justify-content-end">
                    <button type="button" class="btn btn-outline-secondary" id="prevBtn">
                        <i class="bi bi-chevron-left me-1"></i> Previous
                    </button>
                    <button type="button" class="btn btn-info text-white" id="nextBtn">
                        Next <i class="bi bi-chevron-right ms-1"></i>
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save2 me-1"></i> {{ $doctor->exists ? 'Update' : 'Register' }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- jQuery optional; pure JS ও কাজ করবে। আপনি আলাদা JS চাইলে @push ব্যবহার করতে পারেন --}}

    @push('scripts')
        <script>
            (function() {
                const tabs = Array.from(document.querySelectorAll('#formTabs button.nav-link'));
                const progress = document.getElementById('formProgress');
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');

                let current = tabs.findIndex(t => t.classList.contains('active'));
                if (current < 0) current = 0;

                function updateUI() {
                    if (prevBtn) prevBtn.style.display = current > 0 ? '' : 'none';
                    if (nextBtn) nextBtn.style.display = current < tabs.length - 1 ? '' : 'none';
                    if (progress) progress.style.width = (((current + 1) / tabs.length) * 100) + '%';
                }

                function showTab(i) {
                    if (i < 0 || i >= tabs.length) return;
                    const tab = new bootstrap.Tab(tabs[i]);
                    tab.show(); // <-- BS5 Native API
                }

                // ট্যাব পাল্টালে current আপডেট
                tabs.forEach((btn, idx) => {
                    btn.addEventListener('shown.bs.tab', () => {
                        current = idx;
                        updateUI();
                    });
                });

                nextBtn?.addEventListener('click', () => showTab(current + 1));
                prevBtn?.addEventListener('click', () => showTab(current - 1));

                updateUI();
            })();
        </script>
    @endsection
