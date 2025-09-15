{{-- resources/views/auth/forgot-password.blade.php --}}
<!doctype html>
<html lang="bn">

<head>
    <meta charset="utf-8">
    <title>BDCL — Forgot Password</title>
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
                                    <div class="small muted">Reset your account password</div>
                                </div>
                            </div>
                            <img class="w-100 rounded-4" alt="Illustration"
                                src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=1600&auto=format&fit=crop&q=80">
                            <div class="mt-4 small muted">
                                আপনার ইমেইল এড্রেস দিন — আমরা একটি **পাসওয়ার্ড রিসেট লিংক** পাঠাবো।
                            </div>
                        </div>

                        {{-- Right: Forgot form --}}
                        <div class="col-lg-7 p-4 p-md-5">
                            <h3 class="fw-bold mb-1">পাসওয়ার্ড রিসেট</h3>
                            <p class="small-muted mb-3">নিচে ইমেইল দিন, ইনবক্স/স্প্যাম ফোল্ডার চেক করুন।</p>

                            {{-- Breeze status message --}}
                            @if (session('status'))
                                <div class="alert alert-success py-2 mb-3">
                                    <i class="bi bi-check2-circle me-1"></i> {{ session('status') }}
                                </div>
                            @endif

                            {{-- Laravel validation errors --}}
                            @if ($errors->any())
                                <div class="alert alert-danger py-2 mb-3">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    {{ __('Whoops! Something went wrong.') }}
                                    <ul class="mb-0 mt-1 small">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form id="forgotForm" method="POST" action="{{ route('password.email') }}" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">ইমেইল এড্রেস</label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="you@example.com" required>
                                    <div class="invalid-feedback">সঠিক ইমেইল দিন।</div>
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-brand btn-lg" type="submit">
                                        <i class="bi bi-send-check me-1"></i> রিসেট লিংক পাঠান
                                    </button>
                                </div>

                                <div class="d-flex flex-wrap gap-2 mt-3">
                                    <a href="{{ route('login') }}" class="btn btn-soft">
                                        <i class="bi bi-box-arrow-in-right me-1"></i> লগইন পেইজে যান
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-outline-light">
                                            <i class="bi bi-person-plus me-1"></i> নতুন একাউন্ট খুলুন
                                        </a>
                                    @endif
                                </div>
                            </form>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('y').textContent = new Date().getFullYear();

        // jQuery Validate (client-side)
        $(function() {
            $('#forgotForm').validate({
                errorClass: 'is-invalid',
                validClass: 'is-valid',
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent()); // input-group হলে
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(el) {
                    $(el).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(el) {
                    $(el).removeClass('is-invalid').addClass('is-valid');
                },
                rules: {
                    email: {
                        required: true,
                        email: true,
                        maxlength: 180
                    }
                },
                messages: {
                    email: {
                        required: 'ইমেইল লিখুন',
                        email: 'সঠিক ইমেইল দিন',
                        maxlength: 'ইমেইল খুব বড়'
                    }
                }
            });
        });
    </script>
</body>

</html>
