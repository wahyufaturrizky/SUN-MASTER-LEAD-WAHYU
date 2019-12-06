<div class="form-group row">
    <div class="col-12">
        <div class="form-material">
            <input value="{{ isset($school) ? $school->name : '' }}" type="text" class="form-control" id="name" name="name" placeholder="Please enter school name">
            <label for="name">School Name</label>
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('school_type_id') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="school_type_id" value="{{ isset($school) ? $school->school_type_id : ''}}" name="school_type_id" style="width: 100%;" data-placeholder="Choose one.." required>
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @foreach($schoolTypes as $schoolType)
                    @isset($school)
                        @if($schoolType->school_type_id == $school->school_type_id)
                            <option value="{{ $schoolType->school_type_id }}" selected>{{ $schoolType->name }}</option>
                        @else
                            <option value="{{ $schoolType->school_type_id }}">{{ $schoolType->name }}</option>
                        @endif
                    @else
                        <option value="{{ $schoolType->school_type_id }}">{{ $schoolType->name }}</option>
                    @endisset
                @endforeach
            </select>
            <label for="school_type_id">Type</label>
            @if ($errors->has('school_type_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('school_type_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-12">
        <div class="form-material">
            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Please enter address">{{ isset($school) ? $school->address : '' }}</textarea>
            <label for="address">Address</label>
        </div>
    </div>
</div>
{{-- <div class="form-group row">
    <div class="col-12">
        <div class="form-material">
            <input value="{{ isset($school) ? $school->kelurahan : '' }}" type="text" class="form-control" id="kelurahan" name="kelurahan" placeholder="Please enter kelurahan">
            <label for="kelurahan">Kelurahan</label>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-12">
        <div class="form-material">
            <input value="{{ isset($school) ? $school->kecamatan : '' }}" type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Please enter kecamatan">
            <label for="kecamatan">Kecamatan</label>
        </div>
    </div>
</div> --}}
<div class="form-group row">
    <div class="col-12">
        <div class="form-material">
            <label for="kabupaten">City</label>
            <input value="{{ isset($school) ? $school->kabupaten : '' }}" type="text" class="form-control" id="kabupaten" name="kabupaten" placeholder="Please enter kabupaten">
        </div>
    </div>
</div>
{{-- <div class="form-group row">
    <div class="col-12">
        <div class="form-material">
            <label for="material-textarea-small">Propinsi</label>
            <input value="{{ isset($school) ? $school->propinsi : '' }}" type="text" class="form-control" id="material-text" name="propinsi" placeholder="Please enter kabupaten">
        </div>
    </div>
</div> --}}
<div class="form-group row {{ $errors->has('country_id') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="country_id" value="{{ isset($school) ? $school->country_id : ''}}" name="country_id" style="width: 100%;" data-placeholder="Choose one.." required>
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @foreach($countries as $country)
                    @isset($school)
                        @if($country->country_id == $school->country_id)
                            <option value="{{ $country->country_id }}" selected>{{ $country->country_name }}</option>
                        @else
                            <option value="{{ $country->country_id }}">{{ $country->country_name }}</option>
                        @endif
                    @else
                        <option value="{{ $country->country_id }}">{{ $country->country_name }}</option>
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