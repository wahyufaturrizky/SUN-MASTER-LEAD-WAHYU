@extends('layouts.backend')

@section('css_after')
{{-- <link rel="stylesheet" href="{{ asset('/css/custom.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('/js/plugins/select2/css/select2.min.css') }}">
@endsection 

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Material Design -->
        {{--  <h2 class="content-heading">Detail</h2>  --}}
        <div class="row">
            <div class="col-md-6">
                <!-- Static Labels -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Add Major</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-pencil"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form action="{{ route('addMajor') }}" method="POST">
                            @csrf
                            @include('pages.major.partials.form')

                            <div class="form-group row">
                                <div class="col-6">
                                    <a href="{{ route('indexMajor') }}" class="btn btn-alt-secondary pull-left"><i class="si si-arrow-left"></i> Back</a>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-alt-primary pull-right"><i class="si si-check"></i> Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Static Labels -->
            </div>
        </div>
        <!-- END Material Design -->
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    <script src="{{ asset('/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>jQuery(function(){ Codebase.helpers(['select2']); });</script>
@endsection