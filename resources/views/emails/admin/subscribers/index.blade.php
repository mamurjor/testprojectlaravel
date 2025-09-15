@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Subscribers</h3>
            <div>
                <a class="btn btn-outline-primary" href="{{ route('subscribers.export') }}">Export CSV</a>
            </div>
        </div>

        <form class="row g-2 mb-3" method="get">
            <div class="col-auto">
                <input type="text" class="form-control" name="q" value="{{ $q }}"
                    placeholder="Search email">
            </div>
            <div class="col-auto">
                <button class="btn btn-secondary">Search</button>
            </div>
        </form>

        @if (session('ok'))
            <div class="alert alert-success">{{ session('ok') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-sm align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Verified</th>
                        <th>Unsubscribed</th>
                        <th>Joined</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subs as $s)
                        <tr>
                            <td>{{ $s->id }}</td>
                            <td>{{ $s->email }}</td>
                            <td>{{ $s->verified_at ? $s->verified_at->diffForHumans() : 'No' }}</td>
                            <td>{{ $s->unsubscribed_at ? $s->unsubscribed_at->diffForHumans() : '—' }}</td>
                            <td>{{ $s->created_at?->format('Y-m-d H:i') }}</td>
                            <td>
                                <form action="{{ route('subscribers.verify', $s->id) }}" method="post" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success" {{ $s->verified_at ? 'disabled' : '' }}>Mark
                                        Verified</button>
                                </form>
                                <form action="{{ route('subscribers.destroy', $s->id) }}" method="post" class="d-inline"
                                    onsubmit="return confirm('Delete this subscriber?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No subscribers</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $subs->links() }}
    </div>
@endsection
