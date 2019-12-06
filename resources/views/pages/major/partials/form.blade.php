<div class="form-group row {{ $errors->has('major_name') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <input value="{{ isset($major) ? $major->major_name : ''}}" type="text" class="form-control" id="major_name" name="major_name" placeholder="Please enter major name" required autofocus autocomplete="off">
            <label for="major_name">Major Name</label>
            @if ($errors->has('major_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('major_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('field_of_study_id') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="field_of_study_id" value="{{ isset($major) ? $major->fieldOfStudy->field_of_study_id : ''}}" name="field_of_study_id" style="width: 100%;" data-placeholder="Choose one.." required>
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @foreach($fieldOfStudies as $fieldOfStudy)
                    @isset($major)
                        @if($fieldOfStudy->field_of_study_id == $major->fieldOfStudy->field_of_study_id)
                            <option value="{{ $fieldOfStudy->field_of_study_id }}" selected>{{ $fieldOfStudy->field_of_study_name }}</option>
                        @else
                            <option value="{{ $fieldOfStudy->field_of_study_id }}">{{ $fieldOfStudy->field_of_study_name }}</option>
                        @endif
                    @else
                        <option value="{{ $fieldOfStudy->field_of_study_id }}">{{ $fieldOfStudy->field_of_study_name }}</option>
                    @endisset
                @endforeach
            </select>
            <label for="field_of_study_id">Field Of Study</label>
            @if ($errors->has('field_of_study_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('field_of_study_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>