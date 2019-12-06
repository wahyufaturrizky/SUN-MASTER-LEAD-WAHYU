<div class="form-group row {{ $errors->has('branch_name') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
        <input value="{{ isset($branch) ? $branch->branch_name : ''}}" type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Please enter branch name" required autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
            <label for="branch_name">Branch Name</label>
            @if ($errors->has('branch_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('branch_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('branch_code') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <input minlength="1" maxlength="10" value="{{ isset($branch) ? $branch->branch_code : ''}}" type="text" class="form-control" id="branch_code" name="branch_code" placeholder="Please enter branch code" required autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
            <label for="branch_code">Branch Code</label>
            @if ($errors->has('branch_code'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('branch_code') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('branch_area') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="branch_area" value="{{ isset($branch) ? $branch->branch_area : ''}}" name="branch_area" style="width: 100%;" data-placeholder="Choose one.." required @isset($disabled) disabled="{{ $disabled }}" @endisset>
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @if(isset($branch))
                    @if($branch->branch_area == 'Jakarta')
                        <option value="Jakarta" selected>Jakarta</option>
                    @else
                        <option value="Jakarta">Jakarta</option>
                    @endif
                    @if($branch->branch_area == 'Outstation')
                        <option value="Outstation" selected>Outstation</option>
                    @else
                        <option value="Outstation">Outstation</option>
                    @endif
                @else
                    <option value="Jakarta">Jakarta</option>
                    <option value="Outstation">Outstation</option>
                @endif
            </select>
            <label for="branch_area">Branch Area</label>
            @if ($errors->has('branch_area'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('branch_area') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('branch_coverage') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <textarea rows="6" class="form-control" name="branch_coverage">{{ isset($branch) ? $branch->branch_coverage : ''}}</textarea>
            {{-- <select id="branch_coverage" class="form-control" name="branch_coverage[]" required></select> --}}
            <label for="branch_coverage">Coverage Area</label>
            @if ($errors->has('branch_coverage'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('branch_coverage') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('branch_sun_english_id') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="branch_sun_english_id" name="branch_sun_english_id" data-placeholder="Select one">
                <option value="">Select one</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                {{-- @foreach($sunEnglishBranches as $sunEnglishBranch)
                    <option value="{{ $sunEnglishBranch->branch_sun_english_id }}">{{ $sunEnglishBranch->branch_name }}</option>
                @endforeach --}}
                @foreach($sunEnglishBranches as $sunEnglishBranch)
                    @isset($branch)
                        @if($sunEnglishBranch->branch_sun_english_id == $branch->branch_sun_english_id)
                            <option value="{{ $sunEnglishBranch->branch_sun_english_id }}" selected>{{ $sunEnglishBranch->branch_name }}</option>
                        @else
                            <option value="{{ $sunEnglishBranch->branch_sun_english_id }}">{{ $sunEnglishBranch->branch_name }}</option>
                        @endif
                    @else
                        <option value="{{ $sunEnglishBranch->branch_sun_english_id }}">{{ $sunEnglishBranch->branch_name }}</option>
                    @endisset
                @endforeach
            </select>
            <label for="branch_sun_english_id">Sun English Branch (for auto branching)</label>
            @if ($errors->has('branch_sun_english_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('branch_sun_english_id') }}</strong>
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

    <script type="text/javascript">
        $(document).ready(function(){
            // $('#branch_coverage').select2({
            //     placeholder: "Search post code..",
            //     multiple: true,
            //     ajax: {
            //         url: '/api/data/ajaxBranchCoverage',
            //         method: 'POST',
            //         dataType: 'json',
            //         processResults: function(data){
            //             return {
            //                 results: data
            //             };
            //         }
            //     },
            // });
            @isset($branch)
                @if(!is_null($branch->branch_coverage) && !empty($branch->branch_coverage))
                    // var branch_coverage = {!! $branch->arrBranchCoverage() !!};
                    // $('#branch_coverage').val(branch_coverage).trigger('change');
                @endif
            @endisset
        });
    </script>
@endsection
