<div class="form-group row {{ $errors->has('name') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
        <input value="{{ isset($user) ? $user->name : ''}}" type="text" class="form-control" id="name" name="name" placeholder="Please enter user name" required autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
            <label for="name">Full Name</label>
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('email') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
        <input value="{{ isset($user) ? $user->email : ''}}" type="text" class="form-control" id="email" name="email" placeholder="Please enter user email" required autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
            <label for="email">Email</label>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('password') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
        <input value="" type="password" class="form-control" id="password" name="password" placeholder="Please enter user password" autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset @isset($user) @else required @endisset>
            @if(isset($user))
                <label for="password">New Password</label>
            @else
                <label for="password">Password</label>
            @endif

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('role_name') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="role_name" name="role_name" data-placeholder="Choose one.." required @isset($disabled) disabled="{{ $disabled }}" @endisset>
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @foreach($roles as $role)
                    @isset($user)
                        @if($user->roles->first()->id == $role->id)
                            <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                        @else
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endif
                    @else
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endisset
                @endforeach
            </select>
            <label for="role_name">Role</label>
            @if ($errors->has('role_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('role_name') }}</strong>
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
