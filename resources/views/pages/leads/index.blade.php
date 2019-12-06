@extends('layouts.backend')

@section('css_after')
    <link rel="stylesheet" href="{{ asset('/css/sub-sidebar.css') }}">
@endsection

@section('sub-sidebar')
    @include('pages.leads.leadSideBar')
@endsection

@section('content')
    <!-- Page Content -->
    {{-- {{dd($leads)}} --}}
    <div class="content">
        @if($type == 'sunnies')
            @include('pages.leads.table.sunnies')
        @elseif($type == 'suntrack')
            @include('pages.leads.table.suntrack')
        @elseif($type == 'mobileapp')
            @include('pages.leads.table.mobileapp')
        @elseif($type == 'sun-edu-web')
            @include('pages.leads.table.suneduweb')
        @elseif($type == 'sun-eng-web')
            @include('pages.leads.table.sunengweb')
        {{-- @elseif($type == 'workshop')
            @include('pages.leads.table.workshop')
        @elseif($type == 'seminar')
            @include('pages.leads.table.seminar')
        @elseif($type == 'info-session')
            @include('pages.leads.table.infosession') --}}
        @elseif($type == '')
            @include('pages.leads.table.all')
        @else
            @include('pages.leads.table.eventLeads')
        @endif

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
