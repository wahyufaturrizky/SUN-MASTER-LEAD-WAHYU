<!-- Static Labels -->
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Sun Education Web  - {{ $lead->full_name }} - {{ $lead->registration_id }}</h3>
        <div class="block-options hide d-none">
            <button type="button" class="btn-block-option">
                <i class="si si-wrench"></i>
            </button>
        </div>
    </div>
    <div class="block-content">
        <form action="be_forms_elements_material.html" method="post" onsubmit="return false;">
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->registration_id }}" type="text" class="form-control" id="leads-id" name="leads-id" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="leads-id">ID</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->mobile }}" type="text" class="form-control" id="mobile" name="mobile" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="mobile">Mobile Phone</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material">
                        <input value="{{ $lead->email }}" type="email" class="form-control" id="material-email" name="material-email" placeholder="Please enter your email" {{ $disabled ? 'disabled' : '' }}>
                        <label for="material-email">Email</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->birth }}" type="text" class="form-control" id="birth" name="birth" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="birth">Date of Birth</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->parents_name }}" type="text" class="form-control" id="parent-name" name="parent-name" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="parent-name">Parent's Name</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->parents_mobile }}" type="text" class="form-control" id="parents-mobile-phone" name="parents-mobile-phone" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="parents-mobile-phone">Parents Mobile Phone</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->overseas_number }}" type="text" class="form-control" id="overseas-phone" name="overseas-phone" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="overseas-phone">Overseas Phone</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material">
                        <textarea class="form-control" id="full-address" name="full-address" readonly="readonly" rows="3" placeholder="Please add a comment">{{ $lead->address }}</textarea {{ $disabled ? 'disabled' : '' }}>
                        <label for="full-address">Full Address</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->zip_code }}" type="text" class="form-control" id="postal-code" name="postal-code" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="postal-code">Post Code/ City Area</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->phone }}" type="text" class="form-control" id="phone" name="phone" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="phone">Home Address Phone</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->highest_edu }}" type="text" class="form-control" id="highest-edu" name="highest-edu" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="highest-edu">Current Education Grade</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->precur_school }}" type="text" class="form-control" id="precur-school" name="precur-school" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="precur-school">Previous / Current School</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->major_interested }}" type="text" class="form-control" id="major-interested" name="major-interested" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="major-interested">Major Interested</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->destination_of_study }}" type="text" class="form-control" id="destination-of-study" name="destination-of-study" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="destination-of-study">Destination of Study</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->program_interested }}" type="text" class="form-control" id="program-interested" name="program-interested" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="program-interested">Program Interested</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->planning_year }}" type="text" class="form-control" id="planning-year" name="planning-year" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="planning-year">Planning Year</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->marketing_source }}" type="text" class="form-control" id="marketing-source" name="marketing-source" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="marketing-source">Marketing Source</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->has_contact_sun }}" type="text" class="form-control" id="has-contact-sun" name="has-contact-sun" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="has-contact-sun">Ever Contact SUN Office?</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->is_sun_property }}" type="text" class="form-control" id="sun-property" name="sun-property" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="sun-property">SUN Property?</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->is_scholarship }}" type="text" class="form-control" id="full-scholarship-seeker" name="full-scholarship-seeker" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="full-scholarship-seeker">Full scholarship seeker?</label>
                    </div>
                </div>
            </div>
            <div class="form-group row d-none hide">
                <div class="col-md-9">
                    <button type="submit" class="btn btn-alt-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- END Static Labels -->