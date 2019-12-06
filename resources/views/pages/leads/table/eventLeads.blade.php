<div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">All Event</h3>
        </div>
        <div class="block-content">
            <table class="table table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Name</th>
                        <th>Event Type</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th class="text-center">Detail</th>
                    </tr>
                </thead>

                <tbody>
                    @if($leads->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">Data Not Found</td>
                        </tr>
                    @else
                        {{-- {{dd($leads)}} --}}
                        @foreach($leads as $i => $lead)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td class="font-w600">{{ $lead->full_name }}</td>
                                <td class="d-none d-sm-table-cell">{{ $lead->eventType->event_type_name }}</td>
                                <td class="font-w600">{{ $lead->mobile}}</td>
                                <td class="font-w600">{{ $lead->email}}</td>
                                <td class="d-none d-sm-table-cell">{{ date_format(date_create($lead->created_at), 'd M Y, H:i') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('getDataByID',['type' => 'workshop', 'id' => $lead->event_registration_id]) }}" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="View">
                                        <i class="si si-arrow-right"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
