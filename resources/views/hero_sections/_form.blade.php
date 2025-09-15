@php
  $editing = isset($herosection);
@endphp

@if ($errors->any())
  <div style="background:#fef2f2;color:#991b1b;padding:8px 12px;border-radius:8px;margin-bottom:12px;">
    <strong>Validation errors:</strong>
    <ul style="margin-left:18px;">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div style="display:grid;gap:12px;grid-template-columns:1fr 1fr;">
  <div>
    <label>Title</label>
    <input type="text" name="title" value="{{ old('title', $herosection->title ?? '') }}" required class="input">
  </div>
  <div>
    <label>Subtitle</label>
    <input type="text" name="subtitle" value="{{ old('subtitle', $herosection->subtitle ?? '') }}" class="input">
  </div>

  <div>
    <label>Badge Text</label>
    <input type="text" name="badge_text" value="{{ old('badge_text', $herosection->badge_text ?? '') }}" class="input">
  </div>
  <div>
    <label>Badge Icon (class)</label>
    <input type="text" name="badge_icon" value="{{ old('badge_icon', $herosection->badge_icon ?? '') }}" class="input" placeholder="e.g. fa-solid fa-star">
  </div>

  <div>
    <label>Sort Order</label>
    <input type="number" name="sort_order" value="{{ old('sort_order', $herosection->sort_order ?? 0) }}" class="input" min="0">
  </div>
  <div>
    <label>Image</label>
    <input type="file" name="image" accept="image/*" class="input">
    @if($editing && !empty($herosection->image))
      <div style="margin-top:6px;">
        <img src="{{ asset('storage/'.$herosection->image) }}" alt="preview" style="height:60px;border-radius:8px;">
      </div>
    @endif
  </div>

  <div>
    <label>Button 1 Text</label>
    <input type="text" name="btn1_text" value="{{ old('btn1_text', $herosection->btn1_text ?? '') }}" class="input">
  </div>
  <div>
    <label>Button 1 URL</label>
    <input type="url" name="btn1_url" value="{{ old('btn1_url', $herosection->btn1_url ?? '') }}" class="input">
  </div>

  <div>
    <label>Button 2 Text</label>
    <input type="text" name="btn2_text" value="{{ old('btn2_text', $herosection->btn2_text ?? '') }}" class="input">
  </div>
  <div>
    <label>Button 2 URL</label>
    <input type="url" name="btn2_url" value="{{ old('btn2_url', $herosection->btn2_url ?? '') }}" class="input">
  </div>

  <div style="grid-column:1 / -1; display:flex; align-items:center; gap:8px; margin-top:6px;">
    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $herosection->is_active ?? true) ? 'checked' : '' }}>
    <label>Active?</label>
  </div>
</div>

<style>
  .input{width:100%; padding:8px 10px; border:1px solid #ddd; border-radius:8px;}
  label{display:block; font-size:0.9rem; margin-bottom:4px; color:#333;}
</style>
