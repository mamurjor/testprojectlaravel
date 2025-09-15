@extends('layouts.app')
@section('content')
    <div class="container my-5">
        <div class="row gx-4">
            <!-- ARTICLE -->
            <div class="col-lg-7">
                <article class="article card-soft p-3 p-md-4" id="articleBody">

                    {{-- Lead / Excerpt --}}
                    @if ($post->excerpt)
                        <p class="lead">{{ $post->excerpt }}</p>
                    @endif

                    {{-- Optional callout (example: show first category as tag summary) --}}
                    @if ($post->categories->isNotEmpty())
                        <div class="callout mb-3">
                            <strong>Tags:</strong>
                            @foreach ($post->categories as $c)
                                <a class="badge text-bg-light border text-decoration-none"
                                    href="{{ route('blog.category', $c) }}">{{ $c->name }}</a>
                            @endforeach
                        </div>
                    @endif

                    {{-- Title & Meta --}}
                    <h1 class="fw-bold mb-2">{{ $post->title }}</h1>
                    <p class="text-muted small mb-4">
                        ✍️ by <span class="fw-semibold">{{ $post->author->name }}</span> —
                        {{ optional($post->published_at)->format('M d, Y') }}
                    </p>

                    {{-- Featured image (optional) --}}
                    @php
                        $hero = $post->featured_image ?? null;
                    @endphp
                    @if ($hero)
                        <img class="w-100 rounded-3 mb-3" src="{{ asset('uploads/post_featured_image/' . $hero) }}"
                            alt="{{ $post->title }}" loading="lazy">
                    @endif

                    {{-- Content (choose ONE) --}}
                    {{-- If sanitized via purifier: --}}
                    {!! $post->content !!}
                    {{-- If not sanitized, use safe rendering: --}}
                    {{-- <div class="fs-5 lh-lg">{!! nl2br(e($post->content)) !!}</div> --}}

                    <hr class="my-4">

                    <!-- Author -->
                    <div class="author p-3 d-flex gap-3 align-items-center">
                        <img src="https://i.pravatar.cc/72?u={{ $post->author->id }}" class="rounded-circle" width="72"
                            height="72" alt="author">
                        <div>
                            <h6 class="mb-1">{{ $post->author->name }}</h6>
                            <div class="muted small mb-2">
                                {{ $post->categories->pluck('name')->take(2)->join(' • ') }}
                            </div>
                            <div class="d-flex gap-2">
                                <a class="btn btn-sm btn-outline-secondary" href="#"><i
                                        class="bi bi-twitter-x me-1"></i> Follow</a>
                                <a class="btn btn-sm btn-outline-secondary" href="#"><i
                                        class="bi bi-linkedin me-1"></i> Connect</a>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Prev / Next -->
                <div class="pvnx row g-3 mt-3">
                    <div class="col-md-6">
                        @if ($prev)
                            <a class="card h-100 p-3 d-block text-decoration-none" href="{{ route('blog.show', $prev) }}">
                                <div class="small muted">Previous</div>
                                <div class="fw-semibold">{{ $prev->title }}</div>
                            </a>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if ($next)
                            <a class="card h-100 p-3 d-block text-end text-decoration-none"
                                href="{{ route('blog.show', $next) }}">
                                <div class="small muted">Next</div>
                                <div class="fw-semibold">{{ $next->title }}</div>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Comments (demo only) -->
                {{-- <div class="card-soft p-3 p-md-4 mt-3">
                    <h5 class="mb-3">Leave a comment</h5>
                    <form class="row g-3 needs-validation" novalidate>
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" required>
                            <div class="invalid-feedback">Name required</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" required>
                            <div class="invalid-feedback">Valid email required</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Comment</label>
                            <textarea class="form-control" rows="4" required></textarea>
                            <div class="invalid-feedback">Write something</div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-brand text-white"><i class="bi bi-send me-1"></i> Submit</button>
                        </div>
                    </form>
                </div> --}}
                <div class="card-soft p-3 p-md-4 mt-3">
                    <h5 class="mb-3">Leave a comment</h5>

                    <div id="cmtAlert" class="alert alert-success d-none"></div>

                    <form id="commentForm" class="row g-3" novalidate>
                        @csrf
                        <input type="text" name="hp_field" class="d-none" tabindex="-1" autocomplete="off">
                        {{-- honeypot --}}
                        <input type="hidden" name="parent_id" id="parent_id">

                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                            <div class="invalid-feedback">Name required</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                            <div class="invalid-feedback">Valid email required</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Website (optional)</label>
                            <input type="url" name="website" class="form-control" placeholder="https://">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Comment</label>
                            <textarea name="body" class="form-control" rows="4" required></textarea>
                            <div class="invalid-feedback">Write something</div>
                        </div>
                        <div class="col-12 d-flex align-items-center gap-2">
                            <button id="cmtSubmit" class="btn btn-brand text-white" type="submit">
                                <i class="bi bi-send me-1"></i> Submit
                            </button>
                            <button id="cmtClearReply" type="button" class="btn btn-sm btn-outline-secondary d-none">Cancel
                                reply</button>
                        </div>
                    </form>
                </div>


                <div id="commentsBlock" class="mt-4">
                    <h5 class="fw-bold mb-3">Comments</h5>
                    <div id="commentsList" class="d-flex flex-column gap-2"></div>

                    <div class="d-grid mt-3">
                        <button id="loadMoreBtn" class="btn btn-outline-secondary d-none">Load more</button>
                    </div>
                </div>

            </div>

            <!-- SIDEBAR -->
            <aside class="col-lg-4">
                <div class="side-sticky">
                    <!-- TOC -->
                    <div class="side-item p-3 mb-3">
                        <h6 class="fw-bold mb-2"><i class="bi bi-list-check me-1"></i> সূচিপত্র</h6>
                        <nav id="toc" class="small"></nav>
                    </div>

                    <!-- Recent -->
                    <div class="side-item p-3 mb-3">
                        <h6 class="fw-bold mb-2">Recent posts</h6>
                        @forelse($recent as $rp)
                            <div class="d-flex gap-2 align-items-start mb-2">
                                <img class="rounded"
                                    src="{{ asset('uploads/post_featured_image/' . $rp->featured_image) }}"
                                    width="84" height="56" alt="{{ $rp->title }}">
                                <div class="small">
                                    <a href="{{ route('blog.show', $rp) }}"
                                        class="fw-semibold d-block text-decoration-none">{{ $rp->title }}</a>
                                    <span class="muted">{{ optional($rp->published_at)->format('d M Y') }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-muted small">No recent posts</div>
                        @endforelse
                    </div>

                    <!-- Newsletter (demo) -->
                </div>
            </aside>
        </div>

        <!-- Related -->
        @if ($related->count())
            <div class="mt-4">
                <h5 class="fw-bold mb-2">Related articles</h5>
                <div class="row g-3">
                    @foreach ($related as $r)
                        <div class="col-md-4">
                            <a class="card-soft d-block p-2 text-decoration-none" href="{{ route('blog.show', $r) }}">
                                <img class="w-100 rounded-3"
                                    src="{{ asset('uploads/post_featured_image/' . $r->featured_image) }}"
                                    alt="{{ $r->title }}" width="1000" height="560" loading="lazy">
                                <div class="p-2">
                                    <div class="small muted mb-1">
                                        {{ $r->categories->pluck('name')->take(1)->join(', ') ?: 'Article' }} •
                                        {{ optional($r->published_at)->format('d M Y') }}
                                    </div>
                                    <div class="fw-semibold">{{ $r->title }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    {{-- Optional: Tiny TOC builder from headings (H2/H3) --}}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const article = document.getElementById('articleBody');
                const toc = document.getElementById('toc');
                if (!article || !toc) return;

                const heads = article.querySelectorAll('h2, h3');
                if (!heads.length) {
                    toc.innerHTML = '<span class="text-muted">No sections</span>';
                    return;
                }

                const ul = document.createElement('ul');
                ul.className = 'list-unstyled';
                heads.forEach(h => {
                    if (!h.id) h.id = h.textContent.trim().toLowerCase().replace(/\\s+/g, '-');
                    const li = document.createElement('li');
                    li.className = (h.tagName === 'H3') ? 'ms-3' : '';
                    const a = document.createElement('a');
                    a.href = '#' + h.id;
                    a.textContent = h.textContent;
                    a.className = 'text-decoration-none';
                    li.appendChild(a);
                    ul.appendChild(li);
                });
                toc.appendChild(ul);
            });
        </script>
    @endpush
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const postSlug = @json($post->slug); // পোস্ট স্লাগ Blade থেকে নিলাম
            const listEl = document.getElementById('commentsList');
            const loadBtn = document.getElementById('loadMoreBtn');
            const form = document.getElementById('commentForm');
            const alertBox = document.getElementById('cmtAlert');
            const submitBtn = document.getElementById('cmtSubmit');
            const clearReply = document.getElementById('cmtClearReply');
            const parentIdEl = document.getElementById('parent_id');
            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            let page = 1,
                lastPage = 1,
                loading = false;

            function commentCard(c) {
                // একেকটা কমেন্ট ব্লক (children এক লেভেল)
                const website = c.website ?
                    `<a href="${c.website}" target="_blank" rel="nofollow noopener">${c.website}</a>` : '';
                const childHtml = (c.children || []).map(ch => `
      <div class="border rounded-3 p-3 mt-2 ms-3">
        <div class="d-flex justify-content-between">
          <div class="fw-semibold">${ch.name} <span class="text-muted">— ${ch.email}</span></div>
          <small class="text-muted">${ch.created_at}</small>
        </div>
        ${ch.website ? `<div class="small mb-1"><a href="${ch.website}" target="_blank" rel="nofollow noopener">Website</a></div>` : ''}
        <div>${ch.body}</div>
      </div>
    `).join('');

                return `
      <div class="border rounded-3 p-3">
        <div class="d-flex justify-content-between">
          <div class="fw-semibold">${c.name} <span class="text-muted">— ${c.email}</span></div>
          <small class="text-muted">${c.created_at}</small>
        </div>
        ${website ? `<div class="small mb-1">${website}</div>` : ''}
        <div>${c.body}</div>
        <div class="mt-2">
          <button class="btn btn-sm btn-outline-secondary" data-reply="${c.id}">Reply</button>
        </div>
        ${childHtml}
      </div>
    `;
            }

            function bindReplyButtons() {
                listEl.querySelectorAll('[data-reply]').forEach(btn => {
                    btn.addEventListener('click', e => {
                        parentIdEl.value = e.currentTarget.getAttribute('data-reply');
                        clearReply.classList.remove('d-none');
                        form.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    });
                });
            }

            clearReply.addEventListener('click', () => {
                parentIdEl.value = '';
                clearReply.classList.add('d-none');
            });

            async function fetchComments() {
                if (loading) return;
                loading = true;
                loadBtn.classList.add('disabled');

                const url = `{{ url('/blog') }}/${encodeURIComponent(postSlug)}/comments?page=${page}`;
                const res = await fetch(url);
                const json = await res.json();

                json.data.forEach(c => {
                    listEl.insertAdjacentHTML('beforeend', commentCard(c));
                });

                lastPage = json.pagination.last_page || 1;

                page++;
                loading = false;
                bindReplyButtons();

                if (page <= lastPage) {
                    loadBtn.classList.remove('d-none');
                    loadBtn.classList.remove('disabled');
                } else {
                    loadBtn.classList.add('d-none');
                }
            }

            loadBtn?.addEventListener('click', fetchComments);

            // initial load
            fetchComments();

            // Submit handler (AJAX)
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                // Client-side validity (basic)
                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    return;
                }

                submitBtn.disabled = true;

                const formData = new FormData(form);

                const res = await fetch(
                    `{{ url('/blog') }}/${encodeURIComponent(postSlug)}/comments`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    });

                if (res.ok) {
                    const json = await res.json();

                    // নতুন কমেন্ট টপে দেখাতে চাইলে listEl.prepend করুন
                    listEl.insertAdjacentHTML('afterbegin', commentCard(json.comment));
                    bindReplyButtons();

                    alertBox.classList.remove('d-none', 'alert-danger');
                    alertBox.classList.add('alert-success');
                    alertBox.innerHTML = `<i class="bi bi-check2-circle me-1"></i> ${json.message}`;

                    // reset
                    form.reset();
                    form.classList.remove('was-validated');
                    parentIdEl.value = '';
                    clearReply.classList.add('d-none');
                } else {
                    const err = await res.json().catch(() => ({}));
                    alertBox.classList.remove('d-none', 'alert-success');
                    alertBox.classList.add('alert-danger');
                    alertBox.textContent = err.message || 'Failed to submit comment.';
                }

                submitBtn.disabled = false;
            });
        });
    </script>
@endpush
