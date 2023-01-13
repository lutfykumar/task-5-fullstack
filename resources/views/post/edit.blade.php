@extends('layouts.app')
@section('title', 'Edit Post')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5 ">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Post</div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" novalidate action="{{ route('post.update', $model->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" value="{{ $model->title }}" name="title" required>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" placeholder="Enter..." id="content"
                                    id="content" name="content" required style="height: 100px">{{ $model->content }}</textarea>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="image" class="form-label">Image</label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file"
                                    accept="image/*" id="image" name="image">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <img src="{{ $model->image == 'article.png' ? asset($model->image) : asset('storage/' . $model->image) }}"
                                    class="img-thumbnail mt-2" style="height: 100px" alt="{{ $model->slug }}">
                            </div>
                            <div class="col-12">
                                <label for="category_id" class="form-label">Choose Category</label>
                                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                                    name="category_id" required>
                                    <option selected>Choose One</option>
                                    @foreach ($category as $i)
                                        @php
                                            if ($i->id == $model->category_id) {
                                                $addSelected = 'selected';
                                            } else {
                                                $addSelected = '';
                                            }
                                        @endphp
                                        <option value="{{ $i->id }}" {{ $addSelected }}>{{ $i->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
