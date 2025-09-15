@php $editing = isset($president); @endphp

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
        <label class="form-label">Heading</label>
        <input class="form-control" name="heading"
            value="{{ old('heading', $president->heading ?? 'President Message') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Badge Text (e.g., 2016)</label>
        <input class="form-control" name="badge_text" value="{{ old('badge_text', $president->badge_text ?? '') }}">
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Name <span class="text-danger">*</span></label>
        <input class="form-control @error('person_name') is-invalid @enderror" name="person_name" required
            value="{{ old('person_name', $president->person_name ?? '') }}">
        @error('person_name')
            <small class="invalid-feedback">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Title/Designation</label>
        <input class="form-control" name="person_title"
            value="{{ old('person_title', $president->person_title ?? '') }}">
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Quote <span class="text-danger">*</span></label>
    <textarea name="quote" rows="4" class="form-control @error('quote') is-invalid @enderror">{{ old('quote', $president->quote ?? '') }}</textarea>
    @error('quote')
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Read More URL</label>
        <input class="form-control" name="read_more_url"
            value="{{ old('read_more_url', $president->read_more_url ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label d-block">Avatar</label>
        @if (!empty($president?->avatar))
            <img src="{{ asset('uploads/president/' . $president->avatar) }}" class="rounded-circle mb-2" width="56"
                height="56" style="object-fit:cover;">
        @endif
        <input type="file" name="avatar" class="form-control">
        <small class="text-muted">Max 2MB</small>
    </div>
</div>

<div class="form-check form-switch mb-3">
    <input class="form-check-input" type="checkbox" name="is_active" value="1"
        {{ old('is_active', $president->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label">Active?</label>
</div>
