@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Preview</h2>
                        <div class="ms-auto">
                            <div class="nav-item dropdown">
                                <button id="navbarDropdown" class="btn btn-outline-primary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <em class="fa-solid fa-list"></em> Posts
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('posts.index') }}" class="dropdown-item">
                                    <em class="fa-solid fa-newspaper"></em> All Posts</a>

                                    <a href="{{ route('posts.create') }}" class="dropdown-item">
                                    <em class="fa-solid fa-plus"></em> Add Post</a>

                                    <a href="{{ env('APP_URL') }}" class="dropdown-item">
                                    <em class="fa-solid fa-paper-plane"></em> Preview</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @forelse ($posts as $post)
                        @if ($post->status == "publish")
                            @include('posts._preview')
                        @endif
                        @empty
                            <div class="alert alert-warning">
                                <strong>Sorry</strong> There are no posts available.
                            </div>
                    @endforelse
                    <div class="mx-auto">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
