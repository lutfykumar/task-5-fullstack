@extends('layouts.app')
@section('name', 'Detail Category')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5 ">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detail Category</div>

                    <div class="card-body">
                        <div class="col-12 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                value="{{ $model->name }}" name="name" disabled>
                        </div>
                        <div class="col-12">
                            <a href="{{ route('category.index') }}" type="button" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
