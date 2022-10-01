@csrf
<input type="hidden" name="user_id" value="{{ Auth::id() }}">

<div class="form-group mb-3">
    <label for="post-title">Title</label>
    <input type="text" name="title" value="{{ old('title', $post->title) }}" id="post-title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">

    @if ($errors->has('title'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('title') }}</strong>
        </div>
    @endif
</div>

<div class="form-group mb-3">
    <label for="post-content">Content</label>
    <textarea name="content" id="post-content" rows="10" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}">{{ old('content', $post->content) }}</textarea>

    @if ($errors->has('content'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('content') }}</strong>
        </div>
    @endif
</div>

<div class="form-group mb-3">
    <label for="post-image">Image</label>
    <input type="file" name="image" value="{{ old('image', $post->image) }}" id="post-image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}">

    @if ($errors->has('image'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('image') }}</strong>
        </div>
    @endif
</div>

<div class="form-group mb-3">
    <label for="post-status">Status</label>
    <select type="text" name="status" id="post-status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
        <option value="" class="text-muted">--- Select status ---</option>
        <option value="publish" @if (old('status', $post->status) == "publish") selected
            @endif>Publish
        </option>
        <option value="draft" @if (old('status', $post->status) == "draft") selected
            @endif>Draft
        </option>
        <option value="trash" @if (old('status', $post->status) == "trash") selected
            @endif>Trash
        </option>
    </select>
    @if ($errors->has('status'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('status') }}</strong>
        </div>
    @endif
</div>

<div class="form-group mb-3">
    <label for="post-category">Category</label>
    <select type="text" name="category_id" id="post-category" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
        <option value="" class="text-muted">--- Select category ---</option>
        @foreach ($list_category as $item)
        <option value="{{ $item->id }}"
            @if (old('category_id', $post->category_id)== $item->id)selected
            @endif>{{ $item->name }}
        </option>
        @endforeach
    </select>
    @if ($errors->has('category_id'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('category_id') }}</strong>
        </div>
    @endif
</div>

<hr>

<div class="form-group">
    <button type="submit" class="btn btn-outline-primary btn-lg"><em class="fa-solid fa-floppy-disk"></em> {{ $buttonText }}</button>
</div>
