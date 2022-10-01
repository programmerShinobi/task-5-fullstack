@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h1>
                            Edit Category
                        </h1>
                        <div class="ms-auto">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary"><em class="fa-solid fa-arrow-left"></em>  Back</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        @include('categories._form', ['buttonText' => 'Update Category'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
