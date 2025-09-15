{{-- resources/views/auth/login.blade.php --}}
<!doctype html>
<html lang="bn">

<head>
    <meta charset="utf-8">
    <title>BDCL — Login</title>
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

        .form-control,
        .form-select {
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .18);
            color: #e6edf3
        }

        .form-control:focus {
            border-color: #bfecea;
            box-shadow: 0 0 0 .2rem rgba(14, 165, 160, .15)
        }

        .form-check-input {
            background: rgba(255, 255, 255, .1);
            border-color: rgba(255, 255, 255, .3)
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

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #9aa4b2
        }

        .divider::before,
        .divider::after {
            content: "";
            height: 1px;
            flex: 1;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .25), transparent)
        }

        @media (max-width:991.98px) {
            .hero-side {
                display: none
            }
        }

        /* jQuery validate error to match Bootstrap */
        label.error {
            color: #f8d7da;
            background: transparent;
            font-size: .875rem;
            margin-top: .25rem;
            display: block;
        }

        .is-invalid {
            border-color: #ee9ca7
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
                                    <div class="small muted">Community of physicians & innovators</div>
                                </div>
                            </div>
                            <img class="w-100 rounded-4" alt="Illustration"
                                src="https://images.unsplash.com/photo-1584515933487-779824d29309?w=1200&auto=format&fit=crop&q=80">
                            <div class="mt-4 small muted">
                                Access member-only events, CPD workshops & partner benefits.
                            </div>
                        </div>

                        {{-- Right: Login form --}}
                        <div class="col-lg-7 p-4 p-md-5">

                            {{-- Breeze-style session status (optional) --}}
                            @if (session('status'))
                                <div class="alert alert-success py-2">{{ session('status') }}</div>
                            @endif

                            {{-- Breeze validation summary (optional) --}}
                            @if ($errors->any())
                                <div class="alert alert-danger py-2 mb-3">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <h3 class="fw-bold mb-1">Welcome back</h3>
                            <p class="muted small mb-3">Login to continue to BDCL dashboard</p>

                            <form id="loginForm" method="POST" action="{{ route('login') }}" novalidate>
                                @csrf

                                {{-- Email --}}
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" placeholder="you@example.com" required autofocus>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback">Valid email is required.</div>
                                    @enderror
                                </div>

                                {{-- Password --}}
                                <div class="mb-2">
                                    <label class="form-label" for="password">Password</label>
                                    <div class="input-group">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="********" required minlength="6">
                                        <button class="btn btn-soft toggle-pass" type="button"
                                            aria-label="Toggle password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback">Password is required (min 6).</div>
                                    @enderror

                                    <div class="d-flex justify-content-between mt-1 small">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remember"
                                                name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">Remember me</label>
                                        </div>

                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}"
                                                class="text-decoration-none">Forgot password?</a>
                                        @endif
                                    </div>
                                </div>

                                <div class="d-grid mt-3">
                                    <button class="btn btn-brand btn-lg" type="submit">
                                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                                    </button>
                                </div>

                                <p class="small mt-3 mb-0">New here?
                                    @if (Route::has('register'))
                                        <a class="text-decoration-none" href="{{ route('register') }}">Create an
                                            account</a>
                                    @else
                                        <a class="text-decoration-none" href="#">Register</a>
                                    @endif
                                </p>
                            </form>
                        </div><!-- /Right -->
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script>
        document.getElementById('y').textContent = new Date().getFullYear();

        // Toggle password
        $(document).on('click', '.toggle-pass', function() {
            const $input = $(this).closest('.input-group').find('input');
            const isPass = $input.attr('type') === 'password';
            $input.attr('type', isPass ? 'text' : 'password');
            $(this).html(isPass ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>');
        });

        // jQuery Validation (client-side)
        $('#loginForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                email: {
                    required: 'ইমেইল দিন',
                    email: 'সঠিক ইমেইল দিন'
                },
                password: {
                    required: 'পাসওয়ার্ড দিন',
                    minlength: 'কমপক্ষে ৬ অক্ষর'
                }
            },
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            },
            // place error after input or after input-group
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>
</body>

</html>
