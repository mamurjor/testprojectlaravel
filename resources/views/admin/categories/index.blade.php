@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold mb-0"><i class="bi bi-folder2-open me-2"></i> Categories</h3>
            <a href="{{ route('categories.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> New Category
            </a>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 shadow-lg rounded-3">
            <div class="card-body">
                @if ($categories->count())
                    <div class="table-responsive">
                        <table class="table align-middle table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Parent</th>
                                    <th>Description</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $cat)
                                    <tr>
                                        <td>{{ $cat->id }}</td>
                                        <td class="fw-semibold">{{ $cat->name }}</td>
                                        <td><span class="text-muted">{{ $cat->slug }}</span></td>
                                        <td>{{ $cat->parent?->name ?? '—' }}</td>
                                        <td>{{ Str::limit($cat->description, 50) }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('categories.edit', $cat) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('categories.destroy', $cat) }}" method="POST"
                                                class="d-inline-block"
                                                onsubmit="return confirm('Are you sure you want to delete this category?')">
                                                @csrf
                                                @method('DELETE')
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

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center mt-3">
                        {{ $categories->links() }}
                    </div>
                @else
                    <div class="alert alert-light border text-center mb-0">
                        No categories found.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
