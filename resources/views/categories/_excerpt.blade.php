<div class="media post">
    <div class="media-body">
        <div class="d-flex align-items-center">
            <h3 class="mt-0"><a target="_blank" href="https://unsplash.com/s/photos/{{ $category->name }}">{!! $category->name !!}</a></h3>
            <div class="ms-auto">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    @can ('delete', $category)
                        <form class="form-delete" action="{{ route('categories.destroy', $category->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')"><em class="fa-solid fa-trash"></em> Delete</button>
                        </form>
                    @endcan
                    @can ('update', $category)
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-info"><em class="fa-solid fa-pen-to-square"></em> Edit</a>
                    @endcan

                </div>
            </div>
        </div>
        <p class="lead">
            Added by
            <span class="text-primary">{{ $category->user->name }}</span>
            <small class="text-muted">{{ $category->created_date }}</small>
        </p>
    </div>
</div>
