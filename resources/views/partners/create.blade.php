@extends('layouts.adminlayout')
@section('maincontent')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Create Partner</h5>
                        <a href="{{ route('partners.index') }}" class="btn btn-light btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data">@csrf
                            @include('partners._form')
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success me-2">Save</button>
                                <a href="{{ route('partners.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
