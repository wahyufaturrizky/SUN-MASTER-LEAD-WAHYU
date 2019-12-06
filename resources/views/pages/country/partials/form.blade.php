<div class="form-group row {{ $errors->has('country_name') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
        <input value="{{ isset($country) ? $country->country_name : ''}}" type="text" class="form-control" id="country_name" name="country_name" placeholder="Please enter country name" required autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
            <label for="country_name">Country Name</label>
            @if ($errors->has('country_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('country_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('country_code') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <input maxlength="2" minlength="2" value="{{ isset($country) ? $country->country_code : ''}}" type="text" class="form-control" id="country_code" name="country_code" placeholder="Please enter country code" required autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
            <label for="country_code">Country Code</label>
            @if ($errors->has('country_code'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('country_code') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group row {{ $errors->has('sun_destination') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="sun_destination" value="{{ isset($country) ? $country->sun_destination : ''}}" name="sun_destination" style="width: 100%;" data-placeholder="Choose one.." required @isset($disabled) disabled="{{ $disabled }}" @endisset>
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @if(isset($country))
                    @if($country->sun_destination == 'Yes')
                        <option value="Yes" selected>Yes</option>
                    @else
                        <option value="Yes">Yes</option>
                    @endif
                    @if($country->sun_destination == 'No')
                        <option value="No" selected>No</option>
                    @else
                        <option value="No">No</option>
                    @endif
                @else
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                @endif
            </select>
            <label for="sun_destination">SUN Destination</label>
            @if ($errors->has('sun_destination'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('sun_destination') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>



@section('css_before')
    <link rel="stylesheet" href="{{ asset('/js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
    <script src="{{ asset('/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>jQuery(function(){ Codebase.helpers(['select2']); });</script>
@endsection
