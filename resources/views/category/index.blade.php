@extends('layouts.app')
@section('title', 'All Categories')
@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">All Categories <span class="float-end"><a href="{{ route('category.create') }}"
                        type="button" class="btn btn-sm btn-primary btn-create">New Category</a></span></div>

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
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($model as $v)
                            <tr>
                                <td>{{ $v->id }}</td>
                                <td>{{ $v->name }}</td>
                                <td>{{ $v->slug }}</td>
                                <td>
                                    <a href="{{ route('category.show', $v->id) }}" type="button"
                                        class="btn btn-sm btn-info btn-detail m-1">Detail</a>
                                    <a href="{{ route('category.edit', $v->id) }}" type="button"
                                        class="btn btn-sm btn-success btn-edit m-1">Edit</a>
                                    <a href="{{ route('category.destroy', $v->id) }}" type="button"
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
