@extends('layouts.adminlayout')
@section('maincontent')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Partner</h5>
                        <a href="{{ route('partners.index') }}" class="btn btn-light btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('partners.update', $partner) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            @include('partners._form', ['partner' => $partner])
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success me-2">Update</button>
                                <a href="{{ route('partners.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
