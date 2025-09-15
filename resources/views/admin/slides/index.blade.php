{{-- resources/views/admin/slides/index.blade.php --}}
@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Slides</h4>
            <a href="{{ route('slides.create') }}" class="btn btn-primary">+ New Slide</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Preview</th>
                        <th>Title</th>
                        <th>Active</th>
                        <th>Order</th>
                        <th>Updated</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($slides as $s)
                        <tr>
                            <td>{{ $s->id }}</td>
                            <td style="width:140px">
                                <img src="{{ asset('storage/' . $s->image_path) }}" class="img-fluid rounded" alt=""
                                    style="height:70px;object-fit:cover;">
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $s->title }}</div>
                                <div class="text-muted small">{{ \Illuminate\Support\Str::limit($s->subtitle, 60) }}</div>
                            </td>
                            <td>
                                <span class="badge {{ $s->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $s->is_active ? 'Active' : 'Disabled' }}
                                </span>
                            </td>
                            <td>{{ $s->sort_order }}</td>
                            <td>{{ $s->updated_at->format('d M Y, h:i A') }}</td>
                            <td class="text-end">
                                <a href="{{ route('slides.edit', $s) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form class="d-inline" action="{{ route('slides.destroy', $s) }}" method="post"
                                    onsubmit="return confirm('Delete this slide?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No slides found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-2">{{ $slides->links() }}</div>
    </div>
@endsection
