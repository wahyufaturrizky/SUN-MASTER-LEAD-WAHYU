<div class="form-group row {{ $errors->has('marketing_source_name') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
        <input value="{{ isset($marketingSource) ? $marketingSource->marketing_source_name : ''}}" type="text" class="form-control" id="marketing_source_name" name="marketing_source_name" placeholder="Please enter name" required autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
            <label for="marketing_source_name">Name</label>
            @if ($errors->has('marketing_source_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('marketing_source_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('register_type') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="register_type" name="register_type[]" style="width: 100%;" data-placeholder="Choose one.." multiple required>
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                <option value="Call In">Call In</option>
                <option value="Walk In">Walk In</option>
                <option value="Reference">Reference</option>
                <option value="Website / Digital Marketing">Website / Digital Marketing</option>
                <option value="Expo">Expo</option>
            </select>
            <label for="register_type">Register Type</label>
            @if ($errors->has('register_type'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('register_type') }}</strong>
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
    <script>
        @isset($marketingSource)
            @if(!is_null($marketingSource->register_type))
                $(document).ready(function(){
                    var register_type = {!! $marketingSource->arrRegisterType() !!};
                    $('#register_type').val(register_type).trigger('change');
                });
            @endif
        @endisset
    </script>
@endsection
