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
                <h3 class="block-title">All Institution</h3>
                <div class="block-options">
                    <form method="GET" action="" class="search-form">
                        <div class="form-group pt-15">
                            <div class="input-group">
                                <div class="input-group-append mx-1">
                                    <select class="js-select2 form-control" id="country_id" value="{{ isset($country_id) ? $country_id : '' }}" name="country_id" data-placeholder="Filter by country..." data-allow-clear="true">
                                        <option value=""></option>
                                        @foreach($countries as $country)
                                            @isset($country_id)
                                                @if($country->country_code == $country_id)
                                                    <option value="{{ $country->country_code }}" selected>{{ $country->country_name }}</option>
                                                @else
                                                    <option value="{{ $country->country_code }}">{{ $country->country_name }}</option>
                                                @endif
                                            @else
                                                <option value="{{ $country->country_code }}">{{ $country->country_name }}</option>
                                            @endisset
                                        @endforeach
                                    </select>
                                </div>
                                <input value="{{ $search }}" type="text" class="form-control" id="query" name="search" placeholder="Search...">
                                <div class="input-group-append mx-1">
                                    <button type="submit" class="btn input-group-text">
                                        <i class="si si-magnifier"></i>
                                    </button>
                                </div>
                                <div class="input-group-append mx-1">
                                    <a href="{{ route('addInstitution') }}" class="ml-3 btn btn-outline-primary">
                                        Add Institution
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- <div class="block-options">
                    <a href="{{ route('addInstitution') }}" class="btn btn-outline-primary">
                        Add Institution
                    </a>
                </div> --}}
            </div>

            <div class="block-content">
                <!-- <p>The second way is to use <a href="be_ui_grid.html#cb-grid-rutil">responsive utility CSS classes</a> for hiding columns in various screen resolutions. This way you can hide less important columns and keep the most valuable on smaller screens. At the following example the <strong>Access</strong> column isn't visible on small and extra small screens and <strong>Email</strong> column isn't visible on extra small screens.</p> -->
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center">Nr.</th>
                            <th>Institution Name</th>
                            <th>Partnership</th>
                            <th>Acronym</th>
                            <th>Country</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($institutions->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Data Not Found</td>
                            </tr>
                        @else
                            @foreach($institutions as $institution)
                                <tr>
                                    <td class="text-center">{{ (($institutions->currentPage() - 1 ) * $institutions->perPage() ) + $loop->iteration }}</td>
                                    <td class="font-w600">{{ $institution->institution_name }}</td>
                                    <td class="font-w600 text-center">{{ $institution->is_partnership }}</td>
                                    <td class="font-w600">{{ $institution->acronym }}</td>
                                    <td class="font-w600">{{ !is_null($institution->country) ? $institution->country->country_name : '' }}</td>
                                    <td class="text-center">
                                        {{-- <div class="btn-group"> --}}
                                            <a href="{{ route('editInstitution', $institution->institution_id) }}" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="Edit"><i class="si si-pencil"></i></a>
                                            <a href="{{ route('deleteInstitution', $institution->institution_id) }}" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="Delete"><i class="si si-trash"></i></a>
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
                        {{ $institutions->links() }}
                    </div>
                </div>
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

@section('css_before')
    <link rel="stylesheet" href="{{ asset('/js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
    <script src="{{ asset('/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>jQuery(function(){ Codebase.helpers(['select2']); });</script>
@endsection
