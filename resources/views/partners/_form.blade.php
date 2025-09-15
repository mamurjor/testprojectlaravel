@php $editing = isset($partner); @endphp
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" required value="{{ old('name', $partner->name ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Website URL</label>
        <input type="url" name="website_url" class="form-control"
            value="{{ old('website_url', $partner->website_url ?? '') }}">
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Logo URL (external)</label>
        <input type="url" name="logo_url" class="form-control"
            value="{{ old('logo_url', isset($partner) && str_starts_with($partner->logo ?? '', 'http') ? $partner->logo : '') }}">
        <div class="form-text">e.g. https://logo.clearbit.com/domain.com</div>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Or Upload Logo</label>
        <input type="file" name="logo" class="form-control">
        <div class="form-text">PNG/SVG/JPG up to 2MB</div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" class="form-control" min="0"
            value="{{ old('sort_order', $partner->sort_order ?? 0) }}">
    </div>
    <div class="col-md-3 mb-3 d-flex align-items-end">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                {{ old('is_active', $partner->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label">Active?</label>
        </div>
    </div>
    <div class="col-md-6 mb-3 d-flex align-items-end">
        @if (!empty($partner?->logo))
            <div>
                <div class="small text-muted mb-1">Current Logo</div>
                <img src="{{ str_starts_with($partner->logo, 'http') ? $partner->logo : asset('uploads/partner/' . $partner->logo) }}"
                    alt="logo" style="height:40px;">
            </div>
        @endif
    </div>
</div>
