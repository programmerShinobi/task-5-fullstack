@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Add Post</h2>
                        <div class="ms-auto">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary"><em class="fa-solid fa-arrow-left"></em> Back</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                   <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                        @include('posts._form', ['buttonText' => 'Add Post'])
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
