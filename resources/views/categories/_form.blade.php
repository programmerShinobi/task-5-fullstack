@csrf
<input type="hidden" name="user_id" value="{{ Auth::id() }}">

<div class="form-group mb-3">
    <label for="post-name">Name</label>
    <input type="text" name="name" value="{{ old('name', $category->name) }}" id="post-name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">

    @if ($errors->has('name'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('name') }}</strong>
        </div>
    @endif
</div>

<hr>

<div class="form-group">
    <button type="submit" class="btn btn-outline-primary btn-lg"><em class="fa-solid fa-floppy-disk"></em> {{ $buttonText }}</button>
</div>
