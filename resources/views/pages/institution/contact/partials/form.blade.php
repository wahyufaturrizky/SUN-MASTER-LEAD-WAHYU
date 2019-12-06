@isset($institutionContact)
    <input type="hidden" name="institution_contact_id" value="{{ $institutionContact->institution_contact_id }}">
@endisset
<div class="form-group row {{ $errors->has('type') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="type" value="" name="type" style="width: 100%;" data-placeholder="Choose one.." required>
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @isset($institutionContact)
                    @if($institutionContact->type == 'Institution')
                        <option value="Institution" selected>Institution</option>
                    @else
                        <option value="Institution">Institution</option>
                    @endif
                    @if($institutionContact->type == 'Group')
                        <option value="Group" selected>Group</option>
                    @else
                        <option value="Group">Group</option>
                    @endif
                @else
                    <option value="Institution">Institution</option>
                    <option value="Group">Group</option>
                @endisset
            </select>
            <label for="type">Type</label>
            @if ($errors->has('type'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('type') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div id="institution" class="@isset($institutionContact) @if($institutionContact->type == 'Institution') @else d-none @endif @else d-none @endisset form-group row {{ $errors->has('institution_id') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="institution_id" value="" name="institution_id" style="width: 100%;" data-placeholder="Choose one..">
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @foreach($institutions as $institution)
                    @isset($institutionContact)
                        @if($institutionContact->type == 'Institution' && $institutionContact->reference_id == $institution->institution_id)
                            <option value="{{ $institution->institution_id }}" selected>{{ $institution->institution_name }}</option>
                        @else
                            <option value="{{ $institution->institution_id }}">{{ $institution->institution_name }}</option>
                        @endif
                    @else
                        <option value="{{ $institution->institution_id }}">{{ $institution->institution_name }}</option>
                    @endisset
                @endforeach
            </select>
            <label for="institution_id">Institution Name</label>
            @if ($errors->has('institution_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('institution_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div id="institutionGroup" class="@isset($institutionContact) @if($institutionContact->type == 'Group') @else d-none @endif @else d-none @endisset form-group row {{ $errors->has('institution_group_id') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="institution_group_id" value="" name="institution_group_id" style="width: 100%;" data-placeholder="Choose one..">
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @foreach($institutionGroups as $institutionGroup)
                    {{-- <option value="{{ $institutionGroup->institution_group_id }}">{{ $institutionGroup->institution_group_name }}</option> --}}
                    @isset($institutionContact)
                        @if($institutionContact->type == 'Group' && $institutionContact->reference_id == $institutionGroup->institution_group_id)
                            <option value="{{ $institutionGroup->institution_group_id }}" selected>{{ $institutionGroup->institution_group_name }}</option>
                        @else
                            <option value="{{ $institutionGroup->institution_group_id }}">{{ $institutionGroup->institution_group_name }}</option>
                        @endif
                    @else
                        <option value="{{ $institutionGroup->institution_group_id }}">{{ $institutionGroup->institution_group_name }}</option>
                    @endisset
                @endforeach
            </select>
            <label for="institution_group_id">Group Name</label>
            @if ($errors->has('institution_group_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('institution_group_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group row {{ $errors->has('name') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
        <input value="{{ isset($institutionContact) ? $institutionContact->name : ''}}" type="text" class="form-control" id="name" name="name" placeholder="Please enter name" required autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
            <label for="name">Name</label>
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('position') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
        <input value="{{ isset($institutionContact) ? $institutionContact->position : ''}}" type="text" class="form-control" id="position" name="position" placeholder="Please enter position" required autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
            <label for="position">Position</label>
            @if ($errors->has('position'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('position') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('address') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
        <textarea type="text" class="form-control" id="address" name="address" placeholder="Please enter address" autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>{{ isset($institutionContact) ? $institutionContact->address : ''}}</textarea>
            <label for="address">Address</label>
            @if ($errors->has('address'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('phone') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
        <input value="{{ isset($institutionContact) ? $institutionContact->phone : ''}}" type="text" class="form-control" id="phone" name="phone" placeholder="Please enter phone" autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
            <label for="phone">Phone</label>
            @if ($errors->has('phone'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('email') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
        <input value="{{ isset($institutionContact) ? $institutionContact->email : ''}}" type="email" class="form-control" id="email" name="email" placeholder="Please enter email" autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
            <label for="email">Email</label>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
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
        $(document).ready(function(){
            $('body').on('change keyup blur', '#type', function(){
                $('#institution_id').val(null).trigger('change');
                $('#institution_group_id').val(null).trigger('change');

                if(this.value == 'Institution'){
                    // $('#institution_id').select2('destroy');
                    $('#institution_id').prop('required',true);
                    $('#institution_id').select2();

                    $('#institution_group_id').select2('destroy');
                    $('#institution_group_id').prop('required',false);

                    $('#institution').removeClass('d-none');
                    $('#institutionGroup').addClass('d-none');
                } else if(this.value == 'Group'){
                    // $('#institution_group_id').select2('destroy');
                    $('#institution_group_id').prop('required',true);
                    $('#institution_group_id').select2();

                    $('#institution_id').select2('destroy');
                    $('#institution_id').prop('required',false);

                    $('#institutionGroup').removeClass('d-none');
                    $('#institution').addClass('d-none');
                } else {
                    $('#institution').addClass('d-none');
                    $('#institutionGroup').addClass('d-none');
                }
            });
        });
    </script>
@endsection
