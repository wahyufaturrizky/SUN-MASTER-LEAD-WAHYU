@extends('layouts.backend')

{{--  @section('css_after')
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
@endsection  --}}

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
                        <h3 class="block-title">Add User Group</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-pencil"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form action="{{ route('addUserGroup') }}" method="POST">
                            @csrf
                            @include('pages.user.group.partials.form')

                            <div class="form-group row">
                                <div class="col-6">
                                    <a href="{{ route('indexUserGroup') }}" class="btn btn-alt-secondary pull-left"><i class="si si-arrow-left"></i> Back</a>
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
