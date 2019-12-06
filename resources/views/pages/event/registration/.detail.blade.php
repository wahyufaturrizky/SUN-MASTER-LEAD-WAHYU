@extends('layouts.backend')

@section('css_after')
    <!-- <link rel="stylesheet" href="{{ asset('/css/custom.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('/css/sub-sidebar.css') }}">
@endsection

@section('sub-sidebar')
    @include('pages.event.partials.sidebar')
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        {{-- <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-0">Leads</h2>
            <h3 class="h5 text-muted mb-0">Welcome to your app.</h3>
        </div> --}}
        <div class="row">
            <div class="col-md-12">
                <!-- Static Labels -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Sunnies - {{ $eventRegistration->full_name }} - {{ $eventRegistration->leads_id }}</h3>
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
                                        <input value="{{ $eventRegistration->leads_id }}" type="text" class="form-control" id="leads-id" name="leads-id" placeholder="">
                                        <label for="leads-id">Leads ID</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->mobile }}" type="text" class="form-control" id="mobile" name="mobile" placeholder="">
                                        <label for="mobile">Mobile Phone</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->email }}" type="email" class="form-control" id="material-email" name="material-email" placeholder="Please enter your email">
                                        <label for="material-email">Email</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->birth }}" type="text" class="form-control" id="birth" name="birth" placeholder="">
                                        <label for="birth">Date of Birth</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->parents_name }}" type="text" class="form-control" id="parent-name" name="parent-name" placeholder="">
                                        <label for="parent-name">Parent's Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->parents_mobile }}" type="text" class="form-control" id="parents-mobile-phone" name="parents-mobile-phone" placeholder="">
                                        <label for="parents-mobile-phone">Parents Mobile Phone</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->overseas_number }}" type="text" class="form-control" id="overseas-phone" name="overseas-phone" placeholder="">
                                        <label for="overseas-phone">Overseas Phone</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material">
                                        <textarea class="form-control" id="full-address" name="full-address" rows="3" readonly="readonly" placeholder="Please add a comment">{{ $eventRegistration->address }}</textarea>
                                        <label for="full-address">Full Address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->zip_code }}" type="text" class="form-control" id="postal-code" name="postal-code" placeholder="">
                                        <label for="postal-code">Post Code/ City Area</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->phone }}" type="text" class="form-control" id="phone" name="phone" placeholder="">
                                        <label for="phone">Home Address Phone</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->highest_edu }}" type="text" class="form-control" id="highest-edu" name="highest-edu" placeholder="">
                                        <label for="highest-edu">Current Education Grade</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->precur_school }}" type="text" class="form-control" id="precur-school" name="precur-school" placeholder="">
                                        <label for="precur-school">Previous / Current School</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->major_interested }}" type="text" class="form-control" id="major-interested" name="major-interested" placeholder="">
                                        <label for="major-interested">Major Interested</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->destination_of_study }}" type="text" class="form-control" id="destination-of-study" name="destination-of-study" placeholder="">
                                        <label for="destination-of-study">Destination of Study</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->program_interested }}" type="text" class="form-control" id="program-interested" name="program-interested" placeholder="">
                                        <label for="program-interested">Program Interested</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->planning_year }}" type="text" class="form-control" id="planning-year" name="planning-year" placeholder="">
                                        <label for="planning-year">Planning Year</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->marketing_source }}" type="text" class="form-control" id="marketing-source" name="marketing-source" placeholder="">
                                        <label for="marketing-source">Marketing Source</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->has_contact_sun }}" type="text" class="form-control" id="has-contact-sun" name="has-contact-sun" placeholder="">
                                        <label for="has-contact-sun">Ever Contact SUN Office?</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->is_sun_property }}" type="text" class="form-control" id="sun-property" name="sun-property" placeholder="">
                                        <label for="sun-property">SUN Property?</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <div class="form-material">
                                        <input value="{{ $eventRegistration->is_scholarship }}" type="text" class="form-control" id="full-scholarship-seeker" name="full-scholarship-seeker" placeholder="">
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
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
