@extends('layouts.backend')

@section('css_after')
    <link rel="stylesheet" href="{{ asset('/css/sub-sidebar.css') }}">
@endsection

@section('sub-sidebar')
    @include('pages.leads.leadSideBar')
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                @if($type == 'sunnies')
                    @include('pages.leads.detail.sunnies')
                @elseif($type == 'suntrack')
                    @include('pages.leads.detail.suntrack')
                @elseif($type == 'mobileapp')
                    @include('pages.leads.detail.mobileapp')
                @elseif($type == 'sun-edu-web')
                    @include('pages.leads.detail.suneduweb')
                @elseif($type == 'sun-eng-web')
                    @include('pages.leads.detail.sunengweb')
                @elseif($type == 'workshop')
                    @include('pages.leads.detail.workshop')
                @elseif($type == 'seminar')
                    @include('pages.leads.detail.seminar')
                @elseif($type == 'info-session')
                    @include('pages.leads.detail.infosession')
                @endif
            </div>
        </div>
    </div>
    <!-- END Page Content -->

    <!-- Top Modal -->
    <div class="modal fade" id="modal-top" tabindex="-1" role="dialog" aria-labelledby="modal-top" aria-hidden="true">
        <div class="modal-dialog modal-dialog-top" role="document">
            <div class="modal-content">
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
@endsection
