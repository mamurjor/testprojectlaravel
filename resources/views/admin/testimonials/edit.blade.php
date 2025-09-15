@extends('layouts.adminlayout')
@section('maincontent')
    <div class="container my-5">
        <div class="card border-0 shadow-lg rounded-3">
            <div class="card-header bg-warning">
                <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Edit Testimonial</h5>
            </div>
            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('testimonials.update', $testimonial) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Client Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $testimonial->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role/Title</label>
                            <input type="text" name="role" class="form-control"
                                value="{{ old('role', $testimonial->role) }}">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Quote</label>
                            <textarea name="quote" rows="3" class="form-control" required>{{ old('quote', $testimonial->quote) }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Rating</label>
                            <select name="rating" class="form-select">
                                @for ($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}"
                                        {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>
                                        {{ $i }} ★
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Avatar (upload)</label>
                            @if ($testimonial->avatar_src)
                                <div class="mb-2"><img src="{{ asset('uploads/avatar/' . $testimonial->avatar_src) }}"
                                        width="64" height="64" class="rounded-circle"></div>
                            @endif
                            <input type="file" name="avatar" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">OR Avatar URL</label>
                            <input type="url" name="avatar_url" class="form-control"
                                value="{{ old('avatar_url', $testimonial->avatar_url) }}" placeholder="https://...">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control"
                                value="{{ old('sort_order', $testimonial->sort_order) }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-center">

                            <div class="form-check mt-3">
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                    id="is_active" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button class="btn btn-warning px-4"><i class="bi bi-save me-1"></i> Update</button>
                        <a href="{{ route('testimonials.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
