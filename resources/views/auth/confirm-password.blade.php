{{-- resources/views/auth/confirm-password.blade.php --}}
<!doctype html>
<html lang="bn">

<head>
    <meta charset="utf-8">
    <title>BDCL — Confirm Password</title>
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
                                    <div class="small muted">Sensitive action ahead — confirm password</div>
                                </div>
                            </div>
                            <img class="w-100 rounded-4" alt="Illustration"
                                src="https://images.unsplash.com/photo-1584982751601-97dcc096659c?w=1600&auto=format&fit=crop&q=80">
                            <div class="mt-4 small muted">
                                সিকিউরিটি নিশ্চিত করতে আবার পাসওয়ার্ড দিন, তারপরই পরবর্তী ধাপে যেতে পারবেন।
                            </div>
                        </div>

                        {{-- Right: Confirm Password form --}}
                        <div class="col-lg-7 p-4 p-md-5">
                            <h3 class="fw-bold mb-1">পাসওয়ার্ড কনফার্ম করুন</h3>
                            <p class="small-muted mb-3">আপনার পরিচয় নিশ্চিত করতে বর্তমান পাসওয়ার্ড প্রয়োজন।</p>

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

                            <form id="confirmForm" method="POST" action="{{ route('password.confirm') }}" novalidate>
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">বর্তমান পাসওয়ার্ড</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="********" required minlength="8"
                                            autocomplete="current-password">
                                        <button class="btn btn-soft toggle-pass" type="button"
                                            aria-label="Toggle password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <div class="invalid-feedback">কমপক্ষে ৮ অক্ষরের সঠিক পাসওয়ার্ড দিন।</div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2 small">
                                        <a class="text-decoration-none" href="{{ route('password.request') }}">
                                            <i class="bi bi-question-circle me-1"></i> পাসওয়ার্ড ভুলে গেছেন?
                                        </a>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-brand btn-lg" type="submit">
                                        <i class="bi bi-shield-check me-1"></i> কনফার্ম & Continue
                                    </button>
                                </div>

                                <div class="d-flex flex-wrap gap-2 mt-3">
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-light">
                                        <i class="bi bi-arrow-left me-1"></i> আগের পেইজে ফিরে যান
                                    </a>
                                    <a href="{{ route('dashboard') }}" class="btn btn-soft">
                                        <i class="bi bi-speedometer2 me-1"></i> ড্যাশবোর্ড
                                    </a>
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

        // Toggle password visibility
        $(document).on('click', '.toggle-pass', function() {
            const $input = $(this).closest('.input-group').find('input');
            const type = $input.attr('type') === 'password' ? 'text' : 'password';
            $input.attr('type', type);
            $(this).html(type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>');
        });

        // jQuery Validate (client-side)
        $('#confirmForm').validate({
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
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
                password: {
                    required: true,
                    minlength: 8
                }
            },
            messages: {
                password: {
                    required: 'পাসওয়ার্ড লিখুন',
                    minlength: 'কমপক্ষে ৮ অক্ষর দিন'
                }
            }
        });
    </script>
</body>

</html>
