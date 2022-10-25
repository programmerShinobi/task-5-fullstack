@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Posts</h2>
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
                <br>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="publish-tab" data-bs-toggle="tab" data-bs-target="#publish-tab-pane" type="button" role="tab" aria-controls="publish-tab-pane" aria-selected="true"><em class="fa-solid fa-paper-plane"></em> Publish ({{ $publish }})</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="draft-tab" data-bs-toggle="tab" data-bs-target="#draft-tab-pane" type="button" role="tab" aria-controls="draft-tab-pane" aria-selected="true"><em class="fa-solid fa-sheet-plastic"></em> Draft ({{ $draft }})</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="trashed-tab" data-bs-toggle="tab" data-bs-target="#trashed-tab-pane" type="button" role="tab" aria-controls="trashed-tab-pane" aria-selected="true"><em class="fa-solid fa-trash"></em> Trashed ({{ $trash }})</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    @include('layouts._messages')
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="publish-tab-pane" role="tabpanel" aria-labelledby="publish-tab" tabindex="0">
                            @include('posts._tb_publish')
                        </div>
                        <div class="tab-pane fade" id="draft-tab-pane" role="tabpanel" aria-labelledby="draft-tab" tabindex="0">
                            @include('posts._tb_draft')
                        </div>
                        <div class="tab-pane fade" id="trashed-tab-pane" role="tabpanel" aria-labelledby="trashed-tab" tabindex="0">
                            @include('posts._tb_trash')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

