@extends('layouts.adminlayout')
@section('maincontent')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Create FAQ</h5>
                        <a href="{{ route('faqs.index') }}" class="btn btn-light btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('faqs.store') }}" method="POST">@csrf
                            @include('faqs._form')
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success me-2">Save</button>
                                <a href="{{ route('faqs.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
