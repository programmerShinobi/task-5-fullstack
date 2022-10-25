@csrf
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
    <input type="text" name="category" value="{{ old('category', $post->category) }}" id="post-category" class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}">
    @if ($errors->has('category'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('category') }}</strong>
        </div>
    @endif
</div>

<hr>

<div class="form-group">
    <button type="submit" class="btn btn-outline-primary btn-lg"><em class="fa-solid fa-floppy-disk"></em> {{ $buttonText }}</button>
</div>
