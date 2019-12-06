@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Partial Table -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">All Country</h3>
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
                    <a href="{{ route('addCountry') }}" class="btn btn-outline-primary">
                        Add Country
                    </a>
                </div>
            </div>

            <div class="block-content">
                <!-- <p>The second way is to use <a href="be_ui_grid.html#cb-grid-rutil">responsive utility CSS classes</a> for hiding columns in various screen resolutions. This way you can hide less important columns and keep the most valuable on smaller screens. At the following example the <strong>Access</strong> column isn't visible on small and extra small screens and <strong>Email</strong> column isn't visible on extra small screens.</p> -->
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center">Nr.</th>
                            <th>Country Name</th>
                            <th>Country Code</th>
                            <th>SUN Destination</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($countries->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Data Not Found</td>
                            </tr>
                        @else
                            @foreach($countries as $country)
                                <tr>
                                    <td class="text-center">{{ (($countries->currentPage() - 1 ) * $countries->perPage() ) + $loop->iteration }}</td>
                                    <td class="font-w600">{{ $country->country_name }}</td>
                                    <td class="font-w600">{{ $country->country_code }}</td>
                                    <td class="font-w600">{{ $country->sun_destination }}</td>
                                    <td class="text-center">
                                        {{-- <div class="btn-group"> --}}
                                            <a href="{{ route('editCountry', $country->country_id) }}" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="Edit"><i class="si si-pencil"></i></a>
                                            <a href="{{ route('deleteCountry', $country->country_id) }}" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="Delete"><i class="si si-trash"></i></a>
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
                        {{ $countries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
