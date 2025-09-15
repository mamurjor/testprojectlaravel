{{-- resources/views/emails/contact/submitted.blade.php --}}
@component('mail::message')
    # New Contact Message

    **Name:** {{ $m->name }}
    **Email:** {{ $m->email ?? '—' }}
    **Phone:** {{ $m->phone ?? '—' }}

    **Message:**
    {{ $m->message }}

    @php
        // relative path (leading slash সহ)
        $path = route('admin.contact.show', $m->id, false);
        // absolute url তৈরি: APP_URL + relative path
        $absolute = rtrim(config('app.url'), '/') . $path;
    @endphp

    @component('mail::button', ['url' => $absolute])
        View in Admin
    @endcomponent
