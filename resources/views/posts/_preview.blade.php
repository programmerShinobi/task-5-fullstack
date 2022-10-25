    <div class="media post">
        <div class="media-body">
            <div class="d-flex align-items-justify">
                <h3 class="mt-0"><a href="{{ $post->url }}">{!! $post->title !!}</a></h3>
            </div>
            <p class="lead">
                <small class="text-muted">{{ $post->created_date }}</small>
            </p>
            <div class="excerpt text-justify">
                {!! Str::limit($post->content_html, 250) !!}
            </div>
        </div>
    </div>
