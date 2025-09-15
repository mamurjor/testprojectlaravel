@php $editing = isset($clubintro); @endphp

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
    <input class="form-control @error('title') is-invalid @enderror" name="title" required
        value="{{ old('title', $clubintro->title ?? '') }}">
    @error('title')
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Body</label>
    <textarea name="body" rows="4" class="form-control">{{ old('body', $clubintro->body ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Bullet points (one per line)</label>
    <textarea name="bullet_points_raw" rows="4" class="form-control">{{ old('bullet_points_raw', isset($clubintro->bullet_points) ? implode("\n", $clubintro->bullet_points) : '') }}</textarea>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Button 1 Text</label>
        <input class="form-control" name="btn1_text" value="{{ old('btn1_text', $clubintro->btn1_text ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Button 1 URL</label>
        <input class="form-control" name="btn1_url" value="{{ old('btn1_url', $clubintro->btn1_url ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Button 2 Text</label>
        <input class="form-control" name="btn2_text" value="{{ old('btn2_text', $clubintro->btn2_text ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Button 2 URL</label>
        <input class="form-control" name="btn2_url" value="{{ old('btn2_url', $clubintro->btn2_url ?? '') }}">
    </div>
</div>

<div class="form-check form-switch mb-3">
    <input class="form-check-input" type="checkbox" name="is_active" value="1"
        {{ old('is_active', $clubintro->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label">Active?</label>
</div>
