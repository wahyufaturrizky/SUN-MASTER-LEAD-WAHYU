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
                    <input value="{{ $user->studentName }}" type="text" class="form-control" id="studentName" name="studentName" readonly>
                        <label for="studentName">Student Name</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->educationGrade }}" type="text" class="form-control" id="educationGrade" name="educationGrade" readonly>
                        <label for="educationGrade">Current Education Grade</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-material">
                        <input value="{{ $user->mobilePhone }}" type="text" class="form-control" id="mobilePhone" name="mobilePhone" readonly>
                        <label for="mobilePhone">Mobile Phone</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->previousCurrentSchool }}" type="text" class="form-control" id="previousCurrentSchool" name="previousCurrentSchool" readonly>
                        <label for="previousCurrentSchool">Name of Previous / Current School</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->email }}" type="email" class="form-control" id="email" name="email" readonly>
                        <label for="parent-name">Email</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->majorInterested }}" type="text" class="form-control" id="majorInterested" name="majorInterested" readonly>
                        <label for="majorInterested">Major Interested</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->dateBirth }}" type="date" class="form-control" id="dateBirth" name="dateBirth" readonly>
                        <label for="overseas-phone">Date of Birth</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                 <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->destinationStudy }}" type="text" class="form-control" id="destinationStudy" name="destinationStudy" readonly>
                        <label for="destinationStudy">Destination of Study</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->gender }}" type="text" class="form-control" id="gender" name="gender" readonly>
                        <label for="gender">Gender</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->programInterested }}" type="text" class="form-control" id="programInterested" name="programInterested" readonly>
                        <label for="programInterested">Program Interested</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->parentsName }}" type="text" class="form-control" id="parentsName" name="parentsName" readonly>
                        <label for="parentsName">Parents Name</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->planningYear}}" type="text" class="form-control" id="planningYear" name="planningYear" readonly>
                        <label for="planningYear">Planing Year</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->majorInterested }}" type="text" class="form-control" id="majorInterested" name="majorInterested" readonly>
                        <label for="majorInterested">Major Interested</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->parentsMobilePhone }}" type="text" class="form-control" id="parentsMobilePhone" name="parentsMobilePhone" readonly>
                        <label for="parentsMobilePhone">Parents Mobile Phone</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->programInterested }}" type="text" class="form-control" id="programInterested" name="programInterested" readonly>
                        <label for="programInterested">Program Interested</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->planningYear }}" type="text" class="form-control" id="planningYear" name="planningYear" readonly>
                        <label for="planningYear">Planning Year</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->fullAddress }}" type="text" class="form-control" id="fullAddress" name="fullAddress" readonly>
                        <label for="marketing-source">Full Address</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->postCode }}" type="text" class="form-control" id="postCode" name="postCode" readonly>
                        <label for="postCode">Post Code/City Area</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->homeAddressPhone }}" type="text" class="form-control" id="homeAddressPhone" name="homeAddressPhone" readonly>
                        <label for="homeAddressPhone">Home Address Phone</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <div class="form-material">
                        <input value="{{ $user->knowThisEvent }}" type="text" class="form-control" id="knowThisEvent" name="knowThisEvent">
                        <label for="knowThisEvent">Know this event from?</label>
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