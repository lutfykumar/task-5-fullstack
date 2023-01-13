@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">{{ Str::title($model->title) }}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Posted on
                            {{ date('l, d F Y', strtotime($model->updated_at)) }}
                            by {{ $model->user->name }}</div>
                        <!-- Post categories-->
                        <a class="badge bg-secondary text-decoration-none link-light"
                            href="#!">{{ $model->category->name }}</a>
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded"
                            src="{{ $model->image == 'article.png' ? asset($model->image) : asset('storage/' . $model->image) }}"
                            alt="{{ $model->slug }}" /></figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        {!! $model->content !!}
                    </section>
                </article>
            </div>
        </div>
    </div>
    @include('partials.footer')
@endsection
