{{-- resources/views/admin/contact_messages/show.blade.php --}}
@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container py-4">
        <a href="{{ route('admin.contact.index') }}" class="btn btn-link">&larr; Back</a>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Message #{{ $contactMessage->id }}</strong>
                <div class="d-flex gap-2">
                    @if (!$contactMessage->is_read)
                        <form action="{{ route('admin.contact.read', $contactMessage) }}" method="post">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-success">Mark as Read</button>
                        </form>
                    @endif

                    <form action="{{ route('admin.contact.destroy', $contactMessage) }}" method="post"
                        onsubmit="return confirm('Delete this message?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $contactMessage->name }}</p>
                <p><strong>Email:</strong> {{ $contactMessage->email ?? '—' }}</p>
                <p><strong>Phone:</strong> {{ $contactMessage->phone ?? '—' }}</p>
                <hr>
                <p class="mb-1"><strong>Message:</strong></p>
                <div class="border rounded p-3 bg-light">
                    {!! nl2br(e($contactMessage->message)) !!}
                </div>
                <hr>
                <small class="text-muted">Received: {{ $contactMessage->created_at->format('d M Y, h:i A') }}</small>
            </div>
        </div>
    </div>
@endsection
