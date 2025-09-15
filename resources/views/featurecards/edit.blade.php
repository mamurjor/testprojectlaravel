@extends('layouts.adminlayout')

@section('maincontent')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Feature</h5>
                        <a href="{{ route('featurecards.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left-circle me-1"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('featurecards.update', $featurecard) }}" method="POST">
                            @csrf @method('PUT')
                            @include('featurecards._form', ['featurecard' => $featurecard])
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success me-2"><i class="bi bi-save me-1"></i>Update</button>
                                <a href="{{ route('featurecards.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
