@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Hero Section</h5>
                        <a href="{{ route('herosections.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left-circle me-1"></i> Back
                        </a>
                    </div>

                    <div class="card-body">
                        {{-- Validation Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('herosections.update', $herosection) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" value="{{ old('title', $herosection->title) }}"
                                    class="form-control @error('title') is-invalid @enderror" required>
                                @error('title')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Subtitle</label>
                                <input type="text" name="subtitle" value="{{ old('subtitle', $herosection->subtitle) }}"
                                    class="form-control @error('subtitle') is-invalid @enderror">
                                @error('subtitle')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Badge Text</label>
                                    <input type="text" name="badge_text"
                                        value="{{ old('badge_text', $herosection->badge_text) }}" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Badge Icon (class)</label>
                                    <input type="text" name="badge_icon"
                                        value="{{ old('badge_icon', $herosection->badge_icon) }}" class="form-control"
                                        placeholder="e.g. bi-star-fill">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Sort Order</label>
                                    <input type="number" name="sort_order"
                                        value="{{ old('sort_order', $herosection->sort_order ?? 0) }}" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label d-block">Current Image</label>
                                    @if ($herosection->image)
                                        <img src="{{ asset('storage/' . $herosection->image) }}" alt="current"
                                            class="rounded border" style="height:60px;width:100px;object-fit:cover;">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Replace Image</label>
                                <input type="file" name="image" class="form-control">
                                <small class="text-muted">Max 2MB. Upload only if you want to replace.</small>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Button 1 Text</label>
                                    <input type="text" name="btn1_text"
                                        value="{{ old('btn1_text', $herosection->btn1_text) }}" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Button 1 URL</label>
                                    <input type="url" name="btn1_url"
                                        value="{{ old('btn1_url', $herosection->btn1_url) }}" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Button 2 Text</label>
                                    <input type="text" name="btn2_text"
                                        value="{{ old('btn2_text', $herosection->btn2_text) }}" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Button 2 URL</label>
                                    <input type="url" name="btn2_url"
                                        value="{{ old('btn2_url', $herosection->btn2_url) }}" class="form-control">
                                </div>
                            </div>

                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                    value="1" {{ old('is_active', $herosection->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active?</label>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success me-2">
                                    <i class="bi bi-save me-1"></i> Update
                                </button>
                                <a href="{{ route('herosections.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
