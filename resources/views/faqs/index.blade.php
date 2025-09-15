@extends('layouts.adminlayout')
@section('maincontent')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">FAQs</h5>
                <a href="{{ route('faqs.create') }}" class="btn btn-primary btn-sm">+ New</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th class="text-center" width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($faqs as $f)
                            <tr>
                                <td>{{ $f->id }}</td>
                                <td>{{ $f->question }}</td>
                                <td>{{ $f->sort_order }}</td>
                                <td>{!! $f->is_active
                                    ? '<span class="badge bg-success">Active</span>'
                                    : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                                <td class="text-center">
                                    <a href="{{ route('faqs.edit', $f) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('faqs.destroy', $f) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Delete?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-3 text-muted">No FAQs yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($faqs->hasPages())
                <div class="card-footer d-flex justify-content-center">{{ $faqs->links() }}</div>
            @endif
        </div>
    </div>
@endsection
