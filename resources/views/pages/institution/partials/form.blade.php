<div class="form-group row {{ $errors->has('institution_name') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
        <input value="{{ isset($institution) ? $institution->institution_name : ''}}" type="text" class="form-control" id="institution_name" name="institution_name" placeholder="Please enter institution name" required autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
            <label for="institution_name">Institution Name</label>
            @if ($errors->has('institution_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('institution_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('acronym') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <input maxlength="3" minlength="3" value="{{ isset($institution) ? $institution->acronym : ''}}" type="text" class="form-control" id="acronym" name="acronym" placeholder="Please enter acronym" autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
            <label for="acronym">Acronym</label>
            @if ($errors->has('acronym'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('acronym') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('country_id') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="country_id" value="{{ isset($institution) ? $institution->country_id : ''}}" name="country_id" style="width: 100%;" data-placeholder="Choose one.." required>
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @foreach($countries as $country)
                    @isset($institution)
                        @if($country->country_code == $institution->country_id)
                            <option value="{{ $country->country_code }}" selected>{{ $country->country_name }}</option>
                        @else
                            <option value="{{ $country->country_code }}">{{ $country->country_name }}</option>
                        @endif
                    @else
                        <option value="{{ $country->country_code }}">{{ $country->country_name }}</option>
                    @endisset
                @endforeach
            </select>
            <label for="country_id">Country</label>
            @if ($errors->has('country_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('country_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group row {{ $errors->has('is_partnership') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="is_partnership" value="{{ isset($institution) ? $institution->is_partnership : ''}}" name="is_partnership" style="width: 100%;" data-placeholder="Choose one.." required>
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @isset($institution)
                    @if($institution->is_partnership == "Yes")
                        <option value="Yes" selected>Yes</option>
                        <option value="No">No</option>
                    @else
                        <option value="Yes">Yes</option>
                        <option value="No" selected>No</option>
                    @endif
                @else
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                @endisset
            </select>
            <label for="is_partnership">Partnership</label>
            @if ($errors->has('is_partnership'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('is_partnership') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

@section('css_after')
    <link rel="stylesheet" href="{{ asset('/js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
    <script src="{{ asset('/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>jQuery(function(){ Codebase.helpers(['select2']); });</script>
@endsection
