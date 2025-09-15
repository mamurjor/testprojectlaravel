@php $editing = isset($faq); @endphp
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
    <label class="form-label">Question <span class="text-danger">*</span></label>
    <input type="text" name="question" class="form-control" required value="{{ old('question', $faq->question ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Answer <span class="text-danger">*</span></label>
    <textarea name="answer" rows="4" class="form-control" required>{{ old('answer', $faq->answer ?? '') }}</textarea>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" class="form-control"
            value="{{ old('sort_order', $faq->sort_order ?? 0) }}" min="0">
    </div>
    <div class="col-md-6 mb-3 d-flex align-items-end">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                {{ old('is_active', $faq->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active?</label>
        </div>
    </div>
</div>
