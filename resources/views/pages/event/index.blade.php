@extends('layouts.backend')

@section('css_after')
    {{-- <link rel="stylesheet" href="{{ asset('/css/custom.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('/css/sub-sidebar.css') }}">
@endsection

@section('sub-sidebar')
    @include('pages.event.partials.sidebar')
@endsection


@section('content')
    <!-- Page Content -->
    <div id="appVueMasterData" class="content">
        {{-- <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">Leads</h2>
            <h3 class="h5 text-muted mb-0">Welcome to your app.</h3>
        </div> --}}

        <!-- Partial Table -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $event_type_name }}</h3>
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
                    <a href="{{ route('addEvent') }}" class="btn btn-outline-primary">
                        Add Event
                    </a>
                </div>
            </div>
            <div class="block-content">
                <!-- <p>The second way is to use <a href="be_ui_grid.html#cb-grid-rutil">responsive utility CSS classes</a> for hiding columns in various screen resolutions. This way you can hide less important columns and keep the most valuable on smaller screens. At the following example the <strong>Access</strong> column isn't visible on small and extra small screens and <strong>Email</strong> column isn't visible on extra small screens.</p> -->
                <table id="tableEvent" class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Event Name</th>
                            {{-- <th class="d-none d-sm-table-cell">Participant</th> --}}
                            @if($event_type_name == 'All Event')
                                <th>Event Type</th>
                            @endif
                            <th>Event Date</th>
                            <th class="text-center">Participant</th>
                            {{-- <th class="d-none d-sm-table-cell">Slug</th> --}}
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if($events->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">Data Not Found</td>
                            </tr>
                        @else
                            @foreach($events as $i => $event)
                                <tr style="cursor: pointer" data-href="{{ route('indexEventRegistration', ['slug' => $event->eventType->slug, 'event_id' => $event->event_id]) }}">
                                    <td class="text-center">{{ $i + 1 }}</td>
                                    <td class="font-w600">{{ $event->event_name }}</td>
                                    {{-- <td class="d-none d-sm-table-cell">{{  $event->participantCount->count() }}</td> --}}
                                    @if($event_type_name == 'All Event')
                                        <td class="d-none d-sm-table-cell">{{ $event->eventType->event_type_name }}</td>
                                    @endif
                                    <td class="font-w600">{{ date_format(date_create($event->start_date), 'd M Y') }}</td>
                                    <td class="font-w600 text-center">{{ $event->eventRegistration->count() }}</td>
                                    {{-- <td class="d-none d-sm-table-cell">{{ $event->slug }}</td> --}}
                                    <td class="text-center">
                                        <div class="btn-group">
                                                <a href="{{ route('editEvent', $event->event_id) }}" class="btn btn-sm btn-alt-secondary mx-1 pull-right" data-toggle="tooltip" title="Edit Event"><i class="si si-pencil"></i></a>
                                                <a href="{{ route('deleteEvent', $event->event_id) }}" class="btn btn-sm btn-alt-secondary mx-1 pull-right" data-toggle="tooltip" title="Delete Event"><i class="si si-trash"></i></a>
                                                <a href="{{ route('linkRegistrationEvent', ['event_id' => $event->event_id, 'slug' => $event->slug, 'lang_id' => 'en']) }}" target="_blank" class="btn btn-sm btn-alt-secondary mx-1 pull-right" data-toggle="tooltip" title="Open Registration Link"><i class="si si-link"></i></a>
                                                <a href="{{ route('indexEventRegistration', ['slug' => $event->eventType->slug, 'event_id' => $event->event_id]) }}" class="btn btn-sm btn-alt-secondary mx-1 pull-right" data-toggle="tooltip" title="Open Registration Users"><i class="si si-users"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        @if(!$events->isEmpty() && $events->count() > 99)
            <div class="row justify-content-center text-center">
                <div class="col-md-auto">
                    <div class="block">
                        <div class="block-content">
                            {{ $events->links() }}
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

    <!-- Top Modal -->
    {{-- <div class="modal fade" id="modal-top" tabindex="-1" role="dialog" aria-labelledby="modal-top" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content">
                <form action="{{ route('addEvent') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Create Event</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="block-content">
                                @include('pages.event.partials.form.event')
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-alt-success">
                            <i class="fa fa-check"></i> Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
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


    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/pwstrength-bootstrap/pwstrength-bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-auto-complete/jquery.auto-complete.min.js') }}"></script>
    <script src="{{ asset('js/plugins/masked-inputs/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dropzonejs/dropzone.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/be_forms_plugins.min.js') }}"></script>

    <!-- Page JS Helpers (BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Input + Range Sliders + Tags Inputs plugins) -->
    <script>jQuery(function(){ Codebase.helpers(['datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider', 'tags-inputs']); });</script>
    <script>
        $('#tableEvent > tbody > tr').click(function() {
            window.document.location = $(this).data("href");
        });
    </script>
@endsection
