@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h3>{{ $title }}</h3>
                @if ($ok)
                    <p>Thanks for confirming! You’ll now receive our updates.</p>
                @else
                    <p>Please try subscribing again.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
