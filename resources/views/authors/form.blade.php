<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name" placeholder="Name"
               value="{{ old('name', optional($author)->name) }}" autofocus>
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
    <label for="notes" class="col-sm-2 control-label">Bemerkungen</label>
    <div class="col-sm-10">
        <textarea class="form-control" id="notes" name="notes"
                  placeholder="Bemerkungen">{{ old('notes', optional($author)->notes) }}</textarea>
        @if ($errors->has('notes'))
            <span class="help-block">
                <strong>{{ $errors->first('notes') }}</strong>
            </span>
        @endif
    </div>
</div>