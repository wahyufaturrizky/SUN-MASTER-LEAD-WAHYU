@extends('layouts.backend')

{{--  @section('css_after')
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
@endsection  --}}

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Material Design -->
        {{--  <h2 class="content-heading">Detail</h2>  --}}
        @if(isset($error))
            <div class="alert alert-danger d-flex align-items-center justify-content-between mb-15" role="alert">
                <div class="flex-fill mr-10">
                    <p class="mb-0">{{ $error }}</p>
                </div>
                <div class="flex-00-auto">
                    <i class="fa fa-fw fa-2x fa-exclamation-triangle"></i>
                </div>
            </div>
        @endisset
        <div class="row">
            <div class="col-md-6">
                <!-- Static Labels -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Add Country</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-pencil"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form action="{{ route('addCountry') }}" method="POST">
                            @csrf
                            @include('pages.country.partials.form')

                            <div class="form-group row">
                                <div class="col-6">
                                    <a href="{{ route('indexCountry') }}" class="btn btn-alt-secondary pull-left"><i class="si si-arrow-left"></i> Back</a>
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

@endsection
