<div class="form-group{{ $errors->has('book_id') ? ' has-error' : '' }}">
    <label for="book_id" class="col-sm-2 control-label">Buch</label>
    <div class="col-sm-10">
        <select id="book_id" name="book_id" class="selectpicker form-control" data-live-search="true" title="Auswählen" autofocus>
            <option value="" style="font-style: italic;">Auswählen</option>
            @foreach($books as $book)
                <option value="{{ $book->id }}" data-subtext="{{ $book->signature }}"
                        @if(old('book_id', optional($lending)->book_id) == $book->id) selected @endif>
                    {{ $book->title }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('book_id'))
            <span class="help-block">
                <strong>{{ $errors->first('book_id') }}</strong>
            </span>
        @else
            <span class="help-block">
                <span class="text-muted">Nur verfügbare Bücher werden angezeigt.</span>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('reader_id') ? ' has-error' : '' }}">
    <label for="reader_id" class="col-sm-2 control-label">Leser*in</label>
    <div class="col-sm-10">
        <select id="reader_id" name="reader_id" class="selectpicker form-control" data-live-search="true" title="Auswählen" autofocus>
            <option value="" style="font-style: italic;">Auswählen</option>
            @foreach($readers as $reader)
                <option value="{{ $reader->id }}" data-subtext="ID: {{ $reader->id }}"
                        @if(old('reader_id', optional($lending)->reader_id) == $reader->id) selected @endif>
                    {{ $reader->first_name }} {{ $reader->last_name }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('reader_id'))
            <span class="help-block">
                <strong>{{ $errors->first('reader_id') }}</strong>
            </span>
        @endif
    </div>
</div>