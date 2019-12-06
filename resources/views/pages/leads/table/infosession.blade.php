
{{-- <div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Info Session</h3>
        <div class="block-options"> --}}
            {{-- <button type="button" class="btn btn-sm btn-alt-secondary">Edit</button> --}}
            {{-- <button type="button" class="btn btn-sm btn-alt-secondary">Settings</button> --}}
            {{-- <form method="POST" action="{{ route('searchDataLeads') }}">
                @csrf
                <input type="hidden" name="type" value="sunnies">
                <div class="input-group">
                    <input name="search" type="text" class="form-control" id="material-addon-icon" name="material-addon-icon" placeholder="">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="si si-magnifier"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="block-content"> --}}
        {{-- <p>The second way is to use <a href="be_ui_grid.html#cb-grid-rutil">responsive utility CSS classes</a> for hiding columns in various screen resolutions. This way you can hide less important columns and keep the most valuable on smaller screens. At the following example the <strong>Access</strong> column isn't visible on small and extra small screens and <strong>Email</strong> column isn't visible on extra small screens.</p> --}}
        {{-- <table class="table table-striped table-vcenter table-hover">
            <thead>
                <tr> --}}
                    {{-- <th class="text-center" style="width: 100px;"><i class="si si-user"></i></th> --}}
                    {{-- <th>Name</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                    <th class="d-none d-md-table-cell" style="width: 15%;">Address</th>
                    <th class="text-center" style="width: 100px;">Detail</th>
                </tr>
            </thead>
            <tbody> --}}
                {{-- @foreach($leads as $lead) --}}
                    {{-- <tr> --}}
                        {{-- <td class="text-center">
                            <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar14.jpg" alt="">
                        </td> --}}
                        {{-- <td class="font-w600">{{ ucwords($lead->full_name) }}</td>
                        <td class="d-none d-sm-table-cell">{{ $lead->email }}</td>
                        <td class="d-none d-md-table-cell"> --}}
                            {{-- <span class="badge badge-primary">Personal</span> --}}
                            {{-- {{ $lead->address }} --}}
                        {{-- </td>
                        <td class="text-center"> --}}
                            {{-- <div class="btn-group"> --}}
                                {{-- <a href="{{ route('getDataByID',['type' => $type, 'id' => $lead->leads_id]) }}" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="View"> --}}
                                {{-- <a href="{{ route('getDataByID',['type' => 'info-session', 'id' => $lead->apply_event_id]) }}" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="View">
                                    <i class="si si-arrow-right"></i>
                                </a> --}}
                                {{-- <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </button> --}}
                            {{-- </div> --}}
                        {{-- </td>
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
</div> --}}


<div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Info Session</h3>
            <div class="block-options">
                @include('pages.leads.leadSearch')
            </div>
        </div>
        <div class="block-content">
            {{-- <p>The second way is to use <a href="be_ui_grid.html#cb-grid-rutil">responsive utility CSS classes</a> for hiding columns in various screen resolutions. This way you can hide less important columns and keep the most valuable on smaller screens. At the following example the <strong>Access</strong> column isn't visible on small and extra small screens and <strong>Email</strong> column isn't visible on extra small screens.</p> --}}
            <table class="table table-striped table-vcenter table-hover">
                <thead>
                    <tr>
                        {{-- <th class="text-center" style="width: 100px;"><i class="si si-user"></i></th> --}}
                        <th>Name</th>
                        <th>Events</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                    @if($lead->category == 'Info Session')
                        <tr>
                            {{-- <td class="text-center">
                                <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar14.jpg" alt="">
                            </td> --}}
                            <td>{{ ($lead->studentName) }}</td>
                            <td>{{ $lead->name }}</td>
                            <td>{{ $lead->mobilePhone }}</td>
                            <td>{{ $lead->email }}</td>
                            <td>
                                {{-- <div class="btn-group"> --}}
                                    {{-- <a href="{{ route('getDataByID',['type' => $type, 'id' => $lead->leads_id]) }}" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="View"> --}}
                                    <a href="{{ route('getDataByID',['type' => 'info-session', 'id' => $lead->id]) }}" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="View">
                                        <i class="si si-arrow-right"></i>
                                    </a>
                                    {{-- <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="Delete">
                                        <i class="fa fa-times"></i>
                                    </button> --}}
                                {{-- </div> --}}
                            </td>
                        </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>

            <div class="row justify-content-center text-center">
                <div class="col-md-auto">
                    <div class="block">
                        <div class="block-content">
                            {{-- {{ $leads->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
