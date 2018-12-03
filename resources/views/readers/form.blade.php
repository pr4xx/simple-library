<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
    <label for="last_name" class="col-sm-2 control-label">Nachname</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nachname"
               value="{{ old('last_name', optional($reader)->last_name) }}" autofocus>
        @if ($errors->has('last_name'))
            <span class="help-block">
                <strong>{{ $errors->first('last_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
    <label for="first_name" class="col-sm-2 control-label">Vorname</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Vorname"
               value="{{ old('first_name', optional($reader)->first_name) }}">
        @if ($errors->has('first_name'))
            <span class="help-block">
                <strong>{{ $errors->first('first_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
    <label for="street" class="col-sm-2 control-label">Straße, Nummer</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="street" name="street" placeholder="Straße, Nummer"
               value="{{ old('street', optional($reader)->street) }}">
        @if ($errors->has('street'))
            <span class="help-block">
                <strong>{{ $errors->first('street') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
    <label for="zip" class="col-sm-2 control-label">PLZ</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="zip" name="zip" placeholder="PLZ"
               value="{{ old('zip', optional($reader)->zip) }}">
        @if ($errors->has('zip'))
            <span class="help-block">
                <strong>{{ $errors->first('zip') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
    <label for="city" class="col-sm-2 control-label">Ort</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="city" name="city" placeholder="Ort"
               value="{{ old('city', optional($reader)->city) }}">
        @if ($errors->has('city'))
            <span class="help-block">
                <strong>{{ $errors->first('city') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-sm-2 control-label">E-Mail</label>
    <div class="col-sm-10">
        <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail"
               value="{{ old('email', optional($reader)->email) }}">
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
    <label for="mobile" class="col-sm-2 control-label">Mobilnummer</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobilnummer"
               value="{{ old('mobile', optional($reader)->mobile) }}">
        @if ($errors->has('mobile'))
            <span class="help-block">
                <strong>{{ $errors->first('mobile') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="has_whatsapp" class="col-sm-2 control-label">Whatsapp?</label>
    <div class="col-sm-10">
        <div class="checkbox">
            <label>
                <input type="checkbox" id="has_whatsapp" name="has_whatsapp"
                       value="1" @if(old('has_whatsapp', optional($reader)->has_whatsapp)) checked @endif>
            </label>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="paid_deposit" class="col-sm-2 control-label">Pfand?</label>
    <div class="col-sm-10">
        <div class="checkbox">
            <label>
                <input type="checkbox" id="paid_deposit" name="paid_deposit"
                       value="1" @if(old('paid_deposit', optional($reader)->paid_deposit)) checked @endif>
            </label>
        </div>
    </div>
</div>

<div class="form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
    <label for="notes" class="col-sm-2 control-label">Bemerkungen</label>
    <div class="col-sm-10">
        <textarea class="form-control" id="notes" name="notes"
                  placeholder="Bemerkungen">{{ old('notes', optional($reader)->notes) }}</textarea>
        @if ($errors->has('notes'))
            <span class="help-block">
                <strong>{{ $errors->first('notes') }}</strong>
            </span>
        @endif
    </div>
</div>