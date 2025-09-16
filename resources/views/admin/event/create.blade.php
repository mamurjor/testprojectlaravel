@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container my-5" style="max-width: 700px;">
        <div class="card shadow-sm">
            <div class="card-body p-5">
                <h2 class="card-title mb-4 text-center fw-bold">Create New Event</h2>

                <form action="{{ route('admin.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title"
                            class="form-control form-control-lg rounded-pill shadow-sm" placeholder="Enter event title"
                            required value="{{ old('title') }}">
                        <div class="invalid-feedback">
                            Please provide a title.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Description <span
                                class="text-danger">*</span></label>
                        <textarea name="description" id="description" rows="5" class="form-control form-control-lg rounded-3 shadow-sm"
                            placeholder="Enter event description" required>{{ old('description') }}</textarea>
                        <div class="invalid-feedback">
                            Please provide a description.
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="event_date" class="form-label fw-semibold">Event Date <span
                                    class="text-danger">*</span></label>
                            <input type="datetime-local" name="event_date" id="event_date"
                                class="form-control form-control-lg rounded-pill shadow-sm" required
                                value="{{ old('event_date') }}">
                            <div class="invalid-feedback">
                                Please select the event start date and time.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="end_date" class="form-label fw-semibold">End Date <span
                                    class="text-danger">*</span></label>
                            <input type="datetime-local" name="end_date" id="end_date"
                                class="form-control form-control-lg rounded-pill shadow-sm" required
                                value="{{ old('end_date') }}">
                            <div class="invalid-feedback">
                                Please select the event end date and time.
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="max_registrations" class="form-label fw-semibold">Max Registrations</label>
                        <input type="number" name="max_registrations" id="max_registrations"
                            class="form-control form-control-lg rounded-pill shadow-sm" min="1"
                            placeholder="Leave empty for unlimited" value="{{ old('max_registrations') }}">
                    </div>

                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="is_free" name="is_free" value="1"
                            {{ old('is_free') ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_free">Is Free</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm"
                        style="background: linear-gradient(45deg, #4e73df, #224abe); border: none; transition: background 0.3s;">
                        Create Event
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })();
    </script>

    <style>
        .form-control:focus {
            box-shadow: 0 0 8px rgba(34, 74, 190, 0.6);
            border-color: #224abe;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #224abe, #4e73df);
        }
    </style>
@endsection
