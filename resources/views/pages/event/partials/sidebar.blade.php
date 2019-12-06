<nav id="sidebar2">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li>
                    <a class="{{ request()->is('events') ? ' active' : '' }}" href="{{ route('getDataByTypeEvents', '') }}" style="font-size: 12px">
                        <i class="fa fa-circle"></i><span class="sidebar-mini-hide">All Event</span><span class="badge badge-pill badge-primary text-right pull-right">{{ App\Event::count() }}</span>
                    </a>
                </li>
                @foreach($eventTypes as $eventType)
                    <li>
                        <a class="{{ request()->is('events/' . $eventType->slug . '*') ? ' active' : '' }}" href="{{ route('getDataByTypeEvents', ['slug' => $eventType->slug]) }}" style="font-size: 12px">
                            <i class="fa fa-circle"></i><span class="sidebar-mini-hide">{{ $eventType->event_type_name }}</span><span class="badge badge-pill badge-primary text-right pull-right">{{ $eventType->event->count() }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>