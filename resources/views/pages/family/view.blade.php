@extends('layouts.backend')

{{--  @section('css_after')
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
@endsection  --}}

@section('content')
{{-- Static Labels --}}
<div class="container mt-4">
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Student Detail</h3>
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
                    <input value="{{ $detail->familyCard_id }}" type="text" class="form-control" id="familyCard_id" name="familyCard_id" readonly>
                        <label for="familyCard_id">Family Card ID (No.KK)</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $detail->familyName }}" type="text" class="form-control" id="familyName" name="familyName" readonly>
                        <label for="familyName">Family Name</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material">
                        <input value="{{ $detail->email }}" type="email" class="form-control" id="email" name="email" readonly>
                        <label for="email">Email</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                 <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $detail->familyMobilePhone }}" type="text" class="form-control" id="familyMobilePhone" name="familyMobilePhone" readonly>
                        <label for="familyMobilePhone">Family Mobile Phone</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $detail->homeAddressPhone }}" type="text" class="form-control" id="homeAddressPhone" name="homeAddressPhone" readonly>
                        <label for="homeAddressPhone">Home Address Phone</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $detail->fatherName }}" type="text" class="form-control" id="fatherName" name="fatherName" readonly>
                        <label for="fatherName">Father Name</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $detail->dobf }}" type="date" class="form-control" id="dobf" name="dobf" readonly>
                        <label for="dobf">Father's Date of Birth </label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $detail->motherName }}" type="text" class="form-control" id="motherName" name="motherName" readonly>
                        <label for="motherName">Mother Name</label>
                    </div>
                </div>
            </div> 
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $detail->dobm }}" type="date" class="form-control" id="dobm" name="dobm" readonly>
                        <label for="dobm">Mother's Date of Birth</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $detail->postCode }}" type="text" class="form-control" id="postCode" name="postCode">
                        <label for="postCode">Postal Code</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $detail->address }}" type="text" class="form-control" id="address" name="address">
                        <label for="postCode">Postal Code</label>
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
</div>
<!-- END Static Labels -->
@endsection

@section('js_after')
    <!-- url slug generator -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/speakingurl/14.0.1/speakingurl.min.js"></script>
    <script src="{{ asset('vendor/leocaseiro/jquery.stringtoslug.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready( function() {
            $("#material-form-name").stringToSlug();
        });
    </script>
@endsection