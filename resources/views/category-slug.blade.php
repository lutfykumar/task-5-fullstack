@extends('layouts.app')
@section('title', 'Home')
@section('content')
    @include('partials.header', [
        'title' => $category->name,
        'subtitle' => 'Virtual Internship Experience (Investree) - Fullstack',
    ])
    <div class="container">
        <div class="row">
            @foreach ($model as $key => $v)
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="card mb-4">
                        <a href="{{ url('p/' . $v->slug) }}"><img class="card-img-top"
                                src="{{ $v->image == 'article.png' ? asset($v->image) : asset('storage/' . $v->image) }}"
                                alt="{{ $v->slug }}"
                                style="height: 300px;object-position: center;object-fit: cover;" /></a>
                        <div class="card-body">
                            <div class="small text-muted">{{ date('l, d F Y', strtotime($v->updated_at)) }}</div>
                            <h2 class="card-title">{{ Str::title($v->title) }}</h2>
                            <p class="card-text">{{ Str::limit($v->content, '200', '...') }}</p>
                            <a class="btn btn-primary" href="{{ url('p/' . $v->slug) }}">Read more →</a>
                        </div>
                    </div>
                </div>
            @endforeach
            {!! $model->links() !!}
        </div>
    </div>
    @include('partials.footer')
@endsection
