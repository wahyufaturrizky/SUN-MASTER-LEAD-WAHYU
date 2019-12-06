<nav id="sidebar2">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                {{-- <hr>
                    <a href="{{ route('getAllLeads') }}">All Leads <span class="badge badge-pill badge-primary text-right pull-right">{{ $count['sunnies'] + $count['suntrack'] + $count['mobileapp'] + $count['sun-edu-web'] + $count['sun-eng-web'] }}</span> </a>
                <hr> --}}
                @foreach ($fieldOfStudies as $fieldOfStudy)
                    <li>
                        <a class="align-items-center {{ request()->is('majors/' . $fieldOfStudy->field_of_study_id . '') ? ' active' : '' }}" href="{{ route('getDataByFieldOfStudyMajor', $fieldOfStudy->field_of_study_id) }}" style="font-size: 12px">
                            <i class="fa fa-circle"></i><span class="sidebar-mini-hide">{{ $fieldOfStudy->field_of_study_name }}</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $fieldOfStudy->majors->count() }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
