@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Notices</h3>
            <a class="btn btn-primary" href="{{ route('notices.create') }}">
                Create Notice
            </a>
        </div>

        @if (session('ok'))
            <div class="alert alert-success shadow-sm">{{ session('ok') }}</div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:72px;">#</th>
                                <th>Title</th>
                                <th>Body</th>
                                <th style="width:180px;">Created</th>
                                <th style="width:160px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notices as $n)
                                <tr>
                                    <td class="fw-semibold">{{ $n->id }}</td>

                                    <td class="fw-semibold">
                                        {{ $n->title }}
                                    </td>

                                    <td class="text-muted">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($n->body), 120) }}
                                        @if (\Illuminate\Support\Str::length(strip_tags($n->body)) > 120)
                                            <button type="button" class="btn btn-link btn-sm p-0 ms-2 align-baseline"
                                                data-bs-toggle="modal" data-bs-target="#noticeModal-{{ $n->id }}">
                                                Read
                                            </button>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="badge text-bg-light">
                                            {{ $n->created_at?->format('Y-m-d H:i') }}
                                        </span>
                                        <div class="small text-muted">
                                            {{ $n->created_at?->diffForHumans() }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                data-bs-toggle="modal" data-bs-target="#noticeModal-{{ $n->id }}">
                                                View
                                            </button>

                                            <form class="d-inline" action="{{ route('notices.destroy', $n->id) }}"
                                                method="post" onsubmit="return confirm('Delete this notice?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Modal: Full view --}}
                                <div class="modal fade" id="noticeModal-{{ $n->id }}" tabindex="-1"
                                    aria-labelledby="noticeModalLabel-{{ $n->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="noticeModalLabel-{{ $n->id }}">
                                                    {{ $n->title }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="mb-0">{!! nl2br(e($n->body)) !!}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <small class="text-muted me-auto">
                                                    Created: {{ $n->created_at?->format('Y-m-d H:i') }}
                                                </small>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- /Modal --}}

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted p-4">No notices</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-white">
                {{ $notices->links() }}
            </div>
        </div>
    </div>
@endsection
