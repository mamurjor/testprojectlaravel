@extends('layouts.app')
@section('title', 'Bangladesh Doctors Club Ltd — Home')

@section('content')

    {{-- ===================== HERO SLIDER ===================== --}}
    <section class="hero position-relative">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000" data-bs-wrap="true"
            data-bs-pause="false" data-bs-touch="true">

            {{-- Indicators --}}
            @if ($slides->count() > 1)
                <div class="carousel-indicators">
                    @foreach ($slides as $s)
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $loop->index }}"
                            class="{{ $loop->first ? 'active' : '.carousel-item' }}"
                            @if ($loop->first) aria-current="true" @endif
                            aria-label="Slide {{ $loop->index + 1 }}"></button>
                    @endforeach
                </div>
            @endif

            {{-- Slides --}}
            <div class="carousel-inner">
                @forelse($slides as $s)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        {{-- Background layer --}}
                        <div class="hero-bg" style="background-image:url('{{ asset('uploads/slider/' . $s->image) }}');">
                        </div>

                        {{-- Content --}}
                        <div class="container position-relative">
                            <div class="row align-items-center min-vh-70 py-5">
                                <div class="col-lg-8 text-white">
                                    @if ($s->badge_text)
                                        <span class="badge text-bg-light text-dark mb-3 px-3 py-2 fw-medium">
                                            <i class="bi {{ $s->badge_icon ?? 'bi-award' }} me-1"></i>{{ $s->badge_text }}
                                        </span>
                                    @endif

                                    <h1 class="mb-3 display-5 fw-bold">{{ $s->title }}</h1>

                                    @if ($s->subtitle)
                                        <p class="lead mb-4 opacity-90">{{ $s->subtitle }}</p>
                                    @endif

                                    <div class="d-flex gap-3 flex-wrap">
                                        @if ($s->btn1_text && $s->btn1_url)
                                            <a href="{{ $s->btn1_url }}" class="btn btn-primary btn-lg px-4">
                                                {{ $s->btn1_text }}
                                            </a>
                                        @endif
                                        @if ($s->btn2_text && $s->btn2_url)
                                            <a href="{{ $s->btn2_url }}" class="btn btn-outline-light btn-lg px-4">
                                                {{ $s->btn2_text }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Fallback (no slides) --}}
                    <div class="carousel-item active">
                        <div class="hero-bg" style="background:#0b1220"></div>
                        <div class="container position-relative">
                            <div class="row align-items-center min-vh-70 py-5">
                                <div class="col-lg-8 text-white">
                                    <span class="badge text-bg-light text-dark mb-3 px-3 py-2">BDCL</span>
                                    <h1 class="mb-3 display-5 fw-bold">Welcome to BDCL</h1>
                                    <p class="lead mb-4 opacity-90">Add slides from Admin → Slides, they will show here.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Controls --}}
            @if ($slides->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"
                    aria-label="Previous">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next"
                    aria-label="Next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            @endif
        </div>
    </section>

    {{-- resources/views/site/partials/feature-cards.blade.php (উদাহরণ) --}}
    <section id="services" class="section section-sm" style="background:linear-gradient(#fff,#f5f7fb)">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="fw-bold">Connecting for Inspiring Healthcare</h2>
                <p class="text-muted">Core values & services we provide</p>
            </div>

            <div class="row g-3 g-md-4">
                @forelse ($items as $it)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="feature h-100 p-3 p-lg-4 bg-white border rounded-4"
                            style="--accent: {{ $it->accent_color ?? '#0ea5a8' }};">
                            <div class="d-flex align-items-start gap-3">
                                <div class="icon-wrap d-inline-flex align-items-center justify-content-center rounded-3">
                                    <i class="{{ $it->icon_class ?? 'bi-star-fill' }}"></i>
                                </div>
                                <div>
                                    <h6 class="mt-1 mb-1">{{ $it->title }}</h6>
                                    @if ($it->description)
                                        <p class="text-muted small mb-0">{{ $it->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-light border text-center mb-0">
                            No features added yet.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>



    {{-- ===================== PRESIDIUM MEMBERS ===================== --}}




    {{-- ===================== ABOUT + PRESIDENT MESSAGE ===================== --}}
    <!-- Modernized About Section -->
    <section id="about" class="section">
        <div class="container">
            <div class="row g-4 align-items-stretch"> {{-- Left: Club Intro --}} <div class="col-lg-7">
                    <div class="about-box h-100 p-4 p-lg-5 shadow-soft">
                        <h3 class="mb-3">{{ $club?->title }}</h3>
                        @if ($club?->body)
                            <p class="mb-3">{{ $club->body }}</p>
                            @endif @if (!empty($club?->bullet_points))
                                <ul class="mb-4">
                                    @foreach ($club->bullet_points as $bp)
                                        <li>{{ $bp }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="d-flex gap-3">
                                @if ($club?->btn1_text && $club?->btn1_url)
                                    <a class="btn btn-brand px-4" href="{{ $club->btn1_url }}">{{ $club->btn1_text }}</a>
                                    @endif @if ($club?->btn2_text && $club?->btn2_url)
                                        <a class="btn btn-outline-light px-4" href="{{ $club->btn2_url }}" target="_blank"
                                            rel="noopener"> <i class="bi bi-download me-1"></i>
                                            {{ $club->btn2_text }} </a>
                                    @endif
                            </div>
                    </div>
                </div> {{-- Right: President Message --}} <div class="col-lg-5">
                    <div class="h-100 p-4 p-lg-5 rounded-2xl shadow-soft" style="border:1px solid #e9eef5;">
                        <div class="d-flex align-items-center gap-3 mb-3"> <img
                                src="{{ $pres?->avatar ? asset('uploads/president/' . $pres->avatar) : 'https://via.placeholder.com/64x64.png?text=+' }}"
                                class="rounded-circle" width="64" height="64"
                                alt="{{ $pres?->person_name ?? 'President' }}" style="object-fit:cover;">
                            <div>
                                <div class="fw-bold">{{ $pres?->heading ?? 'President Message' }}</div> <small
                                    class="text-muted"> {{ $pres?->person_name }} @if ($pres?->person_title)
                                        — {{ $pres->person_title }}
                                    @endif </small>
                            </div>
                        </div>
                        @if ($pres?->quote)
                            <p class="text-muted">“{{ $pres->quote }}”</p>
                        @endif
                        <div class="d-flex align-items-center gap-3 mt-3">
                            @if ($pres?->badge_text)
                                <span class="badge rounded-pill bg-teal-soft text-teal fw-semibold px-3 py-2">
                                    {{ $pres->badge_text }} </span>
                                @endif @if ($pres?->read_more_url)
                                    <a href="{{ $pres->read_more_url }}" class="btn btn-outline-secondary">Read
                                        More</a>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Minimal styles to modernize look; move to your CSS file in production -->



    {{-- ===================== FEATURES / VALUES ===================== --}}


    {{-- ===================== PORTFOLIO / GALLERY ===================== --}}
    {{-- <section id="portfolio" class="section">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="fw-bold">Our Awesome Portfolio</h2>
                <p class="text-muted">Snapshots from our programs & events</p>
            </div>
            <div class="row g-3 gallery">
                <div class="col-6 col-md-4"><img class="g"
                        src="https://images.unsplash.com/photo-1550831107-1553da8c8464?q=80&w=900&auto=format&fit=crop"
                        alt="gallery" loading="lazy"></div>
                <div class="col-6 col-md-4"><img class="g"
                        src="https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?q=80&w=900&auto=format&fit=crop"
                        alt="gallery" loading="lazy"></div>
                <div class="col-12 col-md-4"><img class="g-tall"
                        src="https://images.unsplash.com/photo-1600959907703-125ba1374a12?q=80&w=900&auto=format&fit=crop"
                        alt="gallery" loading="lazy"></div>
                <div class="col-6 col-md-4"><img class="g"
                        src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?q=80&w=900&auto=format&fit=crop"
                        alt="gallery" loading="lazy"></div>
                <div class="col-6 col-md-4"><img class="g"
                        src="https://images.unsplash.com/photo-1584982751601-97dcc096659c?q=80&w=900&auto=format&fit=crop"
                        alt="gallery" loading="lazy"></div>
                <div class="col-12 col-md-4"><img class="g-tall"
                        src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?q=80&w=900&auto=format&fit=crop"
                        alt="gallery" loading="lazy"></div>
            </div>
        </div>
    </section> --}}

    {{-- ===================== TESTIMONIALS ===================== --}}
    <section class="section" style="background:#0c1424">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-white">What They’re Saying</h2>
                <p class="text-secondary">Reviews from our members & partners</p>
            </div>

            <div id="testi" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">


                    @include('partials.testimonials', ['testimonials' => $testimonials])
                </div>

                <div class="text-center mt-3">
                    <button class="btn btn-outline-light btn-sm me-2" data-bs-target="#testi" data-bs-slide="prev"
                        aria-label="Prev"><i class="bi bi-arrow-left"></i></button>
                    <button class="btn btn-outline-light btn-sm" data-bs-target="#testi" data-bs-slide="next"
                        aria-label="Next"><i class="bi bi-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== FAQ + CTA ===================== --}}
    <section class="section">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-3">Have Questions In Your Mind?</h2>
                    <p class="text-muted mb-3">Get the answers now — common doubts cleared.</p>

                    <div class="accordion" id="faq">

                        <div class="container">
                            <div class="accordion" id="faqAccordion">
                                @forelse($faqs as $faq)
                                    @php
                                        $qid = 'q' . $faq->id; // header id
                                        $aid = 'a' . $faq->id; // collapse id
                                    @endphp

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="{{ $qid }}">
                                            <button class="accordion-button {{ !$loop->first ? 'collapsed' : '' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#{{ $aid }}"
                                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                aria-controls="{{ $aid }}">
                                                {{ $faq->question }}
                                            </button>
                                        </h2>
                                        <div id="{{ $aid }}"
                                            class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                            aria-labelledby="{{ $qid }}" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                {!! nl2br(e($faq->answer)) !!}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="alert alert-light border text-center mb-0">No FAQs yet.</div>
                                @endforelse
                            </div>
                        </div>



                    </div>
                </div>

                <div class="col-lg-6">
                    <img class="img-fluid rounded-2xl shadow-soft"
                        src="https://images.unsplash.com/photo-1537368910025-700350fe46c7?q=80&w=1400&auto=format&fit=crop"
                        alt="Doctors" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== PARTNERS ===================== --}}
    <section class="section-sm partners-section">
        <div class="container text-center mb-4">
            <h5 class="fw-bold mb-1">Our Partners</h5>
            <p class="text-muted small mb-0">Collaborating with the best organizations</p>
        </div>

        <div class="partners-slider">
            @if ($partners->isNotEmpty())
                <div class="partners-wrap overflow-hidden py-3" aria-label="Our partners">
                    <div class="partners-track d-flex align-items-center">
                        {{-- set 1 --}}
                        @foreach ($partners as $p)
                            <a class="logo d-inline-flex align-items-center justify-content-center"
                                href="{{ $p->website_url ?? '#' }}" target="_blank" rel="noopener"
                                title="{{ $p->name }}">
                                <img src="{{ str_starts_with($p->logo, 'http') ? $p->logo : asset('uploads/partner/' . $p->logo) }}"
                                    alt="{{ $p->name }}" loading="lazy">
                            </a>
                        @endforeach
                        {{-- set 2 (duplicate for seamless loop) --}}
                        @foreach ($partners as $p)
                            <a class="logo d-inline-flex align-items-center justify-content-center"
                                href="{{ $p->website_url ?? '#' }}" target="_blank" rel="noopener"
                                title="{{ $p->name }}">
                                <img src="{{ str_starts_with($p->logo, 'http') ? $p->logo : asset('storage/' . $p->logo) }}"
                                    alt="{{ $p->name }}" loading="lazy">
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="alert alert-light border text-center mb-0">No partners yet.</div>
            @endif
        </div>
    </section>

    {{-- ===================== NEWS ===================== --}}
    {{-- <section id="news" class="section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-3">
                <div>
                    <h2 class="fw-bold">Latest News & Articles</h2>
                    <p class="text-muted">Updates from our community</p>
                </div>
                <a href="#" class="btn btn-outline-secondary">View all</a>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 rounded-2xl shadow-soft">
                        <img src="https://images.unsplash.com/photo-1551076805-e1869033e561?q=80&w=1200&auto=format&fit=crop"
                            class="card-img-top" alt="news">
                        <div class="card-body">
                            <div class="badge bg-success-subtle text-success mb-2">CME</div>
                            <h5 class="card-title">National CME Conference 2025</h5>
                            <p class="card-text text-muted">Highlights from this year’s multi-center CME with 1500+
                                attendees.</p>
                        </div>
                        <div class="card-footer bg-white">
                            <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> Jul 12, 2025</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 rounded-2xl shadow-soft">
                        <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?q=80&w=1200&auto=format&fit=crop"
                            class="card-img-top" alt="news">
                        <div class="card-body">
                            <div class="badge bg-info-subtle text-info mb-2">Research</div>
                            <h5 class="card-title">Grant Winners Announced</h5>
                            <p class="card-text text-muted">Meet the teams selected for BDCL research grants 2025–26.</p>
                        </div>
                        <div class="card-footer bg-white">
                            <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> Jun 30, 2025</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 rounded-2xl shadow-soft">
                        <img src="https://images.unsplash.com/photo-1579154204601-01588f351e67?q=80&w=1200&auto=format&fit=crop"
                            class="card-img-top" alt="news">
                        <div class="card-body">
                            <div class="badge bg-warning-subtle text-warning mb-2">Outreach</div>
                            <h5 class="card-title">Rural Health Initiative</h5>
                            <p class="card-text text-muted">Mobile clinics & awareness programs in Rangpur division.</p>
                        </div>
                        <div class="card-footer bg-white">
                            <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> May 22, 2025</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section id="news" class="section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-3">
                <div>
                    <h2 class="fw-bold">Latest News & Articles</h2>
                    <p class="text-muted">Updates from our community</p>
                </div>
                <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary">View all</a>
            </div>

            <div class="row g-4">
                @forelse ($posts as $post)
                    @php
                        // প্রথম ক্যাটাগরি (থাকলে)
                        $cat = $post->categories->first();

                        // ক্যাটাগরি অনুসারে badge color (প্রয়োজনে বাড়ান)
                        $badgeMap = [
                            'CME' => ['bg-success-subtle', 'text-success'],
                            'Research' => ['bg-info-subtle', 'text-info'],
                            'Outreach' => ['bg-warning-subtle', 'text-warning'],
                        ];
                        $badgeClasses = $badgeMap[$cat->name ?? ''] ?? ['bg-secondary-subtle', 'text-secondary'];

                        // ইমেজ: featured_image থাকলে সেটা; নয়তো placeholder
                        $image = $post->featured_image
                            ? asset('uploads/post_featured_image/' . $post->featured_image)
                            : 'https://picsum.photos/seed/' . $post->id . '/1000/700';
                    @endphp

                    <div class="col-md-4">
                        <div class="card h-100 rounded-2xl shadow-soft">
                            <a href="{{ route('blog.show', $post) }}" class="text-decoration-none">
                                <img src="{{ $image }}" class="card-img-top" alt="{{ $post->title }}">
                            </a>
                            <div class="card-body">
                                @if ($cat)
                                    <a href="{{ route('blog.category', $cat) }}"
                                        class="badge {{ $badgeClasses[0] }} {{ $badgeClasses[1] }} mb-2 text-decoration-none">
                                        {{ $cat->name }}
                                    </a>
                                @endif

                                <h5 class="card-title">
                                    <a href="{{ route('blog.show', $post) }}"
                                        class="stretched-link text-dark text-decoration-none">
                                        {{ $post->title }}
                                    </a>
                                </h5>

                                @if ($post->excerpt)
                                    <p class="card-text text-muted mb-0">
                                        {{ \Illuminate\Support\Str::limit($post->excerpt, 120) }}
                                    </p>
                                @endif
                            </div>
                            <div class="card-footer bg-white">
                                <small class="text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ optional($post->published_at)->format('M d, Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-light border text-center mb-0">No news found.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ===================== CONTACT ===================== --}}
    <section id="contact" class="section" style="background:linear-gradient(#f5f7fb,#fff)">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-3">Contact Us</h2>
                    <p class="text-muted">Have queries or partnership ideas? Reach out.</p>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="bi bi-geo-alt-fill text-success me-2"></i> 123 Health Ave, Dhaka</li>
                        <li class="mb-2"><i class="bi bi-envelope-fill text-success me-2"></i> info@bdcl.org</li>
                        <li class="mb-2"><i class="bi bi-telephone-fill text-success me-2"></i> +880 1XXX-XXXXXX</li>
                    </ul>
                    <div class="ratio ratio-16x9 rounded-2xl shadow-soft">
                        <iframe title="BDCL map"
                            src="https://maps.google.com/maps?q=Dhaka&t=&z=12&ie=UTF8&iwloc=&output=embed"
                            loading="lazy"></iframe>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="contact-card shadow-soft">
                        <h4 class="mb-3">Get In Touch</h4>
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <form id="contactForm">
                            <div class="col-md-6">
                                <label class="form-label">Your Name</label>
                                <input type="text" name="name" class="form-control" required>
                                <div class="invalid-feedback">Please enter your name</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                                <div class="invalid-feedback">Provide a valid email</div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" name="message" rows="4" required></textarea>
                                <div class="invalid-feedback">Write a short message</div>
                            </div>
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>

                            <div class="col-12">
                                <button class="btn btn-brand px-4" type="submit">Send Message</button>
                            </div>

                            {{-- v2 widget --}}



                            <div id="contactSuccess" class="alert alert-success mt-3 d-none"></div>
                            <div id="contactFail" class="alert alert-danger mt-3 d-none"></div>
                        </form>

                        {{-- Only v2 script --}}
                        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

                        <script>
                            const form = document.getElementById('contactForm');
                            const successBox = document.getElementById('contactSuccess');
                            const failBox = document.getElementById('contactFail');
                            const postUrl = "{{ route('contact.store') }}";
                            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                            function clearErrors() {
                                form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                                form.querySelectorAll('[data-error]').forEach(el => el.textContent = '');
                                successBox.classList.add('d-none');
                                failBox.classList.add('d-none');
                            }

                            form.addEventListener('submit', async (e) => {
                                e.preventDefault();
                                clearErrors();
                                const btn = form.querySelector('button[type=submit]');
                                btn.disabled = true;

                                try {
                                    // v2 widget hidden input name=g-recaptcha-response already present
                                    const body = new FormData(form);
                                    const res = await fetch(postUrl, {
                                        method: 'POST',
                                        credentials: 'same-origin',
                                        headers: {
                                            'X-CSRF-TOKEN': csrf,
                                            'X-Requested-With': 'XMLHttpRequest',
                                            'Accept': 'application/json',
                                        },
                                        body
                                    });

                                    let data, ct = res.headers.get('content-type') || '';
                                    if (ct.includes('application/json')) data = await res.json();
                                    else {
                                        const txt = await res.text();
                                        try {
                                            data = JSON.parse(txt);
                                        } catch {
                                            data = {
                                                message: txt,
                                                errors: {}
                                            };
                                        }
                                    }

                                    if (res.ok) {
                                        form.reset();
                                        if (typeof grecaptcha !== 'undefined') grecaptcha.reset(); // reset checkbox
                                        successBox.textContent = data.message || 'Message sent.';
                                        successBox.classList.remove('d-none');
                                    } else if (res.status === 422) {
                                        const errs = data.errors || {};
                                        Object.keys(errs).forEach(name => {
                                            const input = form.querySelector(`[name="${name}"]`);
                                            const help = form.querySelector(`[data-error="${name}"]`);
                                            if (input) input.classList.add('is-invalid');
                                            if (help) help.textContent = errs[name][0];
                                        });
                                        failBox.textContent = data.message || 'Please fix the errors and try again.';
                                        failBox.classList.remove('d-none');
                                    } else {
                                        failBox.textContent = data.message || `Request failed (${res.status}).`;
                                        failBox.classList.remove('d-none');
                                    }
                                } catch (err) {
                                    console.error(err);
                                    failBox.textContent = 'Network error. Please try again.';
                                    failBox.classList.remove('d-none');
                                } finally {
                                    btn.disabled = false;
                                }
                            });
                        </script>
                    </div>
                </div>

            </div>
        </div>
        {{-- Only v2 script --}}


    </section>
@endsection

@push('scripts')
    <script>
        (function() {
            function initHeroCarousel() {
                var BS = window.bootstrap;
                var els = document.querySelectorAll('#heroCarousel'); // চাইলে '.carousel' দিলেও চলবে
                if (!BS || !BS.Carousel || els.length === 0) return;

                var reduceMotion = window.matchMedia &&
                    window.matchMedia('(prefers-reduced-motion: reduce)').matches;

                els.forEach(function(el) {
                    // আগের ইনস্ট্যান্স থাকলে বাদ দিন (ডাবল-ইনিট প্রতিরোধ)
                    var existing = BS.Carousel.getInstance(el);
                    if (existing) existing.dispose();

                    // অপশনস: reduce-motion হলে autoplay বন্ধ
                    var opts = {
                        interval: reduceMotion ? false : 6000,
                        ride: reduceMotion ? false : 'carousel',
                        pause: false, // hover করলে থামাতে চাইলে: 'hover'
                        touch: true,
                        wrap: true,
                        keyboard: true
                    };

                    BS.Carousel.getOrCreateInstance(el, opts);

                    // সেফটি: ঠিক একটাই .active নিশ্চিত করা
                    var items = el.querySelectorAll('.carousel-item');
                    if (items.length) {
                        var actives = el.querySelectorAll('.carousel-item.active');
                        if (actives.length !== 1) {
                            items.forEach(function(it, i) {
                                it.classList.toggle('active', i === 0);
                            });
                        }
                    }
                });
            }

            // DOM রেডি হলে ও সম্পূর্ণ লোডের পর—দুটো সময়েই রান করুন
            document.addEventListener('DOMContentLoaded', initHeroCarousel);
            window.addEventListener('load', initHeroCarousel);
        })();
    </script>
@endpush
