@isset($role)
    <input type="hidden" name="id" value="{{ $role->id }}">
@endisset
<div class="form-group row {{ $errors->has('name') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
        <input value="{{ isset($role) ? $role->name : ''}}" type="text" class="form-control" id="name" name="name" placeholder="Please enter user name" required autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
            <label for="name">Name</label>
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
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
                $('#id').val(null).trigger('change');
                $('#user_group_id').val(null).trigger('change');

                if(this.value == 'User'){
                    // $('#id').select2('destroy');
                    $('#id').prop('required',true);
                    $('#id').select2();

                    $('#user_group_id').select2('destroy');
                    $('#user_group_id').prop('required',false);

                    $('#user').removeClass('d-none');
                    $('#userGroup').addClass('d-none');
                } else if(this.value == 'Group'){
                    // $('#user_group_id').select2('destroy');
                    $('#user_group_id').prop('required',true);
                    $('#user_group_id').select2();

                    $('#id').select2('destroy');
                    $('#id').prop('required',false);

                    $('#userGroup').removeClass('d-none');
                    $('#user').addClass('d-none');
                } else {
                    $('#user').addClass('d-none');
                    $('#userGroup').addClass('d-none');
                }
            });
        });
    </script>
@endsection
