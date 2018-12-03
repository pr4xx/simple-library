<div class="form-group{{ $errors->has('signature') ? ' has-error' : '' }}">
    <label for="signature" class="col-sm-2 control-label">Signatur</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="signature" name="signature" placeholder="Signatur"
               value="{{ old('signature', optional($reader)->signature) }}" autofocus>
        @if ($errors->has('signature'))
            <span class="help-block">
                <strong>{{ $errors->first('signature') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title" class="col-sm-2 control-label">Titel</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="title" name="title" placeholder="Titel"
               value="{{ old('title', optional($reader)->title) }}">
        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('original_title') ? ' has-error' : '' }}">
    <label for="original_title" class="col-sm-2 control-label">(Original)</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="original_title" name="original_title" placeholder="Titel (Original)"
               value="{{ old('original_title', optional($reader)->original_title) }}">
        @if ($errors->has('original_title'))
            <span class="help-block">
                <strong>{{ $errors->first('original_title') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('author_id') ? ' has-error' : '' }}">
    <label for="author_id" class="col-sm-2 control-label">Autor*in</label>
    <div class="col-sm-10">
        <select id="author_id" name="author_id" class="selectpicker form-control" data-live-search="true" title="Auswählen">
            <option value="" style="font-style: italic;">Auswählen</option>
            @foreach($authors as $author)
                <option value="{{ $author->id }}"
                        @if(old('author_id', optional($reader)->author_id) == $author->id) selected @endif>
                    {{ $author->name }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('author_id'))
            <span class="help-block">
                <strong>{{ $errors->first('author_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('origin_id') ? ' has-error' : '' }}">
    <label for="origin_id" class="col-sm-2 control-label">Ort</label>
    <div class="col-sm-10">
        <select id="origin_id" name="origin_id" class="selectpicker form-control" data-live-search="true" title="Auswählen">
            <option value="" style="font-style: italic;">Auswählen</option>
            @foreach($origins as $origin)
                <option value="{{ $origin->id }}"
                        @if(old('origin_id', optional($reader)->origin_id) == $origin->id) selected @endif>
                    {{ $origin->title }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('origin_id'))
            <span class="help-block">
                <strong>{{ $errors->first('origin_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
    <label for="category_id" class="col-sm-2 control-label">Gattung</label>
    <div class="col-sm-10">
        <select id="category_id" name="category_id" class="selectpicker form-control" data-live-search="true" title="Auswählen">
            <option value="" style="font-style: italic;">Auswählen</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                        @if(old('category_id', optional($reader)->category_id) == $category->id) selected @endif>
                    {{ $category->title }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('category_id'))
            <span class="help-block">
                <strong>{{ $errors->first('category_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('tag_id') ? ' has-error' : '' }}">
    <label for="tag_id" class="col-sm-2 control-label">Schlagworte</label>
    <div class="col-sm-10">
        <select id="tag_id" name="tag_ids[]" class="selectpicker form-control" data-live-search="true" title="Auswählen" multiple>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}"
                        @if(in_array($tag->id, old('tag_ids', optional($reader)->tags->pluck('id')->toArray()))) selected @endif>
                    {{ $tag->title }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('tag_id'))
            <span class="help-block">
                <strong>{{ $errors->first('tag_id') }}</strong>
            </span>
        @endif
    </div>
</div>