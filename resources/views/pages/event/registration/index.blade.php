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
            <h2 class="font-w700 text-black mb-10">Leads</h2>
            <h3 class="h5 text-muted mb-0">Welcome to your app.</h3>
        </div> --}}

        <!-- Partial Table -->
        <div class="block">
            <div class="block-content">
                <h4 class="text-center">{{ $event->eventType->event_type_name }}</h4>
                <h5 class="text-center">{{ $event->event_name }}</h5>
            </div>
        </div>
        <div class="block">
            <div class="block-header block-header-default">
                <!-- <h3 class="block-title">Event Name: <strong>{{ $event->event_name }}</strong></h3> -->
                <div class="block-options">
                    <form method="GET" action="" class="search-form">
                        <div class="input-group">
                            <input value="{{ $search }}" type="text" class="form-control" id="query" name="search" placeholder="Search...">
                            <div class="input-group-append">
                                <button type="submit" class="btn input-group-text">
                                    <i class="si si-magnifier"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="block-options">
                    <a href="{{ route('linkRegistrationEvent', ['event_id' => $event->event_id, 'slug' => $event->slug, 'lang_id' => 'en']) }}" target="_blank" class="btn btn-outline-primary">
                        <i class="si si-link"></i> Registration Link
                    </a>
                </div>
            </div>
            <div class="block-content">
                <!-- <p>The second way is to use <a href="be_ui_grid.html#cb-grid-rutil">responsive utility CSS classes</a> for hiding columns in various screen resolutions. This way you can hide less important columns and keep the most valuable on smaller screens. At the following example the <strong>Access</strong> column isn't visible on small and extra small screens and <strong>Email</strong> column isn't visible on extra small screens.</p> -->
                <table class="table table-striped table-borderless table-vcenter">
                    <tbody>
                        @if($registrations->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Data Not Found</td>
                            </tr>
                        @else
                            @foreach($registrations as $i => $lead)
                                <tr>
                                    <td>
                                        <span class="font-size-h5 font-w600">{{ $lead->full_name }} ({{ $lead->register_id }})</span>
                                        <div class="text-muted my-5">
                                            {{-- Live at {{ $lead->address . ', ' . $lead->kelurahan . ', ' . $lead->kecamatan . ', ' . $lead->kabupaten . ', ' . $lead->propinsi }}. Interested in studying abroad in the field of {{ $lead->major_interested }} in {{ $lead->destination_of_study }}, plan in {{ $lead->planning_year }}. Previous/ Current School at {{ $lead->precur_school }}. --}}
                                            Live at {{ $lead->address . ', ' . $lead->kelurahan . ', ' . $lead->kecamatan . ', ' . $lead->kabupaten . ', ' . $lead->propinsi }}. DOB: {{ !is_null($lead->birth) ? date_format(date_create($lead->birth), 'd F Y') : '-' }}, Email: {{ !is_null($lead->email) ? $lead->email : '-' }}, Mobile phone: {{ !is_null($lead->mobile) ? $lead->mobile : '-' }}, Local phone: {{ !is_null($lead->phone) ? $lead->phone : '-' }}. Interested in studying abroad for {{ $lead->program_interested }} level in the major of {{ $lead->major_interested }} in {{ $lead->destination_of_study }}, plan in {{ $lead->planning_year }}. Previous/ Current School at {{ $lead->precur_school }}, {{ $lead->highest_edu }}. Known this event from {{ $lead->marketing_source }}, Ever contact with SUN : {{ $lead->has_contact_sun ? 'Yes' : 'No' }}
                                        </div>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <a href="{{ route('eventRegistrationDetail', ['slug' => $event->eventType->slug, 'event_id' => $event->event_id, 'event_registration_id' => $lead->event_registration_id]) }}" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="View">
                                            <i class="si si-arrow-right"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </table>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        @if(!$registrations->isEmpty() && $registrations->count() > 99)
            <div class="row justify-content-center text-center">
                <div class="col-md-auto">
                    <div class="block">
                        <div class="block-content">
                            {{ $registrations->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{-- <div class="row justify-content-center">
            <div class="col-md-6 col-xl-5">
                <div class="block">
                    <div class="block-content">
                        <p class="font-size-sm text-muted">
                            We’ve put everything together, so you can start working on your Laravel project as soon as possible! Codebase assets are integrated and work seamlessly with Laravel Mix, so you can use the npm scripts as you would in any other Laravel project.
                        </p>
                        <p class="font-size-sm text-muted">
                            Feel free to use any examples you like from the full versions to build your own pages. <strong>Wish you all the best and happy coding!</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    <!-- url slug generator -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/speakingurl/14.0.1/speakingurl.min.js"></script>
    <script src="{{ asset('vendor/leocaseiro/jquery.stringtoslug.min.js') }}"></script>

    <script type="text/javascript">

            $(document).ready(function () {
                $('.date').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose:true
                });
            });

            $(document).ready( function() {
                $("#material-form-name").stringToSlug();
            });
    </script>
@endsection
