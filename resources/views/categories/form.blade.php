<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title" class="col-sm-2 control-label">Titel</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="title" name="title" placeholder="Titel"
               value="{{ old('title', optional($category)->title) }}" autofocus>
        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
</div>