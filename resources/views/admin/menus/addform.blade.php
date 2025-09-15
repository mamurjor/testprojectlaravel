@extends('layouts.adminlayout')



@section('content')
    <div class="container mt-4">
        <h2>{{ isset($menu) ? 'Edit Menu' : 'Create Menu' }}</h2>

        {{-- সাকসেস মেসেজ --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- সার্ভার-সাইড এরর --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="menuForm" action="{{ isset($menu) ? route('menus.update', $menu->id) : route('menus.store') }}"
            method="POST">
            @csrf
            @if (isset($menu))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label>Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $menu->title ?? '') }}"
                    required>
            </div>

            <div class="mb-3">
                <label>Icon (Optional)</label>
                <input type="text" name="icon" class="form-control" placeholder="fa fa-home"
                    value="{{ old('icon', $menu->icon ?? '') }}">
            </div>

            <div class="mb-3">
                <label>CSS Class (Optional)</label>
                <input type="text" name="class" class="form-control" placeholder="text-primary"
                    value="{{ old('class', $menu->class ?? '') }}">
            </div>

            <div class="mb-3">
                <label>Slug (Optional)</label>
                <input type="text" name="slug" class="form-control" placeholder="/about"
                    value="{{ old('slug', $menu->slug ?? '') }}">
            </div>

            <div class="mb-3">
                <label>Parent Menu</label>
                <select name="parent_id" class="form-control">
                    <option value="">-- None --</option>
                    @foreach ($menus as $parent)
                        <option value="{{ $parent->id }}"
                            {{ old('parent_id', $menu->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                            {{ $parent->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Order</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', $menu->order ?? 0) }}">
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($menu) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('menus.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#menuForm").validate({
                rules: {
                    title: {
                        required: true
                    },
                    order: {
                        number: true
                    }
                },
                messages: {
                    title: "Please enter menu title",
                    order: "Please enter a valid number"
                },
                errorElement: 'span',
                errorClass: 'text-danger',
                highlight: function(element, errorClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
