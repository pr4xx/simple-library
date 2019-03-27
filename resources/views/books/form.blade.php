<div class="form-group{{ $errors->has('signature') ? ' has-error' : '' }}">
    <label for="signature" class="col-sm-2 control-label">Signatur</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="signature" name="signature" placeholder="Signatur"
               value="{{ old('signature', optional($book)->signature) }}" autofocus>
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
               value="{{ old('title', optional($book)->title) }}">
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
               value="{{ old('original_title', optional($book)->original_title) }}">
        @if ($errors->has('original_title'))
            <span class="help-block">
                <strong>{{ $errors->first('original_title') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('translated_title') ? ' has-error' : '' }}">
    <label for="translated_title" class="col-sm-2 control-label">(Übersetzt)</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="translated_title" name="translated_title" placeholder="Titel (Übersetzt)"
               value="{{ old('translated_title', optional($book)->translated_title) }}">
        @if ($errors->has('translated_title'))
            <span class="help-block">
                <strong>{{ $errors->first('translated_title') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
    <label for="year" class="col-sm-2 control-label">Jahr</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="year" name="year" placeholder="Jahr"
               value="{{ old('year', optional($book)->year) }}">
        @if ($errors->has('year'))
            <span class="help-block">
                <strong>{{ $errors->first('year') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('author_id') || $errors->has('author_name') ? ' has-error' : '' }}">
    <label for="author_id" class="col-sm-2 control-label">Autor*in</label>
    <div class="col-sm-10">
        <div id="author-select">
            <select id="author_id" name="author_id" class="selectpicker form-control" data-live-search="true" title="Auswählen">
                <option value="" style="font-style: italic;">Auswählen</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}"
                            @if(old('author_id', optional($book)->author_id) == $author->id) selected @endif>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
            @if(!optional($book)->id)
                <span class="help-block">
                    <button type="button" class="btn btn-xs btn-default" onclick="addAuthor(true);">Hinzufügen</button>
                </span>
            @endif
        </div>
        <div id="author-add" style="display: none;">
            <input type="text" class="form-control" id="author_name" name="author_name" placeholder="Name"
                   value="{{ old('author_name') }}">
            <span class="help-block">
                <button type="button" class="btn btn-xs btn-default" onclick="selectAuthor();">Auswählen</button>
            </span>
        </div>
        @if ($errors->has('author_id'))
            <span class="help-block">
                <strong>{{ $errors->first('author_id') }}</strong>
            </span>
        @endif
        @if ($errors->has('author_name'))
            <span class="help-block">
                <strong>{{ $errors->first('author_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('origin_id') || $errors->has('origin_title') ? ' has-error' : '' }}">
    <label for="origin_id" class="col-sm-2 control-label">Ort</label>
    <div class="col-sm-10">
        <div id="origin-select">
            <select id="origin_id" name="origin_id" class="selectpicker form-control" data-live-search="true" title="Auswählen">
                <option value="" style="font-style: italic;">Auswählen</option>
                @foreach($origins as $origin)
                    <option value="{{ $origin->id }}"
                            @if(old('origin_id', optional($book)->origin_id) == $origin->id) selected @endif>
                        {{ $origin->title }}
                    </option>
                @endforeach
            </select>
            @if(!optional($book)->id)
                <span class="help-block">
                    <button type="button" class="btn btn-xs btn-default" onclick="addOrigin(true);">Hinzufügen</button>
                </span>
            @endif
        </div>
        <div id="origin-add" style="display: none;">
            <input type="text" class="form-control" id="origin_title" name="origin_title" placeholder="Titel"
                   value="{{ old('origin_title') }}">
            <span class="help-block">
                <button type="button" class="btn btn-xs btn-default" onclick="selectOrigin();">Auswählen</button>
            </span>
        </div>
        @if ($errors->has('origin_id'))
            <span class="help-block">
                <strong>{{ $errors->first('origin_id') }}</strong>
            </span>
        @endif
        @if ($errors->has('origin_title'))
            <span class="help-block">
                <strong>{{ $errors->first('origin_title') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('category_id') || $errors->has('category_title') ? ' has-error' : '' }}">
    <label for="category_id" class="col-sm-2 control-label">Gattungen</label>
    <div class="col-sm-10">
        <div id="category-select">
            <select id="category_id" name="category_id" class="selectpicker form-control" data-live-search="true" title="Auswählen">
                <option value="" style="font-style: italic;">Auswählen</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                            @if(old('category_id', optional($book)->category_id) == $category->id) selected @endif>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
            @if(!optional($book)->id)
                <span class="help-block">
                    <button type="button" class="btn btn-xs btn-default" onclick="addCategory(true);">Hinzufügen</button>
                </span>
            @endif
        </div>
        <div id="category-add" style="display: none;">
            <input type="text" class="form-control" id="category_title" name="category_title" placeholder="Titel"
                   value="{{ old('category_title') }}">
            <span class="help-block">
                <button type="button" class="btn btn-xs btn-default" onclick="selectCategory();">Auswählen</button>
            </span>
        </div>
        @if ($errors->has('category_id'))
            <span class="help-block">
                <strong>{{ $errors->first('category_id') }}</strong>
            </span>
        @endif
        @if ($errors->has('category_title'))
            <span class="help-block">
                <strong>{{ $errors->first('category_title') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('tag_ids') ? ' has-error' : '' }}">
    <label for="tag_id" class="col-sm-2 control-label">Schlagworte</label>
    <div class="col-sm-10">
        <div id="tags-select">
            <select id="tag_id" name="tag_ids[]" class="selectpicker form-control" data-live-search="true" title="Auswählen" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}"
                            @if(in_array($tag->id, old('tag_ids', optional($book)->tags->pluck('id')->toArray()))) selected @endif>
                        {{ $tag->title }}
                    </option>
                @endforeach
            </select>
            @if(!optional($book)->id)
                <span class="help-block">
                    <button type="button" class="btn btn-xs btn-default" onclick="addTags(true);">Hinzufügen</button>
                </span>
            @endif
        </div>
        <div id="tags-add" style="display: none;">
            <input type="text" class="form-control" id="tag_titles" name="tag_titles" placeholder="Titel"
                   value="{{ old('tag_titles') }}">
            <small class="help-block">
                Mehrere per Komma trennen: Fiktion, Romantik
            </small>
            <span class="help-block">
                <button type="button" class="btn btn-xs btn-default" onclick="selectTags();">Auswählen</button>
            </span>
        </div>
        @if ($errors->has('tag_ids'))
            <span class="help-block">
                <strong>{{ $errors->first('tag_ids') }}</strong>
            </span>
        @endif
        @if ($errors->has('tag_titles'))
            <span class="help-block">
                <strong>{{ $errors->first('tag_titles') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
    <label for="notes" class="col-sm-2 control-label">Bemerkungen</label>
    <div class="col-sm-10">
        <textarea class="form-control" id="notes" name="notes"
                  placeholder="Bemerkungen">{{ old('notes', optional($book)->notes) }}</textarea>
        @if ($errors->has('notes'))
            <span class="help-block">
                <strong>{{ $errors->first('notes') }}</strong>
            </span>
        @endif
    </div>
</div>

@push('scripts')
    <script type="text/javascript">

        // Origin functions
        function addOrigin(focus) {
            $('#origin-select').hide();
            $('#origin-add').show();
            $('#origin_id').selectpicker('val', '');
            if(focus) {
                $('#origin_title').focus();
            }
        }

        function selectOrigin() {
            $('#origin-select').show();
            $('#origin-add').hide();
            $('#origin_title').val('')
        }

        // Author functions
        function addAuthor(focus) {
            $('#author-select').hide();
            $('#author-add').show();
            $('#author_id').selectpicker('val', '');
            if(focus) {
                $('#author_name').focus();
            }
        }

        function selectAuthor() {
            $('#author-select').show();
            $('#author-add').hide();
            $('#author_name').val('')
        }

        // Category functions
        function addCategory(focus) {
            $('#category-select').hide();
            $('#category-add').show();
            $('#category_id').selectpicker('val', '');
            if(focus) {
                $('#category_title').focus();
            }
        }

        function selectCategory() {
            $('#category-select').show();
            $('#category-add').hide();
            $('#category_title').val('')
        }

        // Category functions
        function addTags(focus) {
            $('#tags-select').hide();
            $('#tags-add').show();
            $('#tag_id').selectpicker('val', '');
            if(focus) {
                $('#tag_titles').focus();
            }
        }

        function selectTags() {
            $('#tags-select').show();
            $('#tags-add').hide();
            $('#tag_titles').val('')
        }


        

        $(document).ready(function () {

            if($('#origin_title').val()) {
                addOrigin();
            }

            if($('#author_name').val()) {
                addAuthor();
            }

            if($('#category_title').val()) {
                addCategory();
            }

            if($('#tag_titles').val()) {
                addTags();
            }

        });
    </script>
@endpush