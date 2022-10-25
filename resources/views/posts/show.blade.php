@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{ $post->title }}</h1>
                            <div class="ms-auto badge text-bg-dark">
                                <span class="lead text-warning">{{ $post->category }}</span>
                                Category
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="lead">
                                <small class="text-muted">{{ $post->created_date }}</small>
                            </span>
                            <div class="ms-auto">
                                <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary mr-1"><em class="fa-solid fa-arrow-left"></em> Back</a>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-dark"><em class="fa-solid fa-pen-to-square"></em> Edit</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="ms-auto">
                    </div>
                    <div class="text-justify">
                        <div class="media mt-3">
                            <div class="media-body">
                                {!! $post->content_html !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
