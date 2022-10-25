    <div class="media post">
        <div class="media-body">
            <div class="d-flex align-items-justify">
                <h3 class="mt-0"><a href="{{ $post1->url }}">{!! $post1->title !!}</a></h3>
                <div class="ms-auto">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('posts.edit', $post1->id) }}" class="btn btn-sm btn-outline-info"><em class="fa-solid fa-pen-to-square"></em> Edit</a>
                    </div>
                </div>
            </div>
            <p class="lead">
                <small class="text-muted">{{ $post1->created_date }}</small>
            </p>
            <div class="excerpt text-justify">
                {!! Str::limit($post1->content_html, 250) !!}
            </div>
        </div>
    </div>
