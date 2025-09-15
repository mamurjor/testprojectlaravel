{{-- resources/views/auth/verify-email.blade.php --}}
<!doctype html>
<html lang="bn">

<head>
    <meta charset="utf-8">
    <title>BDCL — Verify Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --brand: #0ea5a0;
            --muted: #6b7280;
            --bg: #0b1220;
            --grad1: #0ea5a0;
            --grad2: #2563eb;
        }

        html,
        body {
            height: 100%
        }

        body {
            background:
                radial-gradient(80vmax 80vmax at -10% -10%, rgba(14, 165, 160, .25), transparent 40%),
                radial-gradient(80vmax 80vmax at 110% 10%, rgba(37, 99, 235, .25), transparent 45%),
                conic-gradient(from 220deg at 70% 20%, rgba(255, 255, 255, .06), transparent 35%),
                var(--bg);
            color: #e6edf3;
            font-family: system-ui, -apple-system, Segoe UI, Inter, Roboto, Helvetica, Arial, sans-serif;
        }

        .auth-wrap {
            min-height: 100dvh;
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .glass {
            backdrop-filter: blur(14px) saturate(160%);
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 22px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, .35);
            overflow: hidden;
        }

        .hero-side {
            background:
                radial-gradient(120% 120% at -10% -20%, rgba(14, 165, 160, .35), transparent 40%),
                radial-gradient(120% 120% at 120% 0%, rgba(37, 99, 235, .35), transparent 45%),
                linear-gradient(180deg, rgba(255, 255, 255, .06), rgba(255, 255, 255, .02));
            border-right: 1px solid rgba(255, 255, 255, .15);
        }

        .brand-badge {
            width: 46px;
            height: 46px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            background: #109e9a;
            color: #fff;
            font-weight: 800;
            letter-spacing: .5px;
            box-shadow: 0 10px 30px rgba(16, 158, 154, .45)
        }

        .muted {
            color: var(--muted)
        }

        .btn-brand {
            background: linear-gradient(90deg, var(--grad1), var(--grad2));
            border: 0;
            color: #fff
        }

        .btn-brand:hover {
            filter: brightness(.97)
        }

        .btn-soft {
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .18);
            color: #e6edf3
        }

        .form-control {
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .18);
            color: #e6edf3
        }

        .form-control:focus {
            border-color: #bfecea;
            box-shadow: 0 0 0 .2rem rgba(14, 165, 160, .15)
        }

        .small-muted {
            font-size: .9rem;
            color: #9aa4b2
        }

        @media (max-width:991.98px) {
            .hero-side {
                display: none
            }
        }
    </style>
</head>

<body>
    <div class="auth-wrap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xxl-9">
                    <div class="glass row g-0">

                        {{-- Left visual --}}
                        <div class="col-lg-5 hero-side p-4 p-md-5">
                            <div class="d-flex align-items-center gap-2 mb-4">
                                <div class="brand-badge">BD</div>
                                <div>
                                    <div class="fw-bold fs-5">Bangladesh Doctors Club Ltd</div>
                                    <div class="small muted">Verify your email address</div>
                                </div>
                            </div>
                            <img class="w-100 rounded-4" alt="Illustration"
                                src="https://images.unsplash.com/photo-1584017911766-d451b3d129d9?w=1600&auto=format&fit=crop&q=80">
                            <div class="mt-4 small muted">
                                নিরাপত্তার জন্য আপনার ইমেইল যাচাই করা প্রয়োজন। ইমেইল ইনবক্স/স্প্যাম ফোল্ডার চেক করুন।
                            </div>
                        </div>

                        {{-- Right: Verify UI --}}
                        <div class="col-lg-7 p-4 p-md-5">
                            {{-- Status alert (Breeze uses session status "verification-link-sent") --}}
                            @if (session('status') == 'verification-link-sent')
                                <div class="alert alert-success py-2 mb-3">
                                    <i class="bi bi-check2-circle me-1"></i>
                                    নতুন একটি ভেরিফিকেশন লিংক আপনার ইমেইলে পাঠানো হয়েছে।
                                </div>
                            @endif

                            <h3 class="fw-bold mb-1">ইমেইল যাচাই করুন</h3>
                            <p class="small-muted mb-3">
                                <i class="bi bi-envelope-check me-1"></i>
                                <strong>{{ Auth::user()->email }}</strong> ঠিকানায় আমরা একটি ভেরিফিকেশন লিংক পাঠিয়েছি।
                                লিংকটি ওপেন করলে আপনার অ্যাকাউন্ট ভেরিফাই হয়ে যাবে।
                            </p>

                            <div class="p-3 rounded-4 mb-3"
                                style="background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.14)">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-info-circle"></i>
                                    <div class="small-muted">
                                        লিংক পাননি? নিচের **Resend** বাটনে ক্লিক করুন। অতিরিক্ত রিকুয়েস্ট ঠেকাতে
                                        সামান্য সময় ব্যবধান থাকতে পারে।
                                    </div>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="d-flex flex-wrap gap-2">
                                <form id="resendForm" method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button id="resendBtn" class="btn btn-brand">
                                        <i class="bi bi-send-check me-1"></i> Resend Verification Email
                                    </button>
                                </form>

                                {{-- Optional: Edit profile/email page (change email) --}}
                                @if (Route::has('profile.edit'))
                                    <a href="{{ route('profile.edit') }}" class="btn btn-soft">
                                        <i class="bi bi-pencil-square me-1"></i> Change Email
                                    </a>
                                @endif

                                {{-- Logout --}}
                                <form method="POST" action="{{ route('logout') }}" class="ms-auto">
                                    @csrf
                                    <button class="btn btn-outline-light">
                                        <i class="bi bi-box-arrow-right me-1"></i> Log Out
                                    </button>
                                </form>
                            </div>

                            {{-- Help --}}
                            <div class="mt-4 small-muted">
                                টিপস: জিমেইল ব্যবহার করলে <b>“All Mail”</b> বা <b>“Spam”</b> ফোল্ডারও দেখুন। কর্পোরেট
                                মেইলে হলে কখনও কখনও
                                অ্যাডমিন ফিল্টারে আটকে যেতে পারে।
                            </div>

                            {{-- Optional: cool CTA to open mailbox --}}
                            <div class="mt-3">
                                <a class="btn btn-outline-info btn-sm" href="https://mail.google.com/" target="_blank"
                                    rel="noopener">
                                    <i class="bi bi-box-arrow-up-right me-1"></i> Open Gmail
                                </a>
                                <a class="btn btn-outline-info btn-sm" href="https://outlook.office.com/mail/"
                                    target="_blank" rel="noopener">
                                    <i class="bi bi-box-arrow-up-right me-1"></i> Open Outlook
                                </a>
                            </div>
                        </div>{{-- /Right --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center py-3 small text-secondary">
        © <span id="y"></span> Bangladesh Doctors Club Ltd
    </footer>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('y').textContent = new Date().getFullYear();

        // ছোট্ট UX: রিসেন্ড বাটন 30s disable (ব্রীজে backend throttle থাকেই)
        const btn = document.getElementById('resendBtn');
        const form = document.getElementById('resendForm');
        let lock = false;

        form?.addEventListener('submit', function() {
            if (lock) return;
            lock = true;
            btn.disabled = true;
            let remaining = 30;
            const original = btn.innerHTML;
            const timer = setInterval(() => {
                remaining--;
                btn.innerHTML = `<i class="bi bi-hourglass-split me-1"></i> Resend in ${remaining}s`;
                if (remaining <= 0) {
                    clearInterval(timer);
                    btn.disabled = false;
                    lock = false;
                    btn.innerHTML = original;
                }
            }, 1000);
        });
    </script>
</body>

</html>
