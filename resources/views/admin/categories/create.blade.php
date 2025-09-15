@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container my-5">
        <div class="card border-0 shadow-lg rounded-3">
            <div class="card-header bg-gradient bg-primary text-white py-3 d-flex align-items-center">
                <i class="bi bi-folder-plus me-2 fs-4"></i>
                <h4 class="mb-0">➕ Create New Category</h4>
            </div>
            <div class="card-body p-4">

                {{-- Error Alert --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>⚠️ Please fix the following:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf

                    {{-- Category Name --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Category Name</label>
                        <input type="text" class="form-control shadow-sm" name="name" value="{{ old('name') }}"
                            required placeholder="Enter category name">
                    </div>

                    {{-- Slug --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Slug <small class="text-muted">(optional)</small></label>
                        <input type="text" class="form-control shadow-sm" name="slug" value="{{ old('slug') }}"
                            placeholder="auto-generated if empty">
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control shadow-sm" name="description" rows="3" placeholder="Short description">{{ old('description') }}</textarea>
                    </div>

                    {{-- Parent Category --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Parent Category <small
                                class="text-muted">(optional)</small></label>
                        <select class="form-select shadow-sm" name="parent_id">
                            <option value="">-- None --</option>
                            @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Save Button --}}
                    <div class="text-end">
                        <button class="btn btn-primary px-5 fw-semibold shadow-sm" type="submit">
                            <i class="bi bi-save me-1"></i> Save Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
