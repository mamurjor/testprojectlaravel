@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container py-4">

        {{-- Top toolbar --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <a href="{{ route('notices.index') }}" class="btn btn-outline-secondary">
                    ← Back to list
                </a>
            </div>
            <div class="d-flex align-items-center gap-2">
                @isset($subscriberCount)
                    <span class="badge text-bg-light">Subscribers: {{ number_format($subscriberCount) }}</span>
                @endisset
                <button type="submit" form="notice-form" class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>

        {{-- Card --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white">
                <h3 class="mb-0 fs-5">Create Notice</h3>
            </div>

            <div class="card-body">
                <form id="notice-form" method="post" action="{{ route('notices.store') }}" class="mt-1">
                    @csrf

                    {{-- Title --}}
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label class="form-label mb-1">Title</label>
                            <small class="text-muted"><span id="titleCount">0</span>/255</small>
                        </div>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            required maxlength="255" value="{{ old('title') }}"
                            oninput="document.getElementById('titleCount').textContent=this.value.length">
                        @error('title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Body --}}
                    <div class="mb-3">
                        <label class="form-label">Body</label>
                        <textarea name="body" class="form-control @error('body') is-invalid @enderror" rows="8" required>{{ old('body') }}</textarea>
                        @error('body')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="form-text">You can write plain text; line breaks will be preserved in emails.</div>
                    </div>

                    {{-- Send now (switch) --}}
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="send_now" name="send_now" value="1"
                            {{ old('send_now', 1) ? 'checked' : '' }}>
                        <label class="form-check-label" for="send_now">Send to subscribers now</label>
                    </div>
                </form>
            </div>

            {{-- Sticky footer actions --}}
            <div class="card-footer bg-white d-flex justify-content-between">
                <a href="{{ route('notices.index') }}" class="btn btn-light">Back to list</a>
                <button type="submit" form="notice-form" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
@endsection
