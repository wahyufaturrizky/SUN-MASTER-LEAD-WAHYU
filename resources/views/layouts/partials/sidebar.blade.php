<div class="content-side content-side-full">
    <ul class="nav-main">
        {{-- @can('open_page_dashboard') --}}
        <li>
            <a class="{{ request()->is('dashboard*') ? ' active' : '' }}" href="/dashboard">
                <i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span>
            </a>
        </li>
        {{-- @endcan --}}
        @can('open_page_leads')
        <li>
            <a class="{{ request()->is('leads*') ? ' active' : '' }}" href="/leads">
                <i class="si si-users"></i><span class="sidebar-mini-hide">Leads</span>
            </a>
        </li>
        @endcan
        @can('open_page_schools')
        <li class="{{ request()->is('schools*') ? ' open' : '' }}">
            <a class="nav-submenu {{ request()->is('schools*') ? ' active' : '' }}" data-toggle="nav-submenu" href="#">
                <i class="si si-graduation"></i><span class="sidebar-mini-hide">School</span>
            </a>
            {{-- <a class="nav-submenu"><i class="si si-moustache"></i><span class="sidebar-mini-hide">University</span></a> --}}
            <ul>
                <li>
                    <a href="{{ route('indexSchool') }}" class="{{ request()->is('schools') ? ' active' : '' }}">All School</a>
                </li>
                <li>
                    <a href="{{ route('indexSchoolType') }}" class="{{ request()->is('schools/school-types*') ? ' active' : '' }}">School Type</a>
                </li>
            </ul>
        </li>
        @endcan
        @can('open_page_postal_code')
        <li>
            <a class="{{ request()->is('postal-codes*') ? ' active' : '' }}" href="/postal-codes">
                <i class="si si-graduation"></i><span class="sidebar-mini-hide">Postal Code</span>
            </a>
        </li>
        @endcan
        @can('open_page_field_of_study')
        <li>
            <a class="{{ request()->is('field-of-studies*') ? ' active' : '' }}" href="{{ route('indexFieldOfStudy') }}">
                <i class="si si-graduation"></i><span class="sidebar-mini-hide">Field Of Study</span>
            </a>
        </li>
        @endcan
        @can('open_page_major')
        <li>
            <a class="{{ request()->is('majors*') ? ' active' : '' }}" href="{{ route('indexMajor') }}">
                <i class="si si-graduation"></i><span class="sidebar-mini-hide">Major</span>
            </a>
        </li>
        @endcan
        @can('open_page_event')
        <li class="{{ request()->is('events*') ? ' open' : '' }}">
            <a class="nav-submenu {{ request()->is('events*') ? ' active' : '' }}" data-toggle="nav-submenu" href="#">
                <i class="si si-book-open"></i><span class="sidebar-mini-hide">Event</span>
            </a>
            {{-- <a class="nav-submenu"><i class="si si-moustache"></i><span class="sidebar-mini-hide">University</span></a> --}}
            <ul>
                <li>
                    <a href="{{ route('getDataByTypeEvents') }}" class="{{ request()->is('events') ? ' active' : '' }}">All Event</a>
                </li>
                <li>
                    <a href="{{ route('indexEventGroup') }}" class="{{ request()->is('events/group*') ? ' active' : '' }}">Group</a>
                </li>
            </ul>
        </li>
        @endcan
        @can('open_page_branch')
        {{-- <li>
            <a class="{{ request()->is('branches*') ? ' active' : '' }}" href="{{ route('indexBranch') }}">
                <i class="si si-diamond"></i><span class="sidebar-mini-hide">Branch</span>
            </a>
        </li> --}}
        <li class="{{ request()->is('branches*') ? ' open' : '' }}">
            <a class="nav-submenu {{ request()->is('branches*') ? ' active' : '' }}" data-toggle="nav-submenu" href="#">
                <i class="si si-diamond"></i><span class="sidebar-mini-hide">Branch</span>
            </a>
            <ul>
                <li>
                    <a href="{{ route('indexBranchSunEducation') }}" class="{{ request()->is('branches/sun-edu*') ? ' active' : '' }}">Sun Education</a>
                </li>
                <li>
                    <a href="{{ route('indexBranchSunEnglish') }}" class="{{ request()->is('branches/sun-eng*') ? ' active' : '' }}">Sun English</a>
                </li>
            </ul>
        </li>
        @endcan
        @can('open_page_country')
        <li>
            <a class="{{ request()->is('countries*') ? ' active' : '' }}" href="{{ route('indexCountry') }}">
                <i class="si si-globe-alt"></i><span class="sidebar-mini-hide">Country</span>
            </a>
        </li>
        @endcan
        @can('open_page_marketing_source')
        <li>
            <a class="{{ request()->is('marketing-sources*') ? ' active' : '' }}" href="{{ route('indexMarketingSource') }}">
                <i class="si si-globe-alt"></i><span class="sidebar-mini-hide">Marketing Source</span>
            </a>
        </li>
        @endcan

        @can('open_page_institution')
        <li class="{{ request()->is('institutions*') ? ' open' : '' }}">
            <a class="nav-submenu {{ request()->is('institutions*') ? ' active' : '' }}" data-toggle="nav-submenu" href="#">
                <i class="fa fa-building-o"></i><span class="sidebar-mini-hide">Institution</span>
            </a>
            {{-- <a class="nav-submenu"><i class="si si-moustache"></i><span class="sidebar-mini-hide">University</span></a> --}}
            <ul>
                <li>
                    <a href="{{ route('indexInstitution') }}" class="{{ request()->is('institutions') ? ' active' : '' }}">All Institution</a>
                </li>
                @can('open_page_institution_group')
                <li>
                    <a href="{{ route('indexInstitutionGroup') }}" class="{{ request()->is('institutions/group*') ? ' active' : '' }}">Group</a>
                </li>
                @endcan
                @can('open_page_institution_contact')
                <li>
                    <a href="{{ route('indexInstitutionContact') }}" class="{{ request()->is('institutions/contact*') ? ' active' : '' }}">Contact</a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('open_page_users')
        <li class="{{ request()->is('users*') ? ' open' : '' }}">
            <a class="nav-submenu {{ request()->is('institutions*') ? ' active' : '' }}" data-toggle="nav-submenu" href="#">
                <i class="si si-book-open"></i><span class="sidebar-mini-hide">Users</span>
            </a>
            {{-- <a class="nav-submenu"><i class="si si-moustache"></i><span class="sidebar-mini-hide">University</span></a> --}}
            <ul>
                <li>
                    <a href="{{ route('indexUser') }}" class="{{ request()->is('users') ? ' active' : '' }}">All User</a>
                </li>
                {{-- <li>
                    <a href="{{ route('indexRoleUser') }}" class="{{ request()->is('users/role*') ? ' active' : '' }}">Role</a>
                </li>
                <li>
                    <a href="{{ route('indexPermissionUser') }}" class="{{ request()->is('users/permission') ? ' active' : '' }}">Permission</a>
                </li> --}}
            </ul>
        </li>
        @endcan
        {{-- <li>
            <a class="{{ request()->is('family') ? ' active' : '' }}" href="/family">
                <i class="si si-home"></i><span class="sidebar-mini-hide">Family</span>
            </a>
        </li> --}}
        {{-- <li class="nav-main-heading">
            <span class="sidebar-mini-visible">VR</span><span class="sidebar-mini-hidden">The Next</span>
        </li> --}}
        {{-- <li class="{{ request()->is('examples/*') ? ' open' : '' }}">
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-bulb"></i><span class="sidebar-mini-hide">Examples</span></a>
            <ul>
                <li>
                    <a class="{{ request()->is('examples/plugin') ? ' active' : '' }}" href="/examples/plugin">Plugin</a>
                </li>
                <li>
                    <a class="{{ request()->is('examples/blank') ? ' active' : '' }}" href="/examples/blank">Blank</a>
                </li>
            </ul>
        </li> --}}
        {{-- <li class="nav-main-heading">
            <span class="sidebar-mini-visible">MR</span><span class="sidebar-mini-hidden">More</span>
        </li>
        <li>
            <a href="/">
                <i class="si si-globe"></i><span class="sidebar-mini-hide">Landing</span>
            </a>
        </li> --}}
    </ul>
</div>
