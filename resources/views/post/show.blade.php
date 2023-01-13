@extends('layouts.app')
@section('title', 'Detail Post')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5 ">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detail Post</div>

                    <div class="card-body">
                        <div class="col-12 mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                value="{{ $model->title }}" name="title" disabled>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" placeholder="Enter..." id="content"
                                id="content" name="content" disabled style="height: 100px">{{ $model->content }}</textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="image" class="form-label">Image</label><br>
                            <img src="{{ $model->image == 'article.png' ? asset($model->image) : asset('storage/' . $model->image) }}"
                                class="img-thumbnail mt-2" style="height: 100px" alt="{{ $model->slug }}">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror"
                                id="category" value="{{ $model->category->name }}" name="category" disabled>
                        </div>
                        <div class="col-12">
                            <a href="{{ route('post.index') }}" type="button" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
