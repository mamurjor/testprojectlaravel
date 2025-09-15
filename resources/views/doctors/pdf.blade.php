<!DOCTYPE html>
<html>

<head>
    <title>Doctors List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Doctors List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>

                <th>Specialization</th>
                <th>Membership Level</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->id }}</td>
                    <td> <img src="{{ public_path('storage/' . $doctor->profile_photo) }}" width="50" class="rounded">
                    </td>
                    <td>{{ $doctor->name }}</td>
                    <td>{{ $doctor->phone }}</td>
                    <td>{{ $doctor->email }}</td>

                    <td>{{ $doctor->specialization }}</td>
                    <td>
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
                    <td>{{ ucfirst($doctor->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
