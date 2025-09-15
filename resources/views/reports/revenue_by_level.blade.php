@extends('layouts.adminlayout'))

@section('maincontent')
    <div class="container">
        <h2 class="mb-4">Revenue Report by Membership Level</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Membership Level</th>
                    <th>Fee</th>
                    <th>Total Members</th>
                    <th>Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($levels as $level)
                    <tr>
                        <td>{{ $level->name }}</td>
                        <td>{{ number_format($level->price, 2) }}</td>
                        <td>{{ $level->doctors_count }}</td>
                        <td>{{ number_format($level->revenue, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Revenue</th>
                    <th>{{ number_format($totalRevenue, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
