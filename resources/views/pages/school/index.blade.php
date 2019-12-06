@extends('layouts.backend')

@section('css_after')
    {{-- <link rel="stylesheet" href="{{ asset('/css/custom.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('/css/sub-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('sub-sidebar')
    @include('pages.school.schoolSideBar')
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
            <div class="block-header block-header-default">
                <h3 class="block-title">All Schools</h3>
                <div class="block-options">
                    @include('pages.school.search')
                </div>
                <div class="block-options">
                    {{-- <button type="button" class="btn-block-option" data-toggle="modal" data-target="#modal-top">
                        <i class="si si-plus"></i>
                    </button> --}}
                    <a href="{{ route('addSchool') }}" class="btn btn-outline-primary">
                        Add School
                    </a>
                </div>
            </div>
            <div class="block-content">
                <!-- <p>The second way is to use <a href="be_ui_grid.html#cb-grid-rutil">responsive utility CSS classes</a> for hiding columns in various screen resolutions. This way you can hide less important columns and keep the most valuable on smaller screens. At the following example the <strong>Access</strong> column isn't visible on small and extra small screens and <strong>Email</strong> column isn't visible on extra small screens.</p> -->
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center">Nr.</th>
                            <th>Name</th>
                            <th>Type</th>
                            {{-- <th>Address</th> --}}
                            <th>City</th>
                            <th>Country</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schools as $school)
                        {{-- {{dd($school)}} --}}
                        <tr>
                            <td class="text-center">{{ (($schools->currentPage() - 1 ) * $schools->perPage() ) + $loop->iteration }}</td>
                            <td class="font-w600">{{ $school->name }}</td>
                            <td class="d-none d-sm-table-cell">
                                {{ !is_null($school->schoolType) ? $school->schoolType->name : '' }}
                            </td>
                            {{-- <td class="d-none d-sm-table-cell">{{ $school->address }}</td> --}}
                            <td class="d-none d-sm-table-cell">{{ $school->kabupaten }}</td>
                            <td class="d-none d-sm-table-cell">{{ $school->country->country_name }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('editSchool', $school->school_id) }}" class="btn btn-sm btn-alt-primary pull-right"><i class="si si-pencil"></i></a>
                                </div>

                                <div class="btn-group">

                                        <a onclick="return confirm('Are you sure to delete this school?')" href="{{ route('deleteSchool', $school->school_id) }}" class="btn btn-sm btn-alt-danger js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete"><i class="si si-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-md-auto">
                <div class="block">
                    <div class="block-content">
                        {{ $schools->links() }}
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

    <!-- Top Modal -->
    <div class="modal fade" id="modal-top" tabindex="-1" role="dialog" aria-labelledby="modal-top" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content">
                <form action="{{ route('addSchool') }}" method="POST">
                    @csrf
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Import School</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            @include('pages.school.partials.form')
                            {{-- <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material">
                                        <label for="material-text">School Name</label>
                                        <input value="" type="text" class="form-control" id="material-text" name="name" placeholder="Please enter school name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material">
                                        <label for="material-text">Type</label>
                                        <input value="" type="text" class="form-control" id="material-text" name="name" placeholder="Please enter school name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material">
                                        <label for="material-textarea-small">Address</label>
                                        <textarea class="form-control" id="material-textarea-small" name="address" rows="3" placeholder="Please enter address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material">
                                        <label for="material-textarea-small">Kelurahan</label>
                                        <input value="" type="text" class="form-control" id="material-text" name="kelurahan" placeholder="Please enter kelurahan">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material">
                                        <label for="material-textarea-small">Kecamatan</label>
                                        <input value="" type="text" class="form-control" id="material-text" name="kecamatan" placeholder="Please enter kecamatan">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material">
                                        <label for="material-textarea-small">Kabupaten</label>
                                        <input value="" type="text" class="form-control" id="material-text" name="kabupaten" placeholder="Please enter kabupaten">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material">
                                        <label for="material-textarea-small">Propinsi</label>
                                        <input value="" type="text" class="form-control" id="material-text" name="propinsi" placeholder="Please enter kabupaten">
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-alt-success">
                            <i class="fa fa-check"></i> Submit
                        </button>
                    </div>
                </form>
                {{-- <form action="{{ route('importSchool') }}" method="POST" enctype="multipart/form-data">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Import School</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="block-content">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-12">Excel File</label>
                                    <div class="col-12">
                                        <div class="custom-file">
                                            <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                            <input type="file" class="custom-file-input" id="example-file-input-custom" name="file" data-toggle="custom-file-input">
                                            <label class="custom-file-label" for="example-file-input-custom">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-alt-success">
                            <i class="fa fa-check"></i> Submit
                        </button>
                    </div>
                </form> --}}
            </div>
        </div>
    </div>
@endsection

@section('js_after')
    <script src="{{ asset('/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>jQuery(function(){ Codebase.helpers(['select2']); });</script>
@endsection
