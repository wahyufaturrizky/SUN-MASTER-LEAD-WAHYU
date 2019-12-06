<!-- Static Labels -->
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Suntrack - {{ $lead->full_name }} - {{ $lead->leads_id }}</h3>
        <div class="block-options hide d-none">
            <button type="button" class="btn-block-option">
                <i class="si si-wrench"></i>
            </button>
        </div>
    </div>
    <div class="block-content">
        <form action="be_forms_elements_material.html" method="post" onsubmit="return false;">
            {{-- <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->leads_id }}" type="text" class="form-control" id="leads-id" name="leads-id" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="leads-id">Leads ID</label>
                    </div>
                </div>
            </div> --}}
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->full_name }}" type="text" class="form-control" id="mobile" name="mobile" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="mobile">Full Name</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material">
                        <input value="{{ $lead->gender }}" type="email" class="form-control" id="material-email" name="material-email" placeholder="Please enter your email" {{ $disabled ? 'disabled' : '' }}>
                        <label for="material-email">Gender</label>
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
                <div class="col-12">
                    <div class="form-material">
                        <input value="{{ $lead->email }}" type="email" class="form-control" id="material-email" name="material-email" placeholder="Please enter your email" {{ $disabled ? 'disabled' : '' }}>
                        <label for="material-email">Email</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material">
                        <input value="{{ $lead->telephone }}" type="email" class="form-control" id="material-email" name="material-email" placeholder="Please enter your email" {{ $disabled ? 'disabled' : '' }}>
                        <label for="material-email">Telephone</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material">
                        <input value="{{ $lead->mobile_phone }}" type="email" class="form-control" id="material-email" name="material-email" placeholder="Please enter your email" {{ $disabled ? 'disabled' : '' }}>
                        <label for="material-email">Mobile Phone</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material">
                        <textarea class="form-control" id="full-address" name="full-address" rows="3" placeholder="Please add a comment">{{ $lead->address }}</textarea {{ $disabled ? 'disabled' : '' }}>
                        <label for="full-address">Address</label>
                    </div>
                </div>
            </div>
            {{-- <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->zip_code }}" type="text" class="form-control" id="postal-code" name="postal-code" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="postal-code">Post Code/ City Area</label>
                    </div>
                </div>
            </div> --}}
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
                        <input value="{{ $lead->parents_phone }}" type="text" class="form-control" id="parents-mobile-phone" name="parents-mobile-phone" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="parents-mobile-phone">Parent's Phone</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->marketing_source_type }}" type="text" class="form-control" id="marketing-source" name="marketing-source" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="marketing-source">Marketing Source</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->type_student }}" type="text" class="form-control" id="marketing-source" name="marketing-source" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="marketing-source">Type of Student</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $lead->intake}}" type="text" class="form-control" id="marketing-source" name="marketing-source" placeholder="" {{ $disabled ? 'disabled' : '' }}>
                        <label for="marketing-source">Intake</label>
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
