@extends('layouts.app')
@section('title', 'Home')
@section('content')
    @include('partials.header', [
        'title' => 'Welcome to Blog Home!',
        'subtitle' => 'Virtual Internship Experience (Investree) - Fullstack',
    ])
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                @php
                    $postOne = [];
                    $postTwo = [];
                @endphp
                @foreach ($model as $key => $v)
                    @if ($key == 0)
                        <div class="card mb-4">
                            <a href="{{ url('p/' . $v->slug) }}"><img class="card-img-top"
                                    src="{{ $v->image == 'article.png' ? asset($v->image) : asset('storage/' . $v->image) }}"
                                    alt="{{ $v->slug }}"
                                    style="height: 300px;object-position: center;object-fit: cover;" /></a>
                            <div class="card-body">
                                <div class="small text-muted">{{ date('l, d F Y', strtotime($v->updated_at)) }}</div>
                                <h2 class="card-title">{{ Str::title($v->title) }}</h2>
                                <p class="card-text">{{ Str::limit($v->content, '300', '...') }}</p>
                                <a class="btn btn-primary" href="{{ url('p/' . $v->slug) }}">Read more →</a>
                            </div>
                        </div>
                    @else
                        @php
                            if ($v->image == 'article.png') {
                                $imageUrl = asset($v->image);
                            } else {
                                $imageUrl = asset('storage/' . $v->image);
                            }
                            if ($key % 2 == 0) {
                                $postOne[] =
                                    '<div class="card mb-4">
                            <a href="' .
                                    url('p/' . $v->slug) .
                                    '"><img class="card-img-top"
                                    src="' .
                                    $imageUrl .
                                    '" alt="' .
                                    $v->slug .
                                    '"  style="height: 200px;object-position: center;object-fit: cover;"/></a>
                            <div class="card-body">
                                <div class="small text-muted">' .
                                    date('l, d F Y', strtotime($v->updated_at)) .
                                    '</div>
                                <h2 class="card-title h4">' .
                                    Str::title($v->title) .
                                    '</h2>
                                <p class="card-text">' .
                                    Str::limit($v->content, '200', '...') .
                                    '</p>
                                <a class="btn btn-primary" href="' .
                                    url('p/' . $v->slug) .
                                    '">Read more →</a>
                            </div>
                        </div>';
                            } else {
                                $postTwo[] =
                                    '<div class="card mb-4">
                            <a href="' .
                                    url('p/' . $v->slug) .
                                    '"><img class="card-img-top"
                                    src="' .
                                    $imageUrl .
                                    '" alt="' .
                                    $v->slug .
                                    '"  style="height: 200px;object-position: center;object-fit: cover;" /></a>
                            <div class="card-body">
                                <div class="small text-muted">' .
                                    date('l, d F Y', strtotime($v->updated_at)) .
                                    '</div>
                                <h2 class="card-title h4">' .
                                    Str::title($v->title) .
                                    '</h2>
                                <p class="card-text">' .
                                    Str::limit($v->content, '200', '...') .
                                    '</p>
                                <a class="btn btn-primary" href="' .
                                    url('p/' . $v->slug) .
                                    '">Read more →</a>
                            </div>
                        </div>';
                            }
                        @endphp
                    @endif
                @endforeach
                @php
                    // dd($postOne);
                @endphp
                <!-- Nested row for non-featured blog posts-->
                <div class="row">
                    <div class="col-lg-6">
                        @for ($i = 0; $i < count($postOne); $i++)
                            {!! $postOne[$i] !!}
                        @endfor
                    </div>
                    <div class="col-lg-6">
                        @for ($i = 0; $i < count($postTwo); $i++)
                            {!! $postTwo[$i] !!}
                        @endfor
                    </div>
                </div>
                {!! $model->links() !!}
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">Search</div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate action="{{ route('post.search') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @error('keyword')
                                <div class="alert alert-danger mb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <div class="input-group">
                                <input class="form-control @error('keyword') is-invalid @enderror" type="text"
                                    placeholder="Enter search term..." aria-label="Enter search term..."
                                    aria-describedby="button-search" name="keyword" />
                                <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    @for ($i = 0; $i < count($cat_one); $i++)
                                        <li><a href="{{ $cat_one[$i]['link'] }}">{{ $cat_one[$i]['name'] }}</a></li>
                                    @endfor
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    @for ($i = 0; $i < count($cat_one); $i++)
                                        <li><a href="{{ $cat_one[$i]['link'] }}">{{ $cat_one[$i]['name'] }}</a></li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Side widget-->
                <div class="card mb-4">
                    <div class="card-header">Alert</div>
                    <div class="card-body">Last Exercise</div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
@endsection
