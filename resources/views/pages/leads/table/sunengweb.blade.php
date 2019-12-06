
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Sun English Website</h3>
        <div class="block-options">
            @include('pages.leads.leadSearch')
        </div>
    </div>
    <div class="block-content">
    <table class="table table-striped table-vcenter table-hover">
            <thead>
                <tr>
                    {{-- <th class="text-center" style="width: 100px;"><i class="si si-user"></i></th> --}}
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th class="text-center" style="width: 100px;">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $lead)
                    <tr>
                        {{-- <td class="text-center">
                            <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar14.jpg" alt="">
                        </td> --}}
                        <td class="font-w600">{{ ucwords($lead->full_name) }}</td>
                        <td class="d-none d-sm-table-cell">{{ $lead->mobile }}</td>
                        <td class="d-none d-sm-table-cell">{{ $lead->email }}</td>
                        <td class="d-none d-sm-table-cell">{{ $lead->address }}</td>
                        <td class="d-none d-sm-table-cell">{{ date_format(date_create($lead->created_at), 'd M Y, H:i') }}</td>
                        <td class="text-center">
                            {{-- <div class="btn-group"> --}}
                                {{-- <a href="{{ route('getDataByID',['type' => $type, 'id' => $lead->leads_id]) }}" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="View"> --}}
                            <a href="{{ route('getDataByID',['type' => 'sun-eng-web', 'id' => $lead->registration_id]) }}" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="View">
                                    <i class="si si-arrow-right"></i>
                                </a>
                                {{-- <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </button> --}}
                            {{-- </div> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row justify-content-center text-center">
            <div class="col-md-auto">
                <div class="block">
                    <div class="block-content">
                        {{ $leads->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
