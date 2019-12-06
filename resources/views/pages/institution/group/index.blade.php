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
            <div class="block-header block-header-default">
                <h3 class="block-title">All Institution Group</h3>
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
                    <a href="{{ route('addInstitutionGroup') }}" class="btn btn-outline-primary">
                        Add Group
                    </a>
                </div>
            </div>

            <div class="block-content">
                <!-- <p>The second way is to use <a href="be_ui_grid.html#cb-grid-rutil">responsive utility CSS classes</a> for hiding columns in various screen resolutions. This way you can hide less important columns and keep the most valuable on smaller screens. At the following example the <strong>Access</strong> column isn't visible on small and extra small screens and <strong>Email</strong> column isn't visible on extra small screens.</p> -->
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center">Nr.</th>
                            <th>Group Name</th>
                            <th>Institution</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($institutionGroups->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Data Not Found</td>
                            </tr>
                        @else
                            @foreach($institutionGroups as $institutionGroup)
                                <tr>
                                    <td class="text-center">{{ (($institutionGroups->currentPage() - 1 ) * $institutionGroups->perPage() ) + $loop->iteration }}</td>
                                    <td class="font-w600">{{ $institutionGroup->institution_group_name }}</td>
                                    <td class="font-w600">
                                        @foreach($institutionGroup->insitutions as $i => $detail)
                                            {{ $detail->institution->institution_name }},
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        {{-- <div class="btn-group"> --}}
                                            <a href="{{ route('editInstitutionGroup', $institutionGroup->institution_group_id) }}" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="Edit"><i class="si si-pencil"></i></a>
                                            <a href="{{ route('deleteInstitutionGroup', $institutionGroup->institution_group_id) }}" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="Delete"><i class="si si-trash"></i></a>
                                        {{-- </div> --}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-md-auto">
                <div class="block">
                    <div class="block-content">
                        {{ $institutionGroups->links() }}
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row justify-content-center">
            <div class="col-md-6 col-xl-5">
                <div class="block">
                    <div class="block-content">
                        <p class="font-size-sm text-muted">
                            Weâ€™ve put everything together, so you can start working on your Laravel project as soon as possible! Codebase assets are integrated and work seamlessly with Laravel Mix, so you can use the npm scripts as you would in any other Laravel project.
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
