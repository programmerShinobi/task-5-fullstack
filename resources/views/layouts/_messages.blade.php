@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <em class="fa-solid fa-circle-info"></em>
        <strong>Success!</strong>&nbsp;{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <em class="fa-solid fa-circle-info"></em>
        <strong>Warning!</strong>&nbsp;{{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session('errors'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <em class="fa-solid fa-circle-info"></em>
        <strong>Failed!</strong>&nbsp;{{ session('errors') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
