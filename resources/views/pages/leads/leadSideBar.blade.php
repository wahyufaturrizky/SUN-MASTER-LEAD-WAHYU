<nav id="sidebar2">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Side Navigation -->
            <div class="content-side content-side-full">
                <ul class="nav-main">
                    <hr>
                        <a href="{{ route('getAllLeads') }}">All Leads <span class="badge badge-pill badge-primary text-right pull-right">{{ $count['sunnies'] + $count['suntrack'] + $count['mobileapp'] + $count['sun-edu-web'] + $count['sun-eng-web'] }}</span> </a>
                    <hr>
                    {{-- <li>
                        <a class="{{ request()->is('leads') ? ' active' : '' }}" href="{{ route('getAllLeads') }}" style="font-size: 12px">
                            <i class="fa fa-circle"></i><span class="sidebar-mini-hide">All Leads</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['sunnies'] }}</span>
                        </a>
                    </li> --}}
                    <li>
                        <a class="{{ request()->is('leads/sunnies*') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'sunnies') }}" style="font-size: 12px">
                            <i class="fa fa-circle"></i><span class="sidebar-mini-hide">Sunnies</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['sunnies'] }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('leads/suntrack*') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'suntrack') }}" style="font-size: 12px">
                            <i class="fa fa-circle"></i><span class="sidebar-mini-hide">Suntrack</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['suntrack'] }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('leads/mobileapp*') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'mobileapp') }}" style="font-size: 12px">
                            <i class="fa fa-circle"></i><span class="sidebar-mini-hide">Mobile App</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['mobileapp'] }}</span>
                        </a>
                    </li>

                    {{--  <li>
                        <a class="{{ request()->is('leads/android*') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'android') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Android</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['android'] }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('leads/ios*') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'ios') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">IOS</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['ios'] }}</span>
                        </a>
                    </li>                                  --}}
                    {{--  <li>
                        <a class="{{ request()->is('leads/sun-edu-web-general*') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'sun-edu-web-general') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Sun Edu Web General</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['sun-edu-web-general'] }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('leads/sun-edu-web-apply*') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'sun-edu-web-apply') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Sun Edu Web Apply</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['sun-edu-web-apply'] }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('leads/sun-eng-web-general*') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'sun-eng-web-general') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Sun English Web</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['sun-eng-web-general'] }}</span>
                        </a>
                    </li>                                  --}}
                    <li>
                        <a class="{{ request()->is('leads/sun-edu-web*') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'sun-edu-web') }}" style="font-size: 12px">
                            <i class="fa fa-circle"></i><span class="sidebar-mini-hide">Sun Edu Web</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['sun-edu-web'] }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('leads/sun-eng-web*') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'sun-eng-web') }}" style="font-size: 12px">
                            <i class="fa fa-circle"></i><span class="sidebar-mini-hide">Sun Eng Web</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['sun-eng-web'] }}</span>
                        </a>
                    </li>

                    <hr>
                        <a href="{{ route('getDataByTypeLeads', 'event-all') }}" >All Event <span class="badge badge-pill badge-primary text-right pull-right">{{ $count['event'] }}</span></a>
                    <hr>

                    <div>
                        <a class="{{ request()->is('leads/workshop*') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'workshop') }}" style="font-size: 12px">
                            <i class="fa fa-circle"></i><span class="sidebar-mini-hide">Workshop</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['workshop'] }}</span>
                        </a>
                        <a class="{{ request()->is('leads/seminar*') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'seminar') }}" style="font-size: 12px">
                            <i class="fa fa-circle"></i><span class="sidebar-mini-hide">Seminar</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['seminar'] }}</span>
                        </a>
                        <a class="{{ request()->is('leads/info-session*') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'info-session') }}" style="font-size: 12px">
                            <i class="fa fa-circle"></i><span class="sidebar-mini-hide">Info Session</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['info-session'] }}</span>
                        </a>
                        <a class="{{ request()->is('leads/sun-eng-event*') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'sun-eng-event') }}" style="font-size: 12px">
                            <i class="fa fa-circle"></i><span class="sidebar-mini-hide">Sun Eng Event</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['sun-eng-event'] }}</span>
                        </a>
                        <a class="{{ request()->is('leads/Sun-eng-class*') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'Sun-eng-class') }}" style="font-size: 12px">
                            <i class="fa fa-circle"></i><span class="sidebar-mini-hide">Sun Eng Class</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['Sun-eng-class'] }}</span>
                        </a>
                        <a class="{{ request()->is('leads/partner-event*') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'partner-event') }}" style="font-size: 12px">
                            <i class="fa fa-circle"></i><span class="sidebar-mini-hide">Partner Event</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['partner-event'] }}</span>
                        </a>
                        <a class="{{ request()->is('leads/school-expo*') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'school-expo') }}" style="font-size: 12px">
                            <i class="fa fa-circle"></i><span class="sidebar-mini-hide">School Expo</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $count['school-expo'] }}</span>
                        </a>
                    </div>

                    {{-- <li>
                        <a class="{{ request()->is('leads/other') ? ' active' : '' }}" href="{{ route('getDataByTypeLeads', 'other') }}" style="font-size: 12px">
                            <i class="fa fa-circle-o"></i><span class="sidebar-mini-hide">Other (From Import Excel)</span>
                        </a>
                    </li>    --}}

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
