<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <img src="https://dummyimage.com/64x64/0ea5a0/ffffff.png&text=BD" alt="BDCL Logo" height="36">
            <strong>BDCL</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="nav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                @php
                    use Illuminate\Support\Str;

                    // Collection নিন, order অনুযায়ী sort করুন
                    $menu = collect($showMenu ?? [])
                        ->sortBy('order')
                        ->values();

                    // parent_id null/0 → 0 করে normalize
                    $menu = $menu->map(function ($i) {
                        $i->pid = $i->parent_id ?: 0;
                        return $i;
                    });

                    // parent অনুযায়ী গ্রুপ করুন
                    $byParent = $menu->groupBy('pid');

                    // URL হেল্পার
                    $makeHref = function ($slug) {
                        if (!$slug) {
                            return '#';
                        }
                        return Str::startsWith($slug, ['http://', 'https://', '#', 'mailto:', 'tel:'])
                            ? $slug
                            : url($slug);
                    };

                    // Recursive renderer
                    $renderMenu = function ($parentId = 0, $depth = 0) use (&$renderMenu, $byParent, $makeHref) {
                        if (!isset($byParent[$parentId])) {
                            return '';
                        }

                        $html = '';

                        foreach ($byParent[$parentId] as $item) {
                            $hasChildren = isset($byParent[$item->id]);
                            $isButton = Str::contains($item->class ?? '', 'btn');
                            $href = $makeHref($item->slug);

                            // <li> class
                            if ($depth === 0) {
                                $liClass = $hasChildren ? 'nav-item dropdown' : 'nav-item';
                                if ($isButton) {
                                    $liClass .= ' ms-lg-2';
                                }
                            } else {
                                $liClass = $hasChildren ? 'dropdown-submenu' : ''; // nested dropdown support (CSS দরকার হতে পারে)
                            }

                            // <a> class
                            if ($isButton) {
                                // বাটন হলে আপনার দেওয়া ক্লাসই ব্যবহার হবে (btn, btn-sm ইত্যাদি)
                                $aClass = trim($item->class);
                            } else {
                                if ($depth === 0) {
                                    $aClass = $hasChildren ? 'nav-link dropdown-toggle' : 'nav-link';
                                } else {
                                    $aClass = $hasChildren ? 'dropdown-item dropdown-toggle' : 'dropdown-item';
                                }
                                if (!empty($item->class)) {
                                    $aClass .= ' ' . trim($item->class);
                                }
                            }

                            // dropdown হলে href="#" ভালো, নইলে আসল লিংক
                            $aHref = $hasChildren ? '#' : $href;

                            // আইকন
                            $iconHtml = !empty($item->icon) ? '<i class="' . e($item->icon) . ' me-1"></i>' : '';

                            // data-bs-toggle শুধু dropdown টগল গুলিতে
                            $toggle = $hasChildren
                                ? 'data-bs-toggle="dropdown" role="button" aria-expanded="false"'
                                : '';

                            // li open
                            $html .= '<li class="' . e(trim($liClass)) . '">';

                            // anchor
                            $html .= '<a href="' . e($aHref) . '" class="' . e(trim($aClass)) . '" ' . $toggle . '>';
                            $html .= $iconHtml . e($item->title);
                            $html .= '</a>';

                            // children
                            if ($hasChildren) {
                                $ulClass = $depth === 0 ? 'dropdown-menu' : 'dropdown-menu'; // nested same class; প্রয়োজনে কাস্টমাইজ
                                $html .= '<ul class="' . $ulClass . '">';
                                $html .= $renderMenu($item->id, $depth + 1);
                                $html .= '</ul>';
                            }

                            // li close
                            $html .= '</li>';
                        }

                        return $html;
                    };
                @endphp

                {{-- ডাইনামিক মেনু আইটেমস --}}
                {!! $renderMenu(0, 0) !!}

                {{-- আপনার Auth-ভিত্তিক আইটেমগুলো --}}
                @auth
                    <li class="nav-item ms-lg-2">
                        <a href="{{ url('/dashboard') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    </li>
                @else
                    <li class="nav-item ms-lg-2">
                        <a href="{{ Route::has('login') ? route('login') : '#' }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="{{ Route::has('register') ? route('register') : '#' }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-person-plus me-1"></i> Register
                        </a>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>
