@extends('layouts.adminlayout')

@section('maincontent')
    <div class="main-content horizontal-content">
        <div class="container">

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-10 col-md-12 mx-auto">
                    <form action="{{ route('settingUpdate') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="card shadow-lg rounded-3">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">Project Settings</h4>
                            </div>
                            <div class="card-body">

                                {{-- Nav Tabs --}}
                                <ul class="nav nav-tabs mb-3" id="settingsTab" role="tablist">
                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#general"
                                            type="button">General</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#about"
                                            type="button">About Us</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#contact"
                                            type="button">Contact</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#social"
                                            type="button">Social</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#seo"
                                            type="button">SEO</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#smtp"
                                            type="button">SMTP & ENV</button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="settingsTabContent">

                                    {{-- STEP 1: General --}}
                                    <div class="tab-pane fade show active" id="general">
                                        <div class="mb-3">
                                            <label>App Title</label>
                                            <input type="text" name="APPTITLE" class="form-control"
                                                value="{{ old('APPTITLE', get_setting('APPTITLE')) }}">
                                        </div>



                                        <div class="mb-3">
                                            <label>APP_URL</label>
                                            <input type="text" name="APP_URL" class="form-control"
                                                value="{{ old('URL', get_setting('APP_URL')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>APP DEBUG</label>
                                            @php $enc = old('APP_DEBUG', get_setting('APP_DEBUG')); @endphp
                                            <select name="APP_DEBUG" class="form-control">
                                                <option value="true" {{ $enc == 'true' ? 'selected' : '' }}>TRUE
                                                </option>
                                                <option value="false" {{ $enc == 'false' ? 'selected' : '' }}>False
                                                </option>
                                                <option value="" {{ $enc == '' ? 'selected' : '' }}>None
                                                </option>
                                            </select>
                                        </div>


                                        {{-- General – Common Front/Back Settings --}}
                                        <div class="row g-3">
                                            {{-- Branding --}}
                                            <div class="col-md-6">
                                                <label>Site Name</label>
                                                <input type="text" name="SITE_NAME" class="form-control"
                                                    value="{{ old('SITE_NAME', get_setting('SITE_NAME')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Tagline</label>
                                                <input type="text" name="TAGLINE" class="form-control"
                                                    value="{{ old('TAGLINE', get_setting('TAGLINE')) }}">
                                            </div>

                                            {{-- URL / Contacts --}}
                                            <div class="col-md-6">
                                                <label>Website URL</label>
                                                <input type="text" name="URL" class="form-control"
                                                    value="{{ old('URL', get_setting('URL')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Admin Email</label>
                                                <input type="email" name="ADMIN_MAIL" class="form-control"
                                                    value="{{ old('ADMIN_MAIL', get_setting('ADMIN_MAIL')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Support Email</label>
                                                <input type="email" name="SUPPORT_MAIL" class="form-control"
                                                    value="{{ old('SUPPORT_MAIL', get_setting('SUPPORT_MAIL')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Sales Email</label>
                                                <input type="email" name="SALES_MAIL" class="form-control"
                                                    value="{{ old('SALES_MAIL', get_setting('SALES_MAIL')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Phone Number</label>
                                                <input type="text" name="CELL" class="form-control"
                                                    value="{{ old('CELL', get_setting('CELL')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>WhatsApp</label>
                                                <input type="text" name="WHATSAPP" class="form-control"
                                                    value="{{ old('WHATSAPP', get_setting('WHATSAPP')) }}"
                                                    placeholder="+8801xxxxxxxxx">
                                            </div>
                                            <div class="col-12">
                                                <label>Address</label>
                                                <textarea name="ADDRESS" class="form-control" rows="2">{{ old('ADDRESS', get_setting('ADDRESS')) }}</textarea>
                                            </div>
                                            <div class="col-12">
                                                <label>Google Map Embed (iframe)</label>
                                                <textarea name="MAP_EMBED" class="form-control" rows="2" placeholder="<iframe ...>">{{ old('MAP_EMBED', get_setting('MAP_EMBED')) }}</textarea>
                                            </div>



                                            {{-- Theme Colors --}}
                                            <div class="col-md-6">
                                                <label>Primary Color</label>
                                                <input type="text" name="PRIMARY_COLOR" class="form-control"
                                                    value="{{ old('PRIMARY_COLOR', get_setting('PRIMARY_COLOR')) }}"
                                                    placeholder="#0d6efd">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Secondary Color</label>
                                                <input type="text" name="SECONDARY_COLOR" class="form-control"
                                                    value="{{ old('SECONDARY_COLOR', get_setting('SECONDARY_COLOR')) }}"
                                                    placeholder="#6c757d">
                                            </div>

                                            {{-- Company Info --}}
                                            <div class="col-md-6">
                                                <label>Company Name</label>
                                                <input type="text" name="COMPANY_NAME" class="form-control"
                                                    value="{{ old('COMPANY_NAME', get_setting('COMPANY_NAME')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Company Reg. No</label>
                                                <input type="text" name="COMPANY_REG_NO" class="form-control"
                                                    value="{{ old('COMPANY_REG_NO', get_setting('COMPANY_REG_NO')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>TAX/VAT ID</label>
                                                <input type="text" name="TAX_ID" class="form-control"
                                                    value="{{ old('TAX_ID', get_setting('TAX_ID')) }}">
                                            </div>

                                            {{-- Locale / Currency --}}
                                            <div class="col-md-4">
                                                <label>Timezone</label>
                                                <input type="text" name="TIMEZONE" class="form-control"
                                                    value="{{ old('TIMEZONE', get_setting('TIMEZONE') ?? config('app.timezone')) }}"
                                                    placeholder="Asia/Dhaka">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Locale</label>
                                                <input type="text" name="LOCALE" class="form-control"
                                                    value="{{ old('LOCALE', get_setting('LOCALE') ?? app()->getLocale()) }}"
                                                    placeholder="en, bn">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Currency</label>
                                                <input type="text" name="CURRENCY" class="form-control"
                                                    value="{{ old('CURRENCY', get_setting('CURRENCY')) }}"
                                                    placeholder="BDT, USD">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Date Format</label>
                                                <input type="text" name="DATE_FORMAT" class="form-control"
                                                    value="{{ old('DATE_FORMAT', get_setting('DATE_FORMAT') ?? 'Y-m-d') }}"
                                                    placeholder="Y-m-d / d-m-Y">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Time Format</label>
                                                <input type="text" name="TIME_FORMAT" class="form-control"
                                                    value="{{ old('TIME_FORMAT', get_setting('TIME_FORMAT') ?? 'H:i') }}"
                                                    placeholder="H:i / h:i A">
                                            </div>

                                            {{-- SEO Defaults --}}
                                            <div class="col-md-6">
                                                <label>Default Meta Title</label>
                                                <input type="text" name="META_TITLE" class="form-control"
                                                    value="{{ old('META_TITLE', get_setting('META_TITLE')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Default Meta Description</label>
                                                <input type="text" name="META_DESCRIPTION" class="form-control"
                                                    value="{{ old('META_DESCRIPTION', get_setting('META_DESCRIPTION')) }}">
                                            </div>

                                            {{-- Analytics / Pixels --}}
                                            <div class="col-md-6">
                                                <label>Google Analytics (Measurement ID)</label>
                                                <input type="text" name="GA_MEASUREMENT_ID" class="form-control"
                                                    value="{{ old('GA_MEASUREMENT_ID', get_setting('GA_MEASUREMENT_ID')) }}"
                                                    placeholder="G-XXXXXXXXXX">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Facebook Pixel ID</label>
                                                <input type="text" name="FB_PIXEL_ID" class="form-control"
                                                    value="{{ old('FB_PIXEL_ID', get_setting('FB_PIXEL_ID')) }}"
                                                    placeholder="XXXXXXXXXXXXXXX">
                                            </div>

                                            {{-- App Controls --}}
                                            <div class="col-md-6">
                                                <label>Maintenance Mode</label>
                                                @php $mm = old('MAINTENANCE_MODE', get_setting('MAINTENANCE_MODE', 'OFF')); @endphp
                                                <select name="MAINTENANCE_MODE" class="form-control">
                                                    <option value="OFF" {{ $mm === 'OFF' ? 'selected' : '' }}>OFF
                                                    </option>
                                                    <option value="ON" {{ $mm === 'ON' ? 'selected' : '' }}>ON
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Copyright Text</label>
                                                <input type="text" name="COPYRIGHT_TEXT" class="form-control"
                                                    value="{{ old('COPYRIGHT_TEXT', get_setting('COPYRIGHT_TEXT') ?? '© ' . date('Y') . ' Your Company') }}">
                                            </div>
                                            <div class="col-12">
                                                <label>Cookie Consent Text</label>
                                                <textarea name="COOKIE_CONSENT_TEXT" class="form-control" rows="2">{{ old('COOKIE_CONSENT_TEXT', get_setting('COOKIE_CONSENT_TEXT')) }}</textarea>
                                            </div>
                                        </div>


                                        {{-- Logo --}}
                                        {{-- Banner --}}
                                        <div class="mb-3">
                                            <label class="form-label">Banner</label>
                                            <div class="d-flex align-items-center gap-3">
                                                <input type="file" id="bannerInput" name="BANNER"
                                                    class="form-control">
                                                <div>
                                                    <img id="bannerPreview"
                                                        src="{{ get_setting('BANNER') ? asset('uploads/' . get_setting('BANNER')) : asset('images/placeholder-banner.png') }}"
                                                        alt="Banner" height="100" class="border rounded">
                                                </div>
                                            </div>
                                            <small class="text-muted">Recommended size: 1200×400px (JPG/PNG)</small>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Logo</label>
                                            <div class="d-flex align-items-center gap-3">
                                                <input type="file" id="logoInput" name="LOGO"
                                                    class="form-control">
                                                <div>
                                                    <img id="logoPreview"
                                                        src="{{ get_setting('LOGO') ? asset('uploads/' . get_setting('LOGO')) : asset('images/placeholder-logo.png') }}"
                                                        alt="Logo" height="50" class="border rounded">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Favicon --}}
                                        <div class="mb-3">
                                            <label class="form-label">Favicon</label>
                                            <div class="d-flex align-items-center gap-3">
                                                <input type="file" id="faviconInput" name="FAVICON"
                                                    class="form-control">
                                                <div>
                                                    <img id="faviconPreview"
                                                        src="{{ get_setting('FAVICON') ? asset('uploads/' . get_setting('FAVICON')) : asset('images/placeholder-favicon.png') }}"
                                                        alt="Favicon" height="30" class="border rounded">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- About Us Step --}}
                                    <div class="tab-pane fade" id="about">
                                        <div class="row g-3">

                                            {{-- Section Heading --}}
                                            <div class="col-md-6">
                                                <label>About Heading</label>
                                                <input type="text" name="ABOUT_HEADING" class="form-control"
                                                    value="{{ old('ABOUT_HEADING', get_setting('ABOUT_HEADING')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>About Sub Heading</label>
                                                <input type="text" name="ABOUT_SUBHEADING" class="form-control"
                                                    value="{{ old('ABOUT_SUBHEADING', get_setting('ABOUT_SUBHEADING')) }}">
                                            </div>

                                            {{-- Main Description --}}
                                            <div class="col-12">
                                                <label>About Description</label>
                                                <textarea name="ABOUT_DESC" class="form-control" rows="4">{{ old('ABOUT_DESC', get_setting('ABOUT_DESC')) }}</textarea>
                                            </div>

                                            {{-- Mission / Vision / Values --}}
                                            <div class="col-md-4">
                                                <label>Mission</label>
                                                <textarea name="ABOUT_MISSION" class="form-control" rows="2">{{ old('ABOUT_MISSION', get_setting('ABOUT_MISSION')) }}</textarea>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Vision</label>
                                                <textarea name="ABOUT_VISION" class="form-control" rows="2">{{ old('ABOUT_VISION', get_setting('ABOUT_VISION')) }}</textarea>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Values</label>
                                                <textarea name="ABOUT_VALUES" class="form-control" rows="2">{{ old('ABOUT_VALUES', get_setting('ABOUT_VALUES')) }}</textarea>
                                            </div>

                                            {{-- Media --}}
                                            <div class="col-md-6">
                                                <label class="form-label d-block">About Image</label>
                                                <div class="d-flex align-items-center gap-3">
                                                    <input type="file" id="aboutImageInput" name="ABOUT_IMAGE"
                                                        class="form-control">
                                                    <img id="aboutImagePreview"
                                                        src="{{ get_setting('ABOUT_IMAGE') ? asset('uploads/' . get_setting('ABOUT_IMAGE')) : asset('images/placeholder-banner.png') }}"
                                                        alt="About Image" height="100" class="border rounded">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>About Video (YouTube/Vimeo Link)</label>
                                                <input type="text" name="ABOUT_VIDEO" class="form-control"
                                                    value="{{ old('ABOUT_VIDEO', get_setting('ABOUT_VIDEO')) }}">
                                            </div>

                                            {{-- Team Info --}}
                                            <div class="col-md-6">
                                                <label>Team Section Heading</label>
                                                <input type="text" name="ABOUT_TEAM_HEADING" class="form-control"
                                                    value="{{ old('ABOUT_TEAM_HEADING', get_setting('ABOUT_TEAM_HEADING')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Team Section Description</label>
                                                <input type="text" name="ABOUT_TEAM_DESC" class="form-control"
                                                    value="{{ old('ABOUT_TEAM_DESC', get_setting('ABOUT_TEAM_DESC')) }}">
                                            </div>

                                            {{-- Awards / History --}}
                                            <div class="col-md-6">
                                                <label>Awards / Certifications</label>
                                                <textarea name="ABOUT_AWARDS" class="form-control" rows="2">{{ old('ABOUT_AWARDS', get_setting('ABOUT_AWARDS')) }}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Company History</label>
                                                <textarea name="ABOUT_HISTORY" class="form-control" rows="2">{{ old('ABOUT_HISTORY', get_setting('ABOUT_HISTORY')) }}</textarea>
                                            </div>

                                        </div>
                                    </div>


                                    {{-- Contact Step --}}
                                    <div class="tab-pane fade" id="contact">
                                        <div class="row g-3">

                                            {{-- Company / Address --}}
                                            <div class="col-md-6">
                                                <label>Company Name</label>
                                                <input type="text" name="COMPANY_NAME" class="form-control"
                                                    value="{{ old('COMPANY_NAME', get_setting('COMPANY_NAME')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Contact Email</label>
                                                <input type="email" name="CONTACT_EMAIL" class="form-control"
                                                    value="{{ old('CONTACT_EMAIL', get_setting('CONTACT_EMAIL')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Phone Number 1</label>
                                                <input type="text" name="CONTACT_PHONE_1" class="form-control"
                                                    value="{{ old('CONTACT_PHONE_1', get_setting('CONTACT_PHONE_1')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Phone Number 2</label>
                                                <input type="text" name="CONTACT_PHONE_2" class="form-control"
                                                    value="{{ old('CONTACT_PHONE_2', get_setting('CONTACT_PHONE_2')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Fax (Optional)</label>
                                                <input type="text" name="CONTACT_FAX" class="form-control"
                                                    value="{{ old('CONTACT_FAX', get_setting('CONTACT_FAX')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>WhatsApp</label>
                                                <input type="text" name="CONTACT_WHATSAPP" class="form-control"
                                                    value="{{ old('CONTACT_WHATSAPP', get_setting('CONTACT_WHATSAPP')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Telegram</label>
                                                <input type="text" name="CONTACT_TELEGRAM" class="form-control"
                                                    value="{{ old('CONTACT_TELEGRAM', get_setting('CONTACT_TELEGRAM')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Messenger</label>
                                                <input type="text" name="CONTACT_MESSENGER" class="form-control"
                                                    value="{{ old('CONTACT_MESSENGER', get_setting('CONTACT_MESSENGER')) }}">
                                            </div>
                                            <div class="col-12">
                                                <label>Address</label>
                                                <textarea name="CONTACT_ADDRESS" class="form-control" rows="2">{{ old('CONTACT_ADDRESS', get_setting('CONTACT_ADDRESS')) }}</textarea>
                                            </div>

                                            {{-- Map --}}
                                            <div class="col-12">
                                                <label>Google Map Embed</label>
                                                <textarea name="CONTACT_MAP" class="form-control" rows="2" placeholder="<iframe ...>">{{ old('CONTACT_MAP', get_setting('CONTACT_MAP')) }}</textarea>
                                                <small class="text-muted">Paste your Google Maps iframe embed code
                                                    here</small>
                                            </div>

                                            {{-- Contact Page Heading/Description --}}
                                            <div class="col-md-6">
                                                <label>Contact Heading</label>
                                                <input type="text" name="CONTACT_HEADING" class="form-control"
                                                    value="{{ old('CONTACT_HEADING', get_setting('CONTACT_HEADING')) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Working Hours</label>
                                                <input type="text" name="CONTACT_HOURS" class="form-control"
                                                    value="{{ old('CONTACT_HOURS', get_setting('CONTACT_HOURS')) }}"
                                                    placeholder="Mon - Fri: 9AM - 6PM">
                                            </div>
                                            <div class="col-12">
                                                <label>Contact Description</label>
                                                <textarea name="CONTACT_DESC" class="form-control" rows="3">{{ old('CONTACT_DESC', get_setting('CONTACT_DESC')) }}</textarea>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- STEP 2: Social --}}
                                    <div class="tab-pane fade" id="social">
                                        <div class="mb-3">
                                            <label>Facebook</label>
                                            <input type="text" name="FACEBOOK" class="form-control"
                                                value="{{ old('FACEBOOK', get_setting('FACEBOOK')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Twitter / X</label>
                                            <input type="text" name="TWITTER" class="form-control"
                                                value="{{ old('TWITTER', get_setting('TWITTER')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Instagram</label>
                                            <input type="text" name="INSTAGRAM" class="form-control"
                                                value="{{ old('INSTAGRAM', get_setting('INSTAGRAM')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>LinkedIn</label>
                                            <input type="text" name="LINKEDIN" class="form-control"
                                                value="{{ old('LINKEDIN', get_setting('LINKEDIN')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>YouTube</label>
                                            <input type="text" name="YOUTUBE" class="form-control"
                                                value="{{ old('YOUTUBE', get_setting('YOUTUBE')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Pinterest</label>
                                            <input type="text" name="PINTEREST" class="form-control"
                                                value="{{ old('PINTEREST', get_setting('PINTEREST')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Snapchat</label>
                                            <input type="text" name="SNAPCHAT" class="form-control"
                                                value="{{ old('SNAPCHAT', get_setting('SNAPCHAT')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>TikTok</label>
                                            <input type="text" name="TIKTOK" class="form-control"
                                                value="{{ old('TIKTOK', get_setting('TIKTOK')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Reddit</label>
                                            <input type="text" name="REDDIT" class="form-control"
                                                value="{{ old('REDDIT', get_setting('REDDIT')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Tumblr</label>
                                            <input type="text" name="TUMBLR" class="form-control"
                                                value="{{ old('TUMBLR', get_setting('TUMBLR')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>GitHub</label>
                                            <input type="text" name="GITHUB" class="form-control"
                                                value="{{ old('GITHUB', get_setting('GITHUB')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Dribbble</label>
                                            <input type="text" name="DRIBBBLE" class="form-control"
                                                value="{{ old('DRIBBBLE', get_setting('DRIBBBLE')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Behance</label>
                                            <input type="text" name="BEHANCE" class="form-control"
                                                value="{{ old('BEHANCE', get_setting('BEHANCE')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>WhatsApp</label>
                                            <input type="text" name="WHATSAPP" class="form-control"
                                                value="{{ old('WHATSAPP', get_setting('WHATSAPP')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Telegram</label>
                                            <input type="text" name="TELEGRAM" class="form-control"
                                                value="{{ old('TELEGRAM', get_setting('TELEGRAM')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Discord</label>
                                            <input type="text" name="DISCORD" class="form-control"
                                                value="{{ old('DISCORD', get_setting('DISCORD')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Slack</label>
                                            <input type="text" name="SLACK" class="form-control"
                                                value="{{ old('SLACK', get_setting('SLACK')) }}">
                                        </div>
                                    </div>


                                    {{-- STEP 3: SEO --}}
                                    <div class="tab-pane fade" id="seo">
                                        <div class="mb-3">
                                            <label>Meta Title</label>
                                            <input type="text" name="META_TITLE" class="form-control"
                                                value="{{ old('META_TITLE', get_setting('META_TITLE')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Meta Keywords</label>
                                            <input type="text" name="META_KEYWORDS" class="form-control"
                                                value="{{ old('META_KEYWORDS', get_setting('META_KEYWORDS')) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Meta Description</label>
                                            <textarea name="META_DESCRIPTION" class="form-control" rows="3">{{ old('META_DESCRIPTION', get_setting('META_DESCRIPTION')) }}</textarea>
                                        </div>
                                    </div>

                                    {{-- STEP 4: SMTP + ENV --}}
                                    <div class="tab-pane fade" id="smtp">
                                        <fieldset class="border rounded p-3 mb-4">
                                            <legend class="w-auto px-2 small text-muted">SMTP</legend>
                                            <div class="mb-3">
                                                <label>Mail Host</label>
                                                <input type="text" name="MAIL_MAILER" class="form-control"
                                                    value="{{ old('MAIL_MAILER', get_setting('MAIL_MAILER')) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label>MAIL PORT</label>
                                                <input type="text" name="MAIL_PORT" class="form-control"
                                                    value="{{ old('MAIL_PORT', get_setting('MAIL_PORT')) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label>Mail Port</label>
                                                <input type="text" name="MAIL_PORT" class="form-control"
                                                    value="{{ old('MAIL_PORT', get_setting('MAIL_PORT')) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label>Mail Username</label>
                                                <input type="text" name="MAIL_USERNAME" class="form-control"
                                                    value="{{ old('MAIL_USERNAME', get_setting('MAIL_USERNAME')) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label>Mail Password</label>
                                                <input type="password" name="MAIL_PASSWORD" class="form-control"
                                                    value="{{ old('MAIL_PASSWORD', get_setting('MAIL_PASSWORD')) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label>Mail Encryption</label>
                                                @php $enc = old('MAIL_ENCRYPTION', get_setting('MAIL_ENCRYPTION')); @endphp
                                                <select name="MAIL_ENCRYPTION" class="form-control">
                                                    <option value="tls" {{ $enc == 'tls' ? 'selected' : '' }}>TLS
                                                    </option>
                                                    <option value="ssl" {{ $enc == 'ssl' ? 'selected' : '' }}>SSL
                                                    </option>
                                                    <option value="" {{ $enc == '' ? 'selected' : '' }}>None
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label>From Address</label>
                                                <input type="email" name="MAIL_FROM" class="form-control"
                                                    value="{{ old('MAIL_FROM', get_setting('MAIL_FROM')) }}">
                                            </div>
                                        </fieldset>

                                        <fieldset class="border rounded p-3">
                                            <legend class="w-auto px-2 small text-muted">.ENV (Database & Pusher)</legend>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label>DB_CONNECTION</label>
                                                    <input type="text" name="DB_CONNECTION" class="form-control"
                                                        value="{{ old('DB_CONNECTION', env('DB_CONNECTION')) }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>DB_HOST</label>
                                                    <input type="text" name="DB_HOST" class="form-control"
                                                        value="{{ old('DB_HOST', env('DB_HOST')) }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>DB_PORT</label>
                                                    <input type="text" name="DB_PORT" class="form-control"
                                                        value="{{ old('DB_PORT', env('DB_PORT')) }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>DB_DATABASE</label>
                                                    <input type="text" name="DB_DATABASE" class="form-control"
                                                        value="{{ old('DB_DATABASE', env('DB_DATABASE')) }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>DB_USERNAME</label>
                                                    <input type="text" name="DB_USERNAME" class="form-control"
                                                        value="{{ old('DB_USERNAME', env('DB_USERNAME')) }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>DB_PASSWORD</label>
                                                    <input type="password" name="DB_PASSWORD" class="form-control"
                                                        value="{{ old('DB_PASSWORD') }}">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label>PUSHER_APP_ID</label>
                                                    <input type="text" name="PUSHER_APP_ID" class="form-control"
                                                        value="{{ old('PUSHER_APP_ID', env('PUSHER_APP_ID')) }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>PUSHER_APP_KEY</label>
                                                    <input type="text" name="PUSHER_APP_KEY" class="form-control"
                                                        value="{{ old('PUSHER_APP_KEY', env('PUSHER_APP_KEY')) }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>PUSHER_APP_SECRET</label>
                                                    <input type="password" name="PUSHER_APP_SECRET" class="form-control"
                                                        value="{{ old('PUSHER_APP_SECRET') }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label>PUSHER_HOST</label>
                                                    <input type="text" name="PUSHER_HOST" class="form-control"
                                                        value="{{ old('PUSHER_HOST', env('PUSHER_HOST')) }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label>PUSHER_PORT</label>
                                                    <input type="text" name="PUSHER_PORT" class="form-control"
                                                        value="{{ old('PUSHER_PORT', env('PUSHER_PORT', 443)) }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label>PUSHER_SCHEME</label>
                                                    <input type="text" name="PUSHER_SCHEME" class="form-control"
                                                        value="{{ old('PUSHER_SCHEME', env('PUSHER_SCHEME', 'https')) }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label>PUSHER_APP_CLUSTER</label>
                                                    <input type="text" name="PUSHER_APP_CLUSTER" class="form-control"
                                                        value="{{ old('PUSHER_APP_CLUSTER', env('PUSHER_APP_CLUSTER', 'mt1')) }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label>RECAPTCHA SITE_KEY</label>
                                                    <input type="text" name="RECAPTCHA_SITE_KEY" class="form-control"
                                                        value="{{ old('RECAPTCHA_SITE_KEY', env('RECAPTCHA_SITE_KEY', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI')) }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label>RECAPTCHA SECRET KEY</label>
                                                    <input type="text" name="RECAPTCHA_SECRET_KEY"
                                                        class="form-control"
                                                        value="{{ old('RECAPTCHA_SECRET_KEY', env('RECAPTCHA_SECRET_KEY', '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe')) }}">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label>RECAPTCHA VERSION</label>
                                                    <input type="text" name="RECAPTCHA_VERSION" class="form-control"
                                                        value="{{ old('RECAPTCHA_VERSION', env('RECAPTCHA_VERSION', 'v3')) }}">
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="mt-4 d-grid">
                                    <button class="btn btn-success" type="submit">Save Settings</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            function readURL(input, previewId) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#' + previewId).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('#logoInput').on('change', function() {
                readURL(this, 'logoPreview');
            });
            $('#faviconInput').on('change', function() {
                readURL(this, 'faviconPreview');
            });


            $('#bannerInput').on('change', function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#bannerPreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endpush


@push('styles')
    {{-- Summernote CSS (Bootstrap 5 compatible build) --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        /* ফোকাস স্টাইল একটু সফট করা */
        .note-editor.note-frame {
            border-radius: .5rem;
            overflow: hidden;
        }
    </style>
@endpush

@push('script')
    {{-- jQuery প্রয়োজন (আপনার প্রজেক্টে আগে থেকেই আছে মনে হচ্ছে) --}}
    {{-- Summernote JS --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <script>
        $(function() {
            // সব .wysi টেক্সটারিয়াকে Summernote বানাই
            $('.wysi').summernote({
                placeholder: 'Write here...',
                height: 240,
                minHeight: 160,
                maxHeight: null,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']], // ছবি/ভিডিও ইউআরএল এমবেড সাপোর্ট
                    ['view', ['codeview', 'help']]
                ],
                callbacks: {
                    onPaste: function(e) {
                        // বড় ইমেজ পেস্ট হলে সাইজ কমাতে চাইলে এখানে হ্যান্ডেল করতে পারেন
                    }
                }
            });

            // About image preview
            $('#aboutImageInput').on('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = e => $('#aboutImagePreview').attr('src', e.target.result);
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endpush
