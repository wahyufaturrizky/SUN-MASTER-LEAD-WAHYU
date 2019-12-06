<nav id="sidebar2">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li>
                    <a class="{{ request()->is('schools/sma*') ? ' active' : '' }}" href="{{ route('getDataByTypeSchool', 'sma') }}" style="font-size: 12px">
                        <i class="fa fa-circle"></i><span class="sidebar-mini-hide">SMA</span>
                        {{-- <span class="badge badge-pill badge-primary text-right pull-right">{{ $count['sma'] }}</span> --}}
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('schools/smk*') ? ' active' : '' }}" href="{{ route('getDataByTypeSchool', 'smk') }}" style="font-size: 12px">
                        <i class="fa fa-circle"></i><span class="sidebar-mini-hide">SMK</span>
                        {{-- <span class="badge badge-pill badge-primary text-right pull-right">{{ $count['smk'] }}</span> --}}
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('schools/sekolah-tinggi*') ? ' active' : '' }}" href="{{ route('getDataByTypeSchool', 'sekolah-tinggi') }}" style="font-size: 12px">
                        <i class="fa fa-circle"></i><span class="sidebar-mini-hide">Sekolah Tinggi</span>
                        {{-- <span class="badge badge-pill badge-primary text-right pull-right">{{ $count['sekolahTinggi'] }}</span> --}}
                    </a>
                </li>

                <li>
                    <a class="{{ request()->is('schools/akademi*') ? ' active' : '' }}" href="{{ route('getDataByTypeSchool', 'akademi') }}" style="font-size: 12px">
                        <i class="fa fa-circle"></i><span class="sidebar-mini-hide">Akademi</span>
                        {{-- <span class="badge badge-pill badge-primary text-right pull-right">{{ $count['akademi'] }}</span> --}}
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('schools/politeknik*') ? ' active' : '' }}" href="{{ route('getDataByTypeSchool', 'politeknik') }}" style="font-size: 12px">
                        <i class="fa fa-circle"></i><span class="sidebar-mini-hide">Politeknik</span>
                        {{-- <span class="badge badge-pill badge-primary text-right pull-right">{{ $count['politeknik'] }}</span> --}}
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('schools/institut*') ? ' active' : '' }}" href="{{ route('getDataByTypeSchool', 'institut') }}" style="font-size: 12px">
                        <i class="fa fa-circle"></i><span class="sidebar-mini-hide">Institut</span>
                        {{-- <span class="badge badge-pill badge-primary text-right pull-right">{{ $count['institut'] }}</span> --}}
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('schools/universitas*') ? ' active' : '' }}" href="{{ route('getDataByTypeSchool', 'universitas') }}" style="font-size: 12px">
                        <i class="fa fa-circle"></i><span class="sidebar-mini-hide">Universitas</span>
                        {{-- <span class="badge badge-pill badge-primary text-right pull-right">{{ $count['universitas'] }}</span> --}}
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('schools/other*') ? ' active' : '' }}" href="{{ route('getDataByTypeSchool', 'other') }}" style="font-size: 12px">
                        <i class="fa fa-circle"></i><span class="sidebar-mini-hide">Other</span>
                        {{-- <span class="badge badge-pill badge-primary text-right pull-right">{{ $count['smp'] }}</span> --}}
                    </a>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
