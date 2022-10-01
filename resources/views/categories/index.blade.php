@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Categories</h2>
                        @guest
                        @else
                            <div class="ms-auto">
                                <div class="nav-item dropdown">
                                    <button id="navbarDropdown" class="btn btn-outline-primary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        @if (url()->current()== route('posts.create'))
                                            <em class="fa-solid fa-plus"></em> Add Post
                                        @elseif (url()->current()== route('posts.index') || url()->current()== route('home'))
                                            <em class="fa-solid fa-newspaper"></em> All Posts
                                        @elseif (url()->current()== route('categories.create'))
                                            <em class="fa-solid fa-plus"></em> Add Category
                                        @elseif (url()->current()== route('categories.index'))
                                            <em class="fa-solid fa-newspaper"></em> All Categories
                                        @elseif (url()->current()== env('APP_URL'))
                                            <em class="fa-solid fa-paper-plane"></em> Preview
                                        @endif
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        @if (url()->current() == route('posts.index') || url()->current() == route('home'))
                                            <a href="{{ route('posts.create') }}" class="dropdown-item">
                                            <em class="fa-solid fa-plus"></em> Add Post</a>
                                            <a href="{{ env('APP_URL') }}" class="dropdown-item">
                                            <em class="fa-solid fa-paper-plane"></em> Preview</a>
                                            <a href="{{ route('categories.index') }}" class="dropdown-item">
                                            <em class="fa-solid fa-server"></em> All Categories</a>
                                        @elseif (url()->current() == route('categories.index'))
                                            <a href="{{ route('categories.create') }}" class="dropdown-item">
                                            <em class="fa-solid fa-plus"></em> Add Category</a>
                                            <a href="{{ route('home') }}" class="dropdown-item">
                                            <em class="fa-solid fa-newspaper"></em> All Posts</a>
                                        @else
                                            <a href="{{ route('home') }}" class="dropdown-item">
                                            <em class="fa-solid fa-newspaper"></em> All Posts</a>
                                            <a href="{{ route('categories.index') }}" class="dropdown-item">
                                            <em class="fa-solid fa-server"></em> All Categories</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    @include('layouts._messages')

                    @forelse ($categories as $category)
                        @include('categories._excerpt')
                        @empty
                            <div class="alert alert-warning">
                                <strong>Sorry</strong> There are no categories available.
                            </div>
                    @endforelse

                   <div class="mx-auto">
                       {{ $categories->links() }}
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
