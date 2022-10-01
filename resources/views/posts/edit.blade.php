@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h1>
                            Edit Post
                        </h1>
                        <div class="ms-auto">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary"><em class="fa-solid fa-arrow-left"></em> Back</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        @include('posts._form', ['buttonText' => 'Update Post'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
