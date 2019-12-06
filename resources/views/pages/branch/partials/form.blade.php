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
            <input value="{{ isset($branch) ? $branch->branch_code : ''}}" type="text" class="form-control" id="branch_code" name="branch_code" placeholder="Please enter branch code" required autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
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
