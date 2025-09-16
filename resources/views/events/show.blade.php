@extends('layouts.app')

@section('title', $event->title)

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- Success or Error Messages --}}
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                {{-- Event Details Card --}}
                <div class="card shadow-sm mb-4 border-0 rounded-4">
                    <div class="card-body">
                        <h2 class="card-title fw-bold">{{ $event->title }}</h2>
                        <p class="card-text text-muted">
                            {{ \Carbon\Carbon::parse($event->event_date)->format('d M, Y h:i A') }}</p>

                        <p class="card-text mb-3">{{ $event->description }}</p>

                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item">
                                <strong>Start Date:</strong>
                                {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, h:i A') }}
                            </li>
                            <li class="list-group-item">
                                <strong>End Date:</strong>
                                {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y, h:i A') }}
                            </li>
                            <li class="list-group-item">
                                <strong>Registrations:</strong>
                                {{ $registerCount }} / {{ $event->max_registrations ?? 'Unlimited' }}
                            </li>
                            <li class="list-group-item">
                                <strong>Status:</strong>
                                @if ($event->is_free)
                                    <span class="badge bg-success">Free</span>
                                @else
                                    <span class="badge bg-warning text-dark">Paid</span>
                                @endif
                            </li>
                        </ul>

                        {{-- Registration Condition Messages --}}
                        @if ($event->end_date < now())
                            <div class="alert alert-danger mt-3">
                                This event has ended. No more registrations are allowed.
                            </div>
                        @elseif($event->max_registrations && $registerCount >= $event->max_registrations)
                            <div class="alert alert-warning mt-3">
                                Sorry, the maximum registration limit has been reached.
                            </div>
                        @else
                            {{-- Registration Form --}}
                            <h4 class="mt-4 mb-3 fw-semibold">Register for this Event</h4>
                            <form action="{{ route('event.register', $event->id) }}" method="POST" class="needs-validation"
                                novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name"
                                        class="form-control form-control-lg rounded-pill shadow-sm" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email"
                                        class="form-control form-control-lg rounded-pill shadow-sm" required>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm">
                                    Register Now
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Optional JS for form validation --}}
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
@endsection
