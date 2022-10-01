@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Posts</h2>
                        @guest
                        @else
                            <div class="ms-auto">
                                <div class="nav-item dropdown">
                                    <button id="navbarDropdown" class="btn btn-outline-primary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        @if (url()->current()== route('posts.create'))
                                            <em class="fa-solid fa-plus"></em> Add Post
                                        @elseif (url()->current()== env('APP_URL')."/post")
                                            <em class="fa-solid fa-newspaper"></em> All Posts
                                        @elseif (url()->current()== route('home'))
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
                                        @if (url()->current() == env('APP_URL')."/post")
                                            <a href="{{ route('posts.create') }}" class="dropdown-item">
                                            <em class="fa-solid fa-plus"></em> Add Post</a>
                                            <a href="{{ env('APP_URL') }}" class="dropdown-item">
                                            <em class="fa-solid fa-paper-plane"></em> Preview</a>
                                            <a href="{{ route('categories.index') }}" class="dropdown-item">
                                            <em class="fa-solid fa-server"></em> All Categories</a>
                                        @elseif (url()->current() == route('categories.index'))
                                            <a href="{{ route('categories.create') }}" class="dropdown-item">
                                            <em class="fa-solid fa-plus"></em> Add Category</a>
                                            <a href="{{ env('APP_URL')."/post" }}" class="dropdown-item">
                                            <em class="fa-solid fa-newspaper"></em> All Posts</a>
                                        @else
                                            <a href="{{ env('APP_URL')."/post" }}" class="dropdown-item">
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
                            <input type="hidden" id="csrfViewPublish" value="{{ csrf_token() }}">
                            <div class="table-responsive">
                                <table class="table table-hover table-stripped " id="tablePostPublish">
                                    <thead>
                                        <tr>
                                            <th data-orderable="false">No</th>
                                            <th data-orderable="true">Title</th>
                                            <th data-orderable="true">Category</th>
                                            <th data-orderable="false">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="draft-tab-pane" role="tabpanel" aria-labelledby="draft-tab" tabindex="0">
                            <input type="hidden" id="csrfViewDraft" value="{{ csrf_token() }}">
                            <div class="table-responsive">
                                <table class="table table-hover table-stripped " id="tablePostDraft">
                                    <thead>
                                        <tr>
                                            <th data-orderable="false">No</th>
                                            <th data-orderable="true">Title</th>
                                            <th data-orderable="true">Category</th>
                                            <th data-orderable="false">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="trashed-tab-pane" role="tabpanel" aria-labelledby="trashed-tab" tabindex="0">
                            <input type="hidden" id="csrfViewTrash" value="{{ csrf_token() }}">
                            <div class="table-responsive">
                                <table class="table table-hover table-stripped " id="tablePostTrash">
                                    <thead>
                                        <tr>
                                            <th data-orderable="false">No</th>
                                            <th data-orderable="true">Title</th>
                                            <th data-orderable="true">Category</th>
                                            <th data-orderable="false">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
  <script>
    let data_publish = {
      _token: document.getElementById("csrfViewPublish").value
    };
    let data_draft = {
      _token: document.getElementById("csrfViewDraft").value
    };
    let data_trash = {
      _token: document.getElementById("csrfViewTrash").value
    };

    const tablePostPublish = getDataTableInput("tablePostPublish", "get-post-publish", data_publish);
    const tablePostDraft = getDataTableInput("tablePostDraft", "get-post-draft", data_draft);
    const tablePostTrash = getDataTableInput("tablePostTrash", "get-post-trash", data_trash);
  </script>
@endpush
