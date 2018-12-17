<div class="form-group{{ $errors->has('book_ids') ? ' has-error' : '' }}">
    <label for="book_id" class="col-sm-2 control-label">Bücher</label>
    <div class="col-sm-10">
        <select id="book_id" name="book_ids[]" class="selectpicker form-control" data-live-search="true"
                title="Auswählen" multiple autofocus>
            @foreach($books as $book)
                <option value="{{ $book->id }}"
                        @if(in_array($book->id, old('book_ids', []))) selected @endif>
                    {{ $book->title }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('book_ids'))
            <span class="help-block">
                <strong>{{ $errors->first('book_ids') }}</strong>
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
        <select id="reader_id" name="reader_id" class="selectpicker form-control" data-live-search="true"
                title="Auswählen" autofocus>
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

<div class="form-group{{ $errors->has('due_at') ? ' has-error' : '' }}">
    <label for="due_at" class="col-sm-2 control-label">Fällig am</label>
    <div class="col-sm-10">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
            <input type="text" class="form-control" id="due_at" name="due_at" value="{{ old('due_at') }}" placeholder="TT.MM.JJJJ">
        </div>
        <span class="help-block">
            <button type="button" class="btn btn-xs btn-default" onclick="addDays(7)">In 7 Tagen</button>
            <button type="button" class="btn btn-xs btn-default" onclick="addDays(14)">In 2 Wochen</button>
            <button type="button" class="btn btn-xs btn-default" onclick="addDays(21)">In 3 Wochen</button>
        </span>
        @if ($errors->has('due_at'))
            <span class="help-block">
                <strong>{{ $errors->first('due_at') }}</strong>
            </span>
        @endif
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        var datepickerSelector = '#due_at';

        function addDays(count) {
            var newDate = moment().add(count, 'day');
            $(datepickerSelector).datepicker('setDate', newDate.toDate());
        }

        $(document).ready(function () {

            $(datepickerSelector).datepicker({
                language: 'de',
                autoclose: true,
                orientation: 'bottom'
            });

        });
    </script>
@endpush