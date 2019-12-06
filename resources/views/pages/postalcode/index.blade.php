@extends('layouts.backend')

@section('css_after')
    {{-- <link rel="stylesheet" href="{{ asset('/css/custom.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('/css/sub-sidebar.css') }}"> --}}
@endsection

{{-- @section('sub-sidebar')
    @include('pages.postalcode.postalSideBar')
@endsection --}}

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Partial Table -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">All PostalCodes</h3>
                <div class="block-options">
                    @include('pages.postalcode.search')
                </div>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="modal" data-target="#modal-top">
                        <i class="si si-plus"></i>
                    </button>
                </div>
            </div>

            <div class="block-content">
                <!-- <p>The second way is to use <a href="be_ui_grid.html#cb-grid-rutil">responsive utility CSS classes</a> for hiding columns in various screen resolutions. This way you can hide less important columns and keep the most valuable on smaller screens. At the following example the <strong>Access</strong> column isn't visible on small and extra small screens and <strong>Email</strong> column isn't visible on extra small screens.</p> -->
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center">Nr.</th>
                            <th>Postal Code</th>
                            <th class="d-none d-sm-table-cell">State</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($postalCodes->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Data Not Found</td>
                            </tr>
                        @else
                            @foreach($postalCodes as $postalCode)
                                <tr>
                                    <td class="text-center">{{ (($postalCodes->currentPage() - 1 ) * $postalCodes->perPage() ) + $loop->iteration }}</td>
                                    <td class="font-w600">{{ $postalCode->postal_code_number }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $postalCode->kelurahan }}, {{ $postalCode->kecamatan }}, {{ $postalCode->kabupaten }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            {{--  <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="Edit">  --}}
                                                <a href="{{ route('editPostalCode', $postalCode->postal_code_id) }}" class="btn btn-sm btn-alt-primary pull-right"><i class="si si-pencil"></i></a>
                                            {{--  </button>  --}}
                                            {{--  <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="Delete">
                                                <i class="fa fa-times"></i>
                                            </button>  --}}
                                        </div>
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
                        {{ $postalCodes->links() }}
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
                <form action="{{ route('addPostalCode') }}" method="POST">
                    @csrf
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Add Postal Code</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material">
                                        <label for="material-text">Postal Code Number</label>
                                        <input maxlength="5" value="" type="text" class="form-control" id="material-text" name="postal_code_number" placeholder="Please enter postal code number" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material">
                                        <label for="material-textarea-small">Kelurahan</label>
                                        <input value="" type="text" class="form-control" id="material-text" name="kelurahan" placeholder="Please enter kelurahan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material">
                                        <label for="material-textarea-small">Kecamatan</label>
                                        <input value="" type="text" class="form-control" id="material-text" name="kecamatan" placeholder="Please enter kecamatan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material">
                                        <label for="material-textarea-small">Jenis (Kab/Kota)</label>
                                        <select name="jenis" class="form-control" required>
                                            <option value="">Select one</option>
                                            <option value="Kota">Kota</option>
                                            <option value="Kabupaten">Kabupaten</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material">
                                        <label for="material-textarea-small">Kabupaten</label>
                                        <input value="" type="text" class="form-control" id="material-text" name="kabupaten" placeholder="Please enter kabupaten" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material">
                                        <label for="material-textarea-small">Propinsi</label>
                                        <input value="" type="text" class="form-control" id="material-text" name="propinsi" placeholder="Please enter kabupaten" required>
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
                </form>
                {{-- <form action="{{ route('importPostalCode') }}" method="POST" enctype="multipart/form-data">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Import PostalCode</h3>
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
