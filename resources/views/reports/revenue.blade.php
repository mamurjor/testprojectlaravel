@extends('layouts.adminlayout'))

@section('maincontent')
   <div class="container">
    <h2 class="mb-4">Revenue Report (Only Members)</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Doctor Name</th>
                <th>Membership Level</th>
                <th>Fee</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
            <tr>
                <td>{{ $doctor->name }}</td>
                <td>{{ $doctor->membershipLevel->name }}</td>
                <td>{{ number_format($doctor->membershipLevel->price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total Revenue</th>
                <th>{{ number_format($totalRevenue, 2) }}</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
