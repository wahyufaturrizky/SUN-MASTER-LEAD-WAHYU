@isset($userGroup)
    <input type="hidden" name="user_group_id" value="{{ $userGroup->user_group_id }}">
@endisset

<div class="form-group row {{ $errors->has('user_group_name') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
        <input value="{{ isset($userGroup) ? $userGroup->user_group_name : ''}}" type="text" class="form-control" id="user_group_name" name="user_group_name" placeholder="Please enter field of study name" required autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
            <label for="user_group_name">Group Name</label>
            @if ($errors->has('user_group_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('user_group_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('ids') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="ids" value="" name="ids[]" style="width: 100%;" data-placeholder="Choose one.." multiple required>
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <label for="ids">User</label>
            @if ($errors->has('ids'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('ids') }}</strong>
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
        @isset($userGroup)
            $(document).ready(function(){
                var ids = {!! $userGroup->arrUserIds() !!};
                $('#ids').val(ids).trigger('change');
            });
        @endisset
    </script>
@endsection
