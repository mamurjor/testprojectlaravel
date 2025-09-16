@extends('layouts.app')

@section('title', 'Bangladesh Doctors Club Ltd — Home')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-center fw-bold">Upcoming Events</h1>

        @if ($events->isEmpty())
            <div class="alert alert-info text-center">No upcoming events available.</div>
        @else
            <div class="row g-4">
                @foreach ($events as $event)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm h-100 border-0 rounded-4">
                            <div class="card-body d-flex flex-column">
                                {{-- Event Title --}}
                                <h5 class="card-title fw-bold mb-2">
                                    <a href="{{ route('event.show', $event->id) }}"
                                        class="stretched-link text-decoration-none text-primary">
                                        {{ $event->title }}
                                    </a>
                                </h5>

                                {{-- Event Date --}}
                                <p class="card-subtitle mb-2 text-muted">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M, Y h:i A') }}
                                </p>

                                {{-- Event Description --}}
                                <p class="card-text text-secondary small description-truncate">
                                    {{ $event->description }}
                                </p>

                                {{-- Free / Paid Badge --}}
                                <div class="mt-auto">
                                    <span class="badge {{ $event->is_free ? 'bg-success' : 'bg-warning text-dark' }}">
                                        {{ $event->is_free ? 'Free' : 'Paid' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Custom CSS to truncate description text --}}
    <style>
        .description-truncate {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection
