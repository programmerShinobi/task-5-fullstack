    <div class="media post">
        <div class="media-body">
            <div class="d-flex align-items-justify">
                <h3 class="mt-0"><a href="{{ $post3->url }}">{!! $post3->title !!}</a></h3>
                <div class="ms-auto">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <form class="form-delete me-md-2" action="{{ route('posts.destroy', $post3->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')"><em class="fa-solid fa-trash"></em> Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            <p class="lead">
                <small class="text-muted">{{ $post3->created_date }}</small>
            </p>
            <div class="excerpt text-justify">
                {!! Str::limit($post3->content_html, 250) !!}
            </div>
        </div>
    </div>
