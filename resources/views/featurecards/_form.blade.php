@php $editing = isset($featurecard); @endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label class="form-label">Title <span class="text-danger">*</span></label>
    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
        value="{{ old('title', $featurecard->title ?? '') }}" required>
    @error('title')
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" rows="3" class="form-control">{{ old('description', $featurecard->description ?? '') }}</textarea>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Icon class</label>
        <input type="text" name="icon_class" class="form-control" placeholder="e.g. bi-people-fill"
            value="{{ old('icon_class', $featurecard->icon_class ?? 'bi-people-fill') }}">
        <div class="form-text">
            Use <a href="https://icons.getbootstrap.com/" target="_blank" rel="noopener">Bootstrap Icons</a> class.
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Accent color</label>
        <input type="color" name="accent_color" class="form-control form-control-color"
            value="{{ old('accent_color', $featurecard->accent_color ?? '#0ea5a8') }}">
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Sort order</label>
        <input type="number" name="sort_order" class="form-control"
            value="{{ old('sort_order', $featurecard->sort_order ?? 0) }}" min="0">
    </div>
</div>

<div class="form-check form-switch mb-3">
    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
        {{ old('is_active', $featurecard->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Active?</label>
</div>
