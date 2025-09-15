@extends('layouts.adminlayout')
@section('maincontent')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Partners</h5>
                <a href="{{ route('partners.create') }}" class="btn btn-light btn-sm"><i class="bi bi-plus-circle me-1"></i>
                    New</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Logo</th>
                                <th>Name</th>
                                <th>Website</th>
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
                                        @if ($it->logo)
                                            <img src="{{ str_starts_with($it->logo, 'http') ? $it->logo : asset('uploads/partner/' . $it->logo) }}"
                                                style="height:28px">
                                        @endif
                                    </td>
                                    <td>{{ $it->name }}</td>
                                    <td class="small"><a href="{{ $it->website_url }}" target="_blank"
                                            rel="noopener">{{ Str::limit($it->website_url, 40) }}</a></td>
                                    <td>{{ $it->sort_order }}</td>
                                    <td>{!! $it->is_active
                                        ? '<span class="badge bg-success">Active</span>'
                                        : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                                    <td class="text-center">
                                        <a href="{{ route('partners.edit', $it) }}"
                                            class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('partners.destroy', $it) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Delete?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">Delete
                                                {{ $it->logo_file }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No partners yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($items->hasPages())
                <div class="card-footer d-flex justify-content-center">{{ $items->links() }}</div>
            @endif
        </div>
    </div>
@endsection
