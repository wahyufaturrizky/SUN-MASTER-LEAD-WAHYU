@isset($institutionGroup)
    <input type="hidden" name="institution_group_id" value="{{ $institutionGroup->institution_group_id }}">
@endisset

<div class="form-group row {{ $errors->has('institution_group_name') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
        <input value="{{ isset($institutionGroup) ? $institutionGroup->institution_group_name : ''}}" type="text" class="form-control" id="institution_group_name" name="institution_group_name" placeholder="Please enter field of study name" required autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
            <label for="institution_group_name">Group Name</label>
            @if ($errors->has('institution_group_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('institution_group_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('institution_ids') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="institution_ids" value="" name="institution_ids[]" style="width: 100%;" data-placeholder="Choose one.." multiple required>
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @foreach($institutions as $institution)
                    <option value="{{ $institution->institution_id }}">{{ $institution->institution_name }}</option>
                @endforeach
            </select>
            <label for="institution_ids">Institution</label>
            @if ($errors->has('institution_ids'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('institution_ids') }}</strong>
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
        @isset($institutionGroup)
            $(document).ready(function(){
                var institution_ids = {!! $institutionGroup->arrInstitutionIds() !!};
                $('#institution_ids').val(institution_ids).trigger('change');
            });
        @endisset
    </script>
@endsection
