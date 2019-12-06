@extends('layouts.backend')

@section('css_after')
    <link rel="stylesheet" href="{{ asset('/css/sub-sidebar.css') }}">
@endsection

@section('sub-sidebar')
    <nav id="sidebar2">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Side Navigation -->
            <div class="content-side content-side-full">
                <ul class="nav-main">
                    <li>
                        <a class="{{ request()->is('leads') ? ' active' : '' }}" href="{{ route('getAllLeads') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">All</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('leads/sunnies') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'sunnies') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Sunnies</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('leads/suntrack') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'suntrack') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Suntrack</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('leads/mobileapp') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'mobileapp') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Mobile App</span>
                        </a>
                    </li>
                    {{--  <li>
                        <a class="{{ request()->is('leads/android') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'android') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Android</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('leads/ios') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'ios') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">IOS</span>
                        </a>
                    </li>                                  --}}
                    {{--  <li>
                        <a class="{{ request()->is('leads/sun-edu-web-general') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'sun-edu-web-general') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Sun Edu Web General</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('leads/sun-edu-web-apply') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'sun-edu-web-apply') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Sun Edu Web Apply</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('leads/sun-eng-web-general') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'sun-eng-web-general') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Sun English Web</span>
                        </a>
                    </li>                                  --}}
                    <li>
                        <a class="{{ request()->is('leads/sun-edu-web') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'sun-edu-web') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Sun Edu Web</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('leads/sun-eng-web') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'sun-eng-web') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Sun Eng Web</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('leads/workshop') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'workshop') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Workshop</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('leads/seminar') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'seminar') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Seminar</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('leads/info-session') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'info-session') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Info Session</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('leads/other') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'other') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Other (From Import Excel)</span>
                        </a>
                    </li>

                    {{-- <li class="nav-main-heading">
                        <span class="sidebar-mini-visible">VR</span><span class="sidebar-mini-hidden">Various</span>
                    </li>
                    <li class="{{ request()->is('examples/*') ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-bulb"></i><span class="sidebar-mini-hide">Examples</span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('examples/plugin') ? ' active' : '' }}" href="/examples/plugin">Plugin</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('examples/blank') ? ' active' : '' }}" href="/examples/blank">Blank</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-heading">
                        <span class="sidebar-mini-visible">MR</span><span class="sidebar-mini-hidden">More</span>
                    </li>
                    <li>
                        <a href="/">
                            <i class="si si-globe"></i><span class="sidebar-mini-hide">Landing</span>
                        </a>
                    </li> --}}
                </ul>
            </div>
            <!-- END Side Navigation -->
        </div>
        <!-- Sidebar Content -->
    </nav>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        {{-- <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">Leads</h2>
            <h3 class="h5 text-muted mb-0">Welcome to your app.</h3>
        </div> --}}
        <div class="row">
            @php
                $arrWords = [
                    'Sunnies',
                    'Suntrack',
                    'Android',
                    'IOS',
                    'Sun Web',
                    'Sun Web Apply',
                    'Sun English Web',
                    'Workshop',
                    'Seminar',
                    'Info Session',
                    'Import Leads',
                ];
            @endphp
            @if($type == 'sunnies')
                @foreach($leads as $lead)
                    <div class="col-md-6 col-xl-4">
                        <a class="block block-link-shadow block-rounded ribbon ribbon-bookmark ribbon-left ribbon-success text-center" href="{{ route('getDataByID',['type' => $type, 'id' => $lead->leads_id]) }}">
                            {{--  <div class="ribbon-box">
                                    {{ $arrWords[array_rand($arrWords)] }}
                            </div>  --}}
                            <div class="block-content block-content-full">
                                <div class="item item-circle bg-gray-dark text-gray-lighter mx-auto my-20">
                                    {{ ucwords(substr($lead->full_name, 0, 1)) }}
                                </div>
                                <div class="font-size-sm text-muted" style="font-weight: bold; margin-top: -10px; font-size: 14px; ">{{ ucwords($lead->full_name) }}</div>
                                <div class="font-size-sm text-muted">{{ $lead->email }}</div>

                                @if($lead->status == 'UH' || $lead->status == 'UNHANDLED')
                                <div class="text-warning" style="margin-top: 10px" data-toggle="tooltip" data-placement="bottom" title="Unhandled">
                                    <i class="fa fa-fw fa-star"></i>
                                </div>
                                @elseif($lead->status == 'NP' || $lead->status == 'NOT PROSPECT')
                                <div class="text-warning" style="margin-top: 10px" data-toggle="tooltip" data-placement="bottom" title="Not Prospect">
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                </div>
                                @elseif($lead->status == 'FP' || $lead->status == 'FP')
                                <div class="text-warning" style="margin-top: 10px" data-toggle="tooltip" data-placement="bottom" title="Future Prospect">
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                </div>
                                @elseif($lead->status == 'P' || $lead->status == 'P')
                                <div class="text-warning" style="margin-top: 10px" data-toggle="tooltip" data-placement="bottom" title="Prospect">
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                </div>
                                @elseif($lead->status == 'HP' || $lead->status == 'HP')
                                <div class="text-warning" style="margin-top: 10px" data-toggle="tooltip" data-placement="bottom" title="Hot Prospect">
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                </div>
                                @elseif($lead->status == 'IP' || $lead->status == 'IN PROGRESS')
                                <div class="text-success" style="margin-top: 10px" data-toggle="tooltip" data-placement="bottom" title="Hot Prospect">
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                </div>
                                @else
                                    <i class="fa fa-fw"></i>
                                @endif

                            </div>
                            <div class="block-content block-content-full block-content-sm bg-body-light">
                                <div class="font-size-sm text-muted">{{ $lead->marketing_source }} • {{ $lead->planning_year }}</div>
                            </div>
                            <div class="block-content block-content-full">
                            <div class="font-w600">{{ $lead->kecamatan . ', ' . $lead->kabupaten . ', ' . $lead->provinsi }}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @elseif($type == 'suntrack')
                    {{--  uuid
                    leads_id
                    created_by
                    branch_uuid
                    student_id
                    full_name
                    gender
                    dob
                    email
                    telephone
                    mobile_phone
                    address
                    postcode
                    postal_code_uuid
                    parents_name
                    parents_phone
                    marketing_source_type
                    marketing_source_online
                    marketing_source_offline
                    marketing_source_event
                    marketing_source_detail
                    marketing_source_note
                    type_student
                    type_student_value
                    type_student_note
                    intake
                    notes
                    profile_image
                    status
                    is_cancel
                    is_student  --}}
                    {{--  $table->enum('type_student',['Corporate','Employee','Student'])->nullable();  --}}

                @foreach($leads as $lead)
                    <div class="col-md-6 col-xl-4">
                        <a class="block block-link-shadow block-rounded ribbon ribbon-bookmark ribbon-left ribbon-success text-center" href="">
                            {{--  <div class="ribbon-box">
                                    {{ $arrWords[array_rand($arrWords)] }}
                            </div>  --}}
                            <div class="block-content block-content-full">
                                <div class="item item-circle bg-gray-dark text-gray-lighter mx-auto my-20">
                                    {{ ucwords(substr($lead->full_name, 0, 1)) }}
                                </div>
                                <div class="font-size-sm text-muted" style="font-weight: bold; margin-top: -10px; font-size: 14px; ">{{ ucwords($lead->full_name) }}</div>
                                <div class="font-size-sm text-muted">{{ $lead->email }}</div>

                                <div style="margin-top: 10px" data-toggle="tooltip" data-placement="bottom" title="Unhandled">
                                    {{ $lead->status }}
                                </div>

                            </div>
                            <div class="block-content block-content-full block-content-sm bg-body-light">
                                <div class="font-size-sm text-muted">{{ $lead->marketing_source_type }} • {{ $lead->type_student }}</div>
                            </div>
                            <div class="block-content block-content-full">
                            <div class="font-w600">{{ $lead->address }}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @elseif($type == 'mobileapp')
                @foreach($leads as $lead)
                    <div class="col-md-6 col-xl-4">
                        <a class="block block-link-shadow block-rounded ribbon ribbon-bookmark ribbon-left ribbon-success text-center" href="">
                            {{--  <div class="ribbon-box">
                                    {{ $arrWords[array_rand($arrWords)] }}
                            </div>  --}}
                            <div class="block-content block-content-full">
                                <div class="item item-circle bg-gray-dark text-gray-lighter mx-auto my-20">
                                    {{ ucwords(substr($lead->name, 0, 1)) }}
                                </div>
                                <div class="font-size-sm text-muted" style="font-weight: bold; margin-top: -10px; font-size: 14px; ">{{ ucwords($lead->name) }}</div>
                                <div class="font-size-sm text-muted">{{ $lead->email }}</div>
                            </div>
                            <div class="block-content block-content-full block-content-sm bg-body-light">
                                <div class="font-size-sm text-muted">{{ $lead->user_type }}</div>
                            </div>
                            <div class="block-content block-content-full">
                            <div class="font-w600">{{ $lead->kecamatan . ', ' . $lead->kabupaten . ', ' . $lead->provinsi }}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                @foreach($leads as $lead)
                    <div class="col-md-6 col-xl-4">
                        <a class="block block-link-shadow block-rounded ribbon ribbon-bookmark ribbon-left ribbon-success text-center" href="">
                            {{--  <div class="ribbon-box">
                                    {{ $arrWords[array_rand($arrWords)] }}
                            </div>  --}}
                            <div class="block-content block-content-full">
                                <div class="item item-circle bg-gray-dark text-gray-lighter mx-auto my-20">
                                    {{ ucwords(substr($lead->full_name, 0, 1)) }}
                                </div>
                                <div class="font-size-sm text-muted" style="font-weight: bold; margin-top: -10px; font-size: 14px; ">{{ ucwords($lead->full_name) }}</div>
                                <div class="font-size-sm text-muted">{{ $lead->email }}</div>

                                @if($lead->status == 'UH' || $lead->status == 'UNHANDLED')
                                <div class="text-warning" style="margin-top: 10px" data-toggle="tooltip" data-placement="bottom" title="Unhandled">
                                    <i class="fa fa-fw fa-star"></i>
                                </div>
                                @elseif($lead->status == 'NP' || $lead->status == 'NOT PROSPECT')
                                <div class="text-warning" style="margin-top: 10px" data-toggle="tooltip" data-placement="bottom" title="Not Prospect">
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                </div>
                                @elseif($lead->status == 'FP' || $lead->status == 'FP')
                                <div class="text-warning" style="margin-top: 10px" data-toggle="tooltip" data-placement="bottom" title="Future Prospect">
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                </div>
                                @elseif($lead->status == 'P' || $lead->status == 'P')
                                <div class="text-warning" style="margin-top: 10px" data-toggle="tooltip" data-placement="bottom" title="Prospect">
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                </div>
                                @elseif($lead->status == 'HP' || $lead->status == 'HP')
                                <div class="text-warning" style="margin-top: 10px" data-toggle="tooltip" data-placement="bottom" title="Hot Prospect">
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                </div>
                                @elseif($lead->status == 'IP' || $lead->status == 'IN PROGRESS')
                                <div class="text-success" style="margin-top: 10px" data-toggle="tooltip" data-placement="bottom" title="Hot Prospect">
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                    <i class="fa fa-fw fa-star"></i>
                                </div>
                                @else
                                    <i class="fa fa-fw"></i>
                                @endif

                            </div>
                            <div class="block-content block-content-full block-content-sm bg-body-light">
                                <div class="font-size-sm text-muted">{{ $lead->marketing_source }} • {{ $lead->planning_year }}</div>
                            </div>
                            <div class="block-content block-content-full">
                            <div class="font-w600">{{ $lead->kecamatan . ', ' . $lead->kabupaten . ', ' . $lead->provinsi }}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-md-auto">
                <div class="block">
                    <div class="block-content">
                        {{ $leads->links() }}
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
