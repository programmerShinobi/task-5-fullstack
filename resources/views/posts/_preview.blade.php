    <div class="media post">
        <div class="media-body">
            <div class="d-flex align-items-justify">
                <h3 class="mt-0"><a href="{{ $post->url }}">{!! $post->title !!}</a></h3>
                <div class="ms-auto">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        @can ('update', $post)
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-dark m-1"><em class="fa-solid fa-pen-to-square"></em> Edit</a>
                        @endcan
                    </div>
                </div>
            </div>
            <p class="lead">
                Added by
                <span class="text-primary">{{ $post->user->name }}</span>
                <small class="text-muted">{{ $post->created_date }}</small>
            </p>
            <img src="/upload/post/{{$post->image}}" height="500px" class="card-img mb-4" alt="...">
            <div class="excerpt text-justify">
                {!! Str::limit($post->content_html, 250) !!}
            </div>
        </div>
    </div>
