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
            
            <!-- JuduL -->
                <h3 class="block-title">Search Results</h3>
            <!-- Akhir Judul -->

            <!-- Cari Sekolah & University -->
            @include('pages.school.search')
            <!-- Akhir cari sekolah & university -->

            <!-- Tambah Sekolah -->
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="modal" data-target="#modal-top">
                        <i class="si si-plus"></i>
                    </button>
                </div>
            <!-- Akhir Tambah Sekolah -->
            </div>
 
            <div class="block-content">
                <!-- <p>{{ $schools->count() }} Result(s) for '{{ request()->input('query') }}'</p> -->
                
                
                @if($schools->count() > 0)
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center">Nr.</th>
                            <th>Name</th>
                            <th class="d-none d-sm-table-cell">Address</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schools as $i => $school)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td class="font-w600">{{ $school->name }}</td>
                            <td class="d-none d-sm-table-cell">{{ $school->address }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('editSchool', $school->school_id) }}" class="btn btn-sm btn-alt-primary pull-right"><i class="si si-pencil"></i></a>           
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <h1>{{ $schools->count() }} Result(s) for '{{ request()->input('query') }}'</h1>
                @endif
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-md-auto">
                <div class="block">
                    <div class="block-content">
                        {{ $schools->appends(request()->input())->links() }}
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