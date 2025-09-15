{{-- resources/views/auth/register.blade.php --}}
<!doctype html>
<html lang="bn">

<head>
    <meta charset="utf-8">
    <title>BDCL — Register</title>
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

        .form-control:focus,
        .form-select:focus {
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

        .strength {
            height: 8px;
            background: rgba(255, 255, 255, .08);
            border-radius: 6px;
            overflow: hidden
        }

        .strength>span {
            display: block;
            height: 100%;
            width: 0%;
            transition: width .3s ease;
            background: linear-gradient(90deg, #ef4444, #f59e0b, #10b981)
        }

        @media (max-width:991.98px) {
            .hero-side {
                display: none
            }
        }

        /* jQuery validate error look */
        label.error {
            color: #f8d7da;
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
                                    <div class="small muted">Join the community</div>
                                </div>
                            </div>
                            <img class="w-100 rounded-4" alt="Illustration"
                                src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=1600&auto=format&fit=crop&q=80">
                            <div class="mt-4 small muted">Gain access to CPD workshops, events, research & partner
                                benefits.</div>
                        </div>

                        {{-- Right: Register form --}}
                        <div class="col-lg-7 p-4 p-md-5">

                            {{-- Laravel validation summary --}}
                            @if ($errors->any())
                                <div class="alert alert-danger py-2 mb-3">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <h3 class="fw-bold mb-1">Create your account</h3>
                            <p class="muted small mb-3">Join Bangladesh Doctors Club community</p>

                            <form id="regForm" method="POST" action="{{ route('register') }}" novalidate>
                                @csrf

                                <div class="row g-3">
                                    {{-- Name --}}
                                    <div class="col-sm-6">
                                        <label class="form-label" for="name">Full Name</label>
                                        <input type="text" id="name" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Dr. John Doe" required maxlength="120"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-sm-6">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="you@example.com" required value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>




                                    {{-- Password --}}
                                    <div class="col-12">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group">
                                            <input type="password" id="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Min 8 chars" required minlength="8"
                                                autocomplete="new-password">
                                            <button class="btn btn-soft toggle-pass" type="button"
                                                aria-label="Toggle password">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <div class="strength mt-2"><span id="bar"></span></div>
                                        <div class="small muted mt-1">Use upper/lowercase, number & symbol.</div>
                                    </div>

                                    {{-- Confirm --}}
                                    <div class="col-12">
                                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="form-control" placeholder="Re-type password" required minlength="8"
                                            autocomplete="new-password">
                                    </div>

                                    {{-- Terms --}}
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input @error('terms') is-invalid @enderror"
                                                type="checkbox" id="tos" name="terms"
                                                {{ old('terms') ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="tos">
                                                I agree to the <a href="#" class="text-decoration-none">Terms</a>
                                                &amp;
                                                <a href="#" class="text-decoration-none">Privacy Policy</a>.
                                            </label>
                                            @error('terms')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid mt-3">
                                    <button class="btn btn-brand btn-lg" type="submit">
                                        <i class="bi bi-person-plus me-1"></i> Create Account
                                    </button>
                                </div>

                                <p class="small mt-3 mb-0">Already have an account?
                                    @if (Route::has('login'))
                                        <a class="text-decoration-none" href="{{ route('login') }}">Login</a>
                                    @else
                                        <a class="text-decoration-none" href="#">Login</a>
                                    @endif
                                </p>
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

        // Strength meter + match
        const $pass = $('#password'),
            $pass2 = $('#password_confirmation'),
            $bar = $('#bar');

        function strength(p) {
            let s = 0;
            if (p.length >= 8) s++;
            if (/[A-Z]/.test(p)) s++;
            if (/[a-z]/.test(p)) s++;
            if (/[0-9]/.test(p)) s++;
            if (/[^A-Za-z0-9]/.test(p)) s++;
            return Math.min(s, 5);
        }

        function updateBar() {
            const sc = strength($pass.val() || '');
            $bar.css('width', (sc / 5 * 100) + '%');
        }

        function matchPw() {
            return $pass.val() && $pass.val() === $pass2.val();
        }
        $pass.on('input', () => {
            updateBar();
            $('#regForm').valid();
        });
        $pass2.on('input', () => $('#regForm').valid());

        // jQuery Validation
        $('#regForm').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 120
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    minlength: 7,
                    maxlength: 20
                },
                role: {
                    required: false
                },
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo: '#password'
                },
                terms: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: 'পুরো নাম দিন'
                },
                email: {
                    required: 'ইমেইল দিন',
                    email: 'সঠিক ইমেইল দিন'
                },
                password: {
                    required: 'পাসওয়ার্ড দিন',
                    minlength: 'কমপক্ষে ৮ অক্ষর'
                },
                password_confirmation: {
                    required: 'পাসওয়ার্ড কনফার্ম করুন',
                    equalTo: 'পাসওয়ার্ড মিলছে না'
                },
                terms: {
                    required: 'টার্মস & প্রাইভেসি মেনে নিতে হবে'
                }
            },
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            highlight: el => $(el).addClass('is-invalid'),
            unhighlight: el => $(el).removeClass('is-invalid'),
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if (element.is(':checkbox')) {
                    error.insertAfter(element.closest('.form-check'));
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>
</body>

</html>
