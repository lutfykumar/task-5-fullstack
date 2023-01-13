@extends('layouts.app')
@section('title', 'All Posts')
@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">All Posts <span class="float-end"><a href="{{ route('post.create') }}" type="button"
                        class="btn btn-sm btn-primary btn-create">New Post</a></span></div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Image</th>
                            <th>User</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($model as $v)
                            <tr>
                                <td>{{ $v->id }}</td>
                                <td>{{ $v->title }}</td>
                                <td>{{ Str::limit($v->content, 100, '...') }}</td>
                                <td><img src="{{ $v->image == 'article.png' ? asset($v->image) : asset('storage/' . $v->image) }}"
                                        class="img-thumbnail" style="height: 100px" alt="{{ $v->slug }}"></td>
                                <td>{{ $v->user->name }}</td>
                                <td>{{ $v->category->name }}</td>
                                <td>
                                    <a href="{{ route('post.show', $v->id) }}" type="button"
                                        class="btn btn-sm btn-info btn-detail m-1">Detail</a>
                                    <a href="{{ route('post.edit', $v->id) }}" type="button"
                                        class="btn btn-sm btn-success btn-edit m-1">Edit</a>
                                    <a href="{{ route('post.destroy', $v->id) }}" type="button"
                                        class="btn btn-sm btn-danger btn-delete m-1">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $model->links() !!}
            </div>
        </div>
    </div>
@endsection
