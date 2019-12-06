@extends('layouts.backend')

@section('css_after')
    {{-- <link rel="stylesheet" href="{{ asset('/css/custom.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('/css/sub-sidebar.css') }}"> --}}
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Partial Table -->
        <div class="block">
            <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                @foreach($eventGroup->events as $i => $event)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : '' }}" href="#btabs-animated-{{ $event->slug }}-{{ $event->event_id }}">{{ $event->event_name }} ({{ $event->registrations->count() }})</a>
                </li>
                @endforeach
            </ul>
            <div class="block-content tab-content overflow-hidden">
                @foreach($eventGroup->events as $i => $event)
                <div class="tab-pane fade show {{ $i == 0 ? 'active' : '' }}" id="btabs-animated-{{ $event->slug }}-{{ $event->event_id }}" role="tabpanel">
                    <table class="table table-striped table-borderless table-vcenter">
                        <tbody>
                            @if($event->registrations->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">Data Not Found</td>
                                </tr>
                            @else
                                @foreach($event->registrations as $i => $lead)
                                    <tr>
                                        <td>
                                            <span class="font-size-h5 font-w600">{{ $lead->full_name }} ({{ $lead->register_id }})</span>
                                            <div class="text-muted my-5">
                                                {{-- Live at {{ $lead->address . ', ' . $lead->kelurahan . ', ' . $lead->kecamatan . ', ' . $lead->kabupaten . ', ' . $lead->propinsi }}. Interested in studying abroad in the field of {{ $lead->major_interested }} in {{ $lead->destination_of_study }}, plan in {{ $lead->planning_year }}. Previous/ Current School at {{ $lead->precur_school }}. --}}
                                                Live at {{ $lead->address . ', ' . $lead->kelurahan . ', ' . $lead->kecamatan . ', ' . $lead->kabupaten . ', ' . $lead->propinsi }}. DOB: {{ !is_null($lead->birth) ? date_format(date_create($lead->birth), 'd F Y') : '-' }}, Email: {{ !is_null($lead->email) ? $lead->email : '-' }}, Mobile phone: {{ !is_null($lead->mobile) ? $lead->mobile : '-' }}, Local phone: {{ !is_null($lead->phone) ? $lead->phone : '-' }}. Interested in studying abroad for {{ $lead->program_interested }} level in the major of {{ $lead->major_interested }} in {{ $lead->destination_of_study }}, plan in {{ $lead->planning_year }}. Previous/ Current School at {{ $lead->precur_school }}, {{ $lead->highest_edu }}. Known this event from {{ $lead->marketing_source }}, Ever contact with SUN : {{ $lead->has_contact_sun ? 'Yes' : 'No' }}
                                            </div>
                                        </td>
                                        <td class="d-none d-md-table-cell">
                                            <a href="{{ route('eventRegistrationDetailEventGroup', ['event_group_id' => $event->event_group_id, 'slug' => $event->eventType->slug, 'event_id' => $event->event_id, 'event_registration_id' => $lead->event_registration_id]) }}" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="View">
                                                <i class="si si-arrow-right"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                @endforeach

                <hr>
                <a href="{{ route('indexEventGroup') }}" class="btn btn-sm btn-alt-secondary mx-1 mb-5 pb-5" data-toggle="tooltip" title="View"><i class="si si-arrow-left"></i> Back</a>
            </div>
        </div>
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
