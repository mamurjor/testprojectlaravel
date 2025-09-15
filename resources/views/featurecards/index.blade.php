@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Feature Cards</h5>
                <a href="{{ route('featurecards.create') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> New Feature
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Icon</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th class="text-center" width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $it)
                                <tr>
                                    <td>{{ $it->id }}</td>
                                    <td>
                                        @if ($it->icon_class)
                                            <i class="{{ $it->icon_class }}"
                                                style="color: {{ $it->accent_color ?? '#0ea5a8' }}; font-size: 1.25rem;"></i>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td><strong>{{ $it->title }}</strong></td>
                                    <td class="text-muted">{{ Str::limit($it->description, 80) }}</td>
                                    <td>{{ $it->sort_order }}</td>
                                    <td>
                                        @if ($it->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('featurecards.edit', $it) }}"
                                            class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('featurecards.destroy', $it) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Delete this feature?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger"><i
                                                    class="bi bi-trash3"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No features yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($items->hasPages())
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-center">{{ $items->links() }}</div>
                </div>
            @endif
        </div>
    </div>
@endsection
