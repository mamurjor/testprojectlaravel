@php
    $imgUrl = $hero->image ? asset('uploads/slider/' . $hero->image) : null;
@endphp

<div
    style="border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;background:#fff;display:flex;flex-direction:column;">
    @if ($imgUrl)
        <img src="{{ $imgUrl }}" alt="{{ $hero->title }}" style="width:100%;aspect-ratio:16/9;object-fit:cover;">
    @endif

    <div style="padding:12px;display:flex;gap:8px;align-items:center;">
        @if ($hero->badge_icon)
            <i class="{{ $hero->badge_icon }}" style="font-size:18px;"></i>
        @endif
        @if ($hero->badge_text)
            <span style="font-size:12px;background:#eef2ff;color:#3730a3;padding:2px 8px;border-radius:999px;">
                {{ $hero->badge_text }}
            </span>
        @endif
        @unless ($hero->is_active)
            <span
                style="font-size:12px;background:#fee2e2;color:#991b1b;padding:2px 8px;border-radius:999px;">Inactive</span>
        @endunless
    </div>

    <div style="padding:0 12px 12px;">
        <h3 style="margin:0 0 6px;">{{ $hero->title }}</h3>
        @if ($hero->subtitle)
            <p style="margin:0 0 10px;color:#6b7280;">{{ $hero->subtitle }}</p>
        @endif

        <div style="display:flex;gap:8px;flex-wrap:wrap;">
            @if ($hero->btn1_text && $hero->btn1_url)
                <a href="{{ $hero->btn1_url }}" target="_blank" rel="noopener" class="btn-sm">{{ $hero->btn1_text }}</a>
            @endif
            @if ($hero->btn2_text && $hero->btn2_url)
                <a href="{{ $hero->btn2_url }}" target="_blank" rel="noopener"
                    class="btn-sm btn-outline">{{ $hero->btn2_text }}</a>
            @endif

            {{-- Admin actions --}}
            <a href="{{ route('herosections.edit', $hero) }}" class="btn-sm">Edit</a>
            <form action="{{ route('herosections.destroy', $hero) }}" method="POST"
                onsubmit="return confirm('Delete this hero?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-sm btn-outline">Delete</button>
            </form>
        </div>
    </div>
</div>

<style>
    .btn-sm {
        background: #111827;
        color: #fff;
        padding: 6px 10px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        border: 0;
    }

    .btn-sm.btn-outline {
        background: #fff;
        color: #111827;
        border: 1px solid #d1d5db;
    }

    form {
        display: inline;
    }
</style>
