<div class="form-group row {{ $errors->has('field_of_study_name') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <input value="{{ isset($fieldOfStudy) ? $fieldOfStudy->field_of_study_name : ''}}" type="text" class="form-control" id="field_of_study_name" name="field_of_study_name" placeholder="Please enter field of study name" required autofocus autocomplete="off">
            <label for="field_of_study_name">Name</label>
            @if ($errors->has('field_of_study_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('field_of_study_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>