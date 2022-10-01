    <div class="media post">
        <div class="media-body">
            <div class="d-flex align-items-justify">
                <h3 class="mt-0"><a href="{{ $post1->url }}">{!! $post1->title !!}</a></h3>
                <div class="ms-auto">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        @can ('update', $post1)
                            <a href="{{ route('posts.edit', $post1->id) }}" class="btn btn-sm btn-outline-info"><em class="fa-solid fa-pen-to-square"></em> Edit</a>
                        @endcan
                    </div>
                </div>
            </div>
            <p class="lead">
                Added by
                <span class="text-primary">{{ $post1->user->name }}</span>
                <small class="text-muted">{{ $post1->created_date }}</small>
            </p>
            <img src="/upload/post/{{$post1->image}}" height="500px" class="card-img mb-4" alt="...">
            <div class="excerpt text-justify">
                {!! Str::limit($post1->content_html, 250) !!}
            </div>
        </div>
    </div>