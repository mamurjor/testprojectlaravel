@extends('layouts.adminlayout')
@section('maincontent')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold mb-0"><i class="bi bi-chat-quote me-2"></i> Testimonials</h3>
            <a href="{{ route('testimonials.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> New
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                @if ($testimonials->count())
                    <div class="table-responsive">
                        <table class="table align-middle table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Client</th>
                                    <th>Quote</th>
                                    <th>Rating</th>
                                    <th>Active</th>
                                    <th>Sort</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testimonials as $t)
                                    <tr>
                                        <td>{{ $t->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                @if ($t->avatar_src)
                                                    <img src="{{ asset('uploads/avatar/' . $t->avatar_src) }}"
                                                        width="36" height="36" class="rounded-circle" alt="">
                                                @endif
                                                <div>
                                                    <div class="fw-semibold">{{ $t->name }}</div>
                                                    <div class="small text-muted">{{ $t->role }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="max-width:380px">
                                            <div class="text-muted small">{{ Str::limit($t->quote, 120) }}</div>
                                        </td>
                                        <td>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="bi {{ $i <= $t->rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                                            @endfor
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $t->is_active ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }}">
                                                {{ $t->is_active ? 'Active' : 'Hidden' }}
                                            </span>
                                        </td>
                                        <td>{{ $t->sort_order }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('testimonials.edit', $t) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('testimonials.destroy', $t) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Delete this item?');">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $testimonials->links() }}
                    </div>
                @else
                    <div class="alert alert-light border text-center mb-0">No testimonials found.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
