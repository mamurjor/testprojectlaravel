@extends('layouts.adminlayout'))

@section('maincontent')
    <div class="container">
        <h3>{{ $level->name }} Membership Report</h3>

        <p><strong>Total Members:</strong> {{ $totalMembers }}</p>
        <p><strong>Total Revenue:</strong> ${{ number_format($totalRevenue, 2) }}</p>

        @if ($assignments->count() > 0)
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Doctor Name</th>
                        <th>Phone</th>
                        <th>Specialization</th>
                        <th>Membership Start</th>
                        <th>Membership End</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assignments as $index => $assignment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $assignment->doctor->name }}</td>
                            <td>{{ $assignment->doctor->phone }}</td>
                            <td>{{ $assignment->doctor->specialization }}</td>
                            <td>
                                {{ $assignment->starts_at ?: '-' }}
                            </td>
                            <td>
                                {{ $assignment->ends_at ?: '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">No doctors found in this membership level.</p>
        @endif
    </div>
@endsection
