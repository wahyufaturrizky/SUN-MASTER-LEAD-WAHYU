@extends('layouts.backend')

{{--  @section('css_after')
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
@endsection  --}}

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Material Design -->
        {{--  <h2 class="content-heading">Detail</h2>  --}}
        @if(isset($saved))
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <div class="block-content">
                            <div class="alert alert-success" role="alert">
                                Success
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
        <div class="row">
            <div class="col-md-6">
                <!-- Static Labels -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Edit - {{ $marketingSource->marketing_source_name }}</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-pencil"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form action="{{ route('updateMarketingSource') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $marketingSource->marketing_source_id }}" name="marketing_source_id">

                            @include('pages.marketingsource.partials.form')

                            <hr>
                            <div class="form-group row">
                                <div class="col-6">
                                    <a href="{{ route('indexMarketingSource') }}" class="btn btn-alt-secondary pull-left"><i class="si si-arrow-left"></i> Back</a>
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

    {{--  @if(isset($saved))  --}}
        <!-- Top Modal -->
        <div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
            <div class="modal-dialog modal-dialog-popin" role="document">
                <div class="modal-content modal-sm">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Terms &amp; Conditions</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-alt-success" data-dismiss="modal">
                            <i class="fa fa-check"></i> Perfect
                        </button>
                    </div>
                </div>
            </div>
        </div>
    {{--  @endif  --}}
@endsection

@section('js_after')
    {{--  @if(isset($saved))  --}}
        <script>
            $(document).ready(function() {
                // $('#modal-popin').modal('show');
            });
        </script>
    {{--  @endif  --}}
@endsection
