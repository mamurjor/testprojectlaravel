@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container">
        <h3 class="mb-3">হিরো সেকশন তৈরি</h3>



        <form id="heroForm" action="{{ route('slides.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">শিরোনাম *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">সাবটাইটেল</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}">
                    @error('subtitle')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">ব্যাজ টেক্সট</label>
                    <input type="text" name="badge_text" class="form-control" value="{{ old('badge_text') }}">
                    @error('badge_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">ব্যাজ আইকন</label>
                    <input type="text" name="badge_icon" class="form-control" value="{{ old('badge_icon') }}"
                        placeholder="e.g. ph:star">
                    @error('badge_icon')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">সোর্ট অর্ডার *</label>
                    <input type="number" min="0" name="sort_order" class="form-control"
                        value="{{ old('sort_order', 0) }}" required>
                    @error('sort_order')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">বোতাম ১ টেক্সট</label>
                    <input type="text" name="btn1_text" class="form-control" value="{{ old('btn1_text') }}">
                    @error('btn1_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">বোতাম ১ লিংক</label>
                    <input type="url" name="btn1_url" class="form-control" value="{{ old('btn1_url') }}"
                        placeholder="https://...">
                    @error('btn1_url')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">বোতাম ২ টেক্সট</label>
                    <input type="text" name="btn2_text" class="form-control" value="{{ old('btn2_text') }}">
                    @error('btn2_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">বোতাম ২ লিংক</label>
                    <input type="url" name="btn2_url" class="form-control" value="{{ old('btn2_url') }}"
                        placeholder="https://...">
                    @error('btn2_url')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">ইমেজ *</label>
                    <input type="file" name="image_path" class="form-control" accept=".jpg,.jpeg,.png,.webp" required>
                    @error('image_path')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                            {{ old('is_active') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">সক্রিয়</label>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary" type="submit">সংরক্ষণ করুন</button>
                <a class="btn btn-secondary" href="{{ route('slides.index') }}">তালিকায় যান</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js" crossorigin="anonymous">
    </script>

    <script>
        $(function() {
            $.validator.addMethod("validUrlOrEmpty", function(value) {
                if ($.trim(value) === "") return true;
                try {
                    new URL(value);
                    return true;
                } catch (e) {
                    return false;
                }
            }, "দয়া করে সঠিক URL দিন");

            $.validator.addMethod('filesize', function(value, element, param) {
                if (element.files.length === 0) return true;
                return element.files[0].size <= param;
            }, 'ফাইল সাইজ খুব বড় (সর্বোচ্চ 2MB)');

            $("#heroForm").validate({
                rules: {
                    title: {
                        required: true,
                        maxlength: 255
                    },
                    subtitle: {
                        maxlength: 255
                    },
                    badge_text: {
                        maxlength: 100
                    },
                    badge_icon: {
                        maxlength: 100
                    },
                    btn1_text: {
                        maxlength: 100
                    },
                    btn1_url: {
                        validUrlOrEmpty: true,
                        maxlength: 255
                    },
                    btn2_text: {
                        maxlength: 100
                    },
                    btn2_url: {
                        validUrlOrEmpty: true,
                        maxlength: 255
                    },
                    image: {
                        required: true,
                        extension: "jpg|jpeg|png|webp",
                        filesize: 2 * 1024 * 1024
                    },
                    sort_order: {
                        required: true,
                        digits: true,
                        min: 0,
                        max: 999999
                    }
                },
                messages: {
                    title: {
                        required: "শিরোনাম প্রয়োজন",
                        maxlength: "সর্বোচ্চ 255 অক্ষর"
                    },
                    image: {
                        required: "ইমেজ প্রয়োজন",
                        extension: "শুধু jpg, jpeg, png, webp"
                    },
                    sort_order: {
                        required: "সোর্ট অর্ডার প্রয়োজন",
                        digits: "শুধু নাম্বার দিন",
                        min: "ন্যূনতম 0",
                        max: "খুব বড় সংখ্যা"
                    }
                },
                errorElement: "small",
                errorClass: "text-danger",
                highlight: function(el) {
                    $(el).addClass("is-invalid");
                },
                unhighlight: function(el) {
                    $(el).removeClass("is-invalid");
                }
            });
        });
    </script>
@endpush
