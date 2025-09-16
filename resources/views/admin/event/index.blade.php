@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Events List</h2>
            <a href="{{ route('admin.create') }}" class="btn btn-success btn-lg rounded-pill shadow-sm">
                Create New Event
            </a>
        </div>

        @if ($events->isEmpty())
            <div class="alert alert-info">No events found.</div>
        @else
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Event Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Max Registrations</th>
                            <th scope="col">Is Free</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $index => $event)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $event->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M, Y h:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->end_date)->format('d M, Y h:i A') }}</td>
                                <td>{{ $event->max_registrations ?? 'Unlimited' }}</td>
                                <td>
                                    @if ($event->is_free)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-secondary">No</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.edit', $event->id) }}" class="btn btn-sm btn-primary me-2"
                                        title="Edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.destroy', $event->id) }}" method="POST"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this event?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
