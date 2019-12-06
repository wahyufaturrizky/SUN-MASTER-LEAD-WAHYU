<div class="row">
        {{-- Left Side --}}
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-material">
                    <input value="{{ $lead->full_name }}" type="text" class="form-control text-capitalize" id="full_name" name="full_name" autocomplete="off" disabled>
                    <label for="full_name">Student Name</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-material">
                    <input value="{{ $lead->mobile }}" type="text" class="form-control noscroll" name="mobile" id="mobile" autocomplete="off" disabled>
                    <label for="mobile">Mobile Phone</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-material">
                    <input value="{{ $lead->email }}" type="email" class="form-control" id="email" name="email"  autocomplete="off" disabled>
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-material">
                    <label for="birth">Date of Birth</label>
                    <input value="{{ date_format(date_create($lead->birth),'d-m-Y') }}" type="text" class="js-datepicker form-control" id="birth" name="birth" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" disabled>
                </div>
            </div>
            <div class="form-group">
                <div class="form-material">
                    <label for="gender">Gender</label>
                    @php
                        if($lead->gender == 'm'){
                            $gender = 'Male';
                        } else if($lead->gender == 'm'){
                            $gender = 'Female';
                        } else {
                            $gender = '';
                        }
                    @endphp
                    <input value="{{ $gender }}" type="text" class="form-control text-capitalize" id="gender" name="gender" autocomplete="off" disabled>
                </div>
            </div>
            <div class="form-group">
                <div class="form-material">
                    <label for="parents_name">Parents name</label>
                    <input value="{{ $lead->parents_name }}" type="text" class="form-control text-capitalize" id="parents_name" name="parents_name" autocomplete="off" disabled>
                </div>
            </div>
            <div class="form-group">
                <div class="form-material">
                    <label for="parents_mobile">Parents Mobile Phone</label>
                    <input value="{{ $lead->parents_mobile }}" type="text" class="form-control" name="parents_mobile" id="parents_mobile" autocomplete="off" disabled>
                </div>
            </div>
            <div class="form-group">
                <div class="form-material">
                    <label for="address">Full Address</label>
                    <input value="{{ $lead->address }}" class="form-control" id="address" name="address" rows="4" style="resize:none;" autocomplete="off" disabled>
                </div>
            </div>
            <div class="form-group">
                <div class="form-material">
                    @php
                        $zipCode = '';

                        if($lead->zip_code != ''){
                            $zipCode = $lead->zip_code;

                            if($lead->kelurahan != ''){
                                $zipCode .= ' (' . $lead->kelurahan . ', ';
                            }

                            if($lead->kecamatan != ''){
                                $zipCode .= $lead->kecamatan . ', ';
                            }

                            if($lead->dt2 != ''){
                                $zipCode .= $lead->dt2 . ' ';
                            }

                            if($lead->kabupaten != ''){
                                $zipCode .= $lead->kabupaten . ', ';
                            }

                            if($lead->provinsi != ''){
                                $zipCode .= $lead->provinsi . ')';
                            }
                        }
                    @endphp
                    <input value="{{ $zipCode }}" type="text" class="form-control text-capitalize" id="zip_code" name="zip_code" autocomplete="off" disabled>
                    <label for="zip_code">Post Code/City Area</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-material">
                    <label for="phone">Home Address Phone</label>
                    <input value="{{ $lead->phone }}" type="text" class="form-control" name="phone" id="phone" autocomplete="off" disabled>
                </div>
            </div>
        </div>

        {{-- Right Side --}}
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-material">
                    <input value="{{ $lead->highest_edu }}" type="text" class="form-control" id="highest_edu" name="highest_edu" autocomplete="off" disabled>
                    <label for="highest_edu">Current Education Grade</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-material">
                    <input value="{{ $lead->precur_school }}" type="text" class="form-control" id="precur_school" name="precur_school" autocomplete="off" disabled>
                    <label for="precur_school">Name of Previous / Current School</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-material">
                    <input value="{{ $lead->major_interested }}" type="text" class="form-control" id="major_interested" name="major_interested" autocomplete="off" disabled>
                    <label for="major_interested">Major Interested</label>
                </div>
            </div>

            <div class="form-group">
                <div class="form-material">
                        <input value="{{ $lead->destination_of_study }}" type="text" class="form-control" id="destination_of_study" name="destination_of_study" autocomplete="off" disabled>
                    <label for="destination_of_study">Destination of Study</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-material">
                        <input value="{{ $lead->program_interested }}" type="text" class="form-control" id="program_interested" name="program_interested" autocomplete="off" disabled>
                    <label for="program_interested">Program Interested</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-material">
                    <input value="{{ $lead->planning_year }}" type="text" class="form-control" id="planning_year" name="planning_year" autocomplete="off" disabled>
                    <label for="planning_year">Planning Year</label>
                </div>
            </div>

            <div class="form-group">
                <div class="form-material">
                    <input value="{{ $lead->marketing_source }}" type="text" class="form-control" id="marketing_source" name="marketing_source" autocomplete="off" disabled>
                    <label for="marketing_source">Know this event from?</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-material">
                    <input value="{{ $lead->has_contact_sun ? 'Yes' : 'No' }}" type="text" class="form-control" id="has_contact_sun" name="has_contact_sun" autocomplete="off" disabled>
                    <label for="has_contact_sun">Ever Contact SUN Office?</label>
                </div>
            </div>
            <div class="form-group d-none">
                <div class="form-material" id="try">
                        <input value="{{ $lead->branch_name }}" type="text" class="form-control" id="knowThisEventFrom" name="knowThisEventFrom" autocomplete="off" disabled>
                    <label for="office">Office / Branch</label>
                </div>
            </div>
        </div>
    </div>
