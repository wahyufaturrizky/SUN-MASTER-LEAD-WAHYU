@extends('layouts.backend')

{{--  @section('css_after')
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
@endsection  --}}

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
                <h3 class="block-title">All Family</h3>
                <div class="block-options">
                    {{-- <button type="button" class="btn-block-option" data-toggle="modal" data-target="#modal-top">
                        <i class="si si-plus"></i>
                    </button> --}}
                <a href="{{ route('addForm') }}" type="button" class="btn-block-option">
                        <i class="si si-plus"></i>
                    </a>
                </div>
            </div>
            <div class="block-content">
                <!-- <p>The second way is to use <a href="be_ui_grid.html#cb-grid-rutil">responsive utility CSS classes</a> for hiding columns in various screen resolutions. This way you can hide less important columns and keep the most valuable on smaller screens. At the following example the <strong>Access</strong> column isn't visible on small and extra small screens and <strong>Email</strong> column isn't visible on extra small screens.</p> -->
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="">Nr.</th>
                            <th>Family ID</th>
                            <th class="">Email</th>
                            <th class="">Address</th>
                            <th class="">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($families as $i => $family)
        
                        <tr>
                            <td class=""> {{ $i + 1 }}</td>
                            <td class=""> {{ $family->familyCard_id }} </td>
                            <td class=""> {{ $family->email }} </td>
                            <td class=""> {{ $family->address }}</td>

                            {{-- <td class="d-none d-sm-table-cell">{{  $form->participantCount->count() }}</td>
                            
                            <td class="d-none d-sm-table-cell">/{{ $form->category }}</td>
                            <td class="d-none d-sm-table-cell">/{{ $form->slug }}</td> --}}
                            <td class="">
                                <div class="btn-group">
                                    {{--  <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="Edit">  --}}
                                        {{-- <a href="{{ route('editForm', $form->form_id) }}" class="btn btn-sm btn-alt-primary pull-right"><i class="si si-pencil"></i></a>  &nbsp &nbsp
                                        <a href="{{ route('eventForm', $form->slug) }}" class="btn btn-sm btn-success pull-right"><i class="fa fa-register"></i>R</a>  &nbsp &nbsp --}}
                                        
                                        <a href="{{ route('viewFamily', $family->id_families) }}" class="btn btn-sm btn-info pull-right"><i class="fa fa-eye"></i></a>  &nbsp &nbsp  
                                        <a href="{{ route('deleteFamily', $family->id_families) }}" class="btn btn-sm btn-alt-danger pull-right"><i class="si si-trash"></i></a>  &nbsp &nbsp
                                      
                                    {{--  </button>  --}}
                                    {{--  <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="tooltip" title="Delete">
                                        <i class="fa fa-times"></i>
                                    </button>  --}}
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
                        {{-- {{ $forms->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->

@endsection

@section('js_after')
    <!-- url slug generator -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/speakingurl/14.0.1/speakingurl.min.js"></script>
    <script src="{{ asset('vendor/leocaseiro/jquery.stringtoslug.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready( function() {
            $("#material-form-name").stringToSlug();
        });
    </script>
@endsection