@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container">
        <h2>Doctors List</h2>
        <div class="mb-3">
            <a href="{{ route('doctor.export.excel') }}" class="btn btn-success">Download Excel</a>
            <a href="{{ route('doctor.export.pdf') }}" class="btn btn-danger">Download PDF</a>
        </div>
        <a class="btn btn-primary mb-3" href="{{ route('doctor.register') }}"> Create New Doctor</a>

        <!-- Search Form -->
        <form method="GET" action="{{ route('doctor.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by name, email, phone..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <!-- Doctors Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <!-- Hide these columns on small screens -->
                        <th class="d-none d-md-table-cell">Email</th>
                        <th class="d-none d-md-table-cell">Phone</th>
                        <th class="d-none d-md-table-cell">Specialization</th>
                        <th class="d-none d-md-table-cell">Membership</th>
                        <th class="d-none d-md-table-cell">Status</th>
                        <th class="d-none d-md-table-cell">Member Assign</th>
                        <th width="200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($doctors as $key => $doctor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($doctor->profile_photo)
                                    <img src="{{ asset('uploads/doctors/profile_photo/' . $doctor->profile_photo) }}"
                                        width="40" height="40" class="rounded-circle">
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>{{ $doctor->name }}</td>

                            <!-- Hideable columns -->
                            <td class="d-none d-md-table-cell">{{ $doctor->email }}</td>
                            <td class="d-none d-md-table-cell">{{ $doctor->phone }}</td>
                            <td class="d-none d-md-table-cell">{{ $doctor->specialization ?? 'N/A' }}</td>
                            <td class="d-none d-md-table-cell">
                                @if ($doctor->membershipLevel)
                                    <span
                                        class="badge
                                    @if ($doctor->membershipLevel->slug == 'basic') bg-secondary
                                    @elseif($doctor->membershipLevel->slug == 'premium') bg-primary
                                    @elseif($doctor->membershipLevel->slug == 'lifetime') bg-success
                                    @elseif($doctor->membershipLevel->slug == 'founder') bg-warning
                                    @else bg-dark @endif">
                                        {{ $doctor->membershipLevel->name }}
                                    </span>
                                @else
                                    <span class="badge bg-light text-dark">No Membership</span>
                                @endif
                            </td>
                            <td class="d-none d-md-table-cell">
                                <span
                                    class="badge bg-{{ $doctor->status == 'approved' ? 'success' : ($doctor->status == 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($doctor->status) }}
                                </span>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <form method="POST" action="{{ route('doctors.membership.update', $doctor) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="membership_level_id" class="form-select form-select-sm d-inline w-auto">
                                        @foreach ($levels as $level)
                                            <option value="{{ $level->id }}" @selected(optional($doctor->membershipLevel)->id === $level->id)>
                                                {{ $level->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-primary">Assign</button>
                                </form>
                            </td>

                            <!-- Actions (Always visible) -->
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <a class="btn btn-info btn-sm" href="{{ route('doctor.show', $doctor->id) }}">View</a>
                                    <a class="btn btn-success btn-sm"
                                        href="{{ route('doctor.edit', $doctor->id) }}">Edit</a>

                                    <form action="{{ route('doctor.status', [$doctor->id, 'approved']) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>

                                    <form action="{{ route('doctor.status', [$doctor->id, 'pending']) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">Pending</button>
                                    </form>

                                    <form action="{{ route('doctor.status', [$doctor->id, 'cancelled']) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No doctors found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div>
            {{ $doctors->links() }}
        </div>
    </div>
@endsection
