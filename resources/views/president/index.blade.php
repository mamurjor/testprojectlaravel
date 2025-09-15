@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">President Messages</h5>
                <a href="{{ route('president.create') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> New
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Heading</th>
                                <th>Badge</th>
                                <th>Status</th>
                                <th class="text-center" width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $it)
                                <tr>
                                    <td>{{ $it->id }}</td>
                                    <td>
                                        @if ($it->avatar)
                                            <img src="{{ asset('uploads/president/' . $it->avatar) }}"
                                                class="rounded-circle" width="40" height="40"
                                                style="object-fit:cover;">
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $it->person_name }}</strong>
                                        <div class="small text-muted">{{ $it->person_title }}</div>
                                    </td>
                                    <td>{{ $it->heading }}</td>
                                    <td>{{ $it->badge_text }}</td>
                                    <td>
                                        @if ($it->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('president.edit', $it) }}"
                                            class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('president.destroy', $it) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Delete this item?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger"><i
                                                    class="bi bi-trash3"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No items.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($items->hasPages())
                <div class="card-footer bg-white d-flex justify-content-center">{{ $items->links() }}</div>
            @endif
        </div>
    </div>
@endsection
