@php(
    $logout_url = View::getSection('logout_url')
        ?? config('adminlte.logout_url', 'logout')
)

@php(
    $profile_url = View::getSection('profile_url')
        ?? config('adminlte.profile_url', 'logout')
)

@if (config('adminlte.usermenu_profile_url', false))
@php(
    $profile_url = Auth::user()->adminlte_profile_url()
)
@endif

@if (config('adminlte.use_route_url', false))

@php(
    $profile_url = $profile_url
        ? route($profile_url)
        : ''
)

@php(
        $logout_url = $logout_url
            ? route($logout_url)
            : ''
    )

@else

@php(
    $profile_url = $profile_url
        ? url($profile_url)
        : ''
)

@php(
    $logout_url = $logout_url
        ? url($logout_url)
        : ''
)

@endif

{{-- ============================================================
NOTIFICATION DATA (added)
============================================================ --}}
@php(
    $unreadNotifications = Auth::user()->unreadNotifications()->take(8)->get()
)
@php(
    $unreadCount = Auth::user()->unreadNotifications()->count()
)

{{-- ============================================================
NOTIFICATION MENU
============================================================ --}}
<li class="nav-item dropdown">

    <a href="#" class="nav-link" data-toggle="dropdown" title="ការជូនដំណឹង">

        <span class="position-relative">
            <i class="fas fa-bell" style="font-size: 18px;"></i>

            <span id="navbarNotifBadge" class="badge badge-danger navbar-badge"
                style="font-size: 9px; {{ $unreadCount === 0 ? 'display:none;' : '' }}">
                {{ $unreadCount }}
            </span>
        </span>

    </a>

    {{-- Notification Dropdown --}}
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        <li class="dropdown-header d-flex justify-content-between align-items-center">

            <span>ការជូនដំណឹង</span>

            @if($unreadCount > 0)
                <form action="{{ route('notifications.readAll') }}" method="POST" class="m-0">
                    @csrf

                    <button type="submit" class="btn btn-link btn-sm p-0" style="font-size: 11px;">
                        ធ្វើសញ្ញាអានទាំងអស់
                    </button>
                </form>
            @endif

        </li>

        @forelse($unreadNotifications as $notification)

            <li class="dropdown-divider"></li>

            <li>

                <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="m-0">

                    @csrf

                    <button type="submit" class="dropdown-item d-flex align-items-start text-wrap py-2"
                        style="white-space: normal;">

                        <i class="fas {{ $notification->data['icon'] ?? 'fa-bell' }}
                               {{ $notification->data['color'] ?? 'text-primary' }}
                               mr-2 mt-1"></i>

                        <span>

                            <strong style="font-size: 13px;">
                                {{ $notification->data['title'] ?? 'Notification' }}
                            </strong>

                            <br>

                            <small class="text-muted">
                                {{ $notification->data['message'] ?? '' }}
                            </small>

                            <br>

                            <small class="text-muted">
                                {{ $notification->created_at->diffForHumans() }}
                            </small>

                        </span>

                    </button>

                </form>

            </li>

        @empty

            <li class="dropdown-item text-center text-muted py-2">
                គ្មានការជូនដំណឹង
            </li>

        @endforelse

        <li class="dropdown-divider"></li>

        <li>
            <a href="{{ route('notifications.index') }}" class="dropdown-item text-center">
                មើលការជូនដំណឹងទាំងអស់
            </a>
        </li>

    </ul>

</li>


{{-- ============================================================
USER / PROFILE MENU
============================================================ --}}
<li class="nav-item dropdown user-menu">

    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown">

        {{-- User Information --}}
        <span class="d-flex flex-column mr-2" style="line-height: 1.2;">

            <span id="navbarUserName" style="font-size: 14px; font-weight: 600;">
                {{ Auth::user()->name }}
            </span>

            <small id="navbarDepartment" class="text-muted" style="font-size: 11px;">
                {{ Auth::user()->department->department_name ?? 'No Department' }}
            </small>

        </span>


        {{-- Profile Image --}}
        @if(config('adminlte.usermenu_image'))

            <img id="navbarUserAvatar" src="{{ Auth::user()->adminlte_image() }}" class="user-image img-circle elevation-2"
                alt="{{ Auth::user()->name }}" style="
                        width: 35px;
                        height: 35px;
                        object-fit: cover;
                     ">

        @endif

    </a>


    {{-- =========================================================
    PROFILE DROPDOWN
    ========================================================== --}}
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        {{-- User Menu Header --}}
        @if(
                    !View::hasSection('usermenu_header')
                    && config('adminlte.usermenu_header')
                )

                <li class="user-header
                        {{ config(
                'adminlte.usermenu_header_class',
                'bg-primary'
            ) }}
                        @if(!config('adminlte.usermenu_image'))
                            h-auto
                        @endif
                    ">

                    @if(config('adminlte.usermenu_image'))

                        <img id="dropdownUserAvatar" src="{{ Auth::user()->adminlte_image() }}" class="img-circle elevation-2"
                            alt="{{ Auth::user()->name }}" style="
                                        width: 90px;
                                        height: 90px;
                                        object-fit: cover;
                                     ">

                    @endif

                    <p>

                        <span id="dropdownUserName">
                            {{ Auth::user()->name }}
                        </span>

                        @if(config('adminlte.usermenu_desc'))

                            <small id="dropdownUserDepartment">
                                {{ Auth::user()->adminlte_desc() }}
                            </small>

                        @endif

                    </p>

                </li>

        @else

            @yield('usermenu_header')

        @endif


        {{-- Configured User Menu Links --}}
        @each(
            'adminlte::partials.navbar.dropdown-item',
            $adminlte->menu("navbar-user"),
            'item'
        )


        {{-- User Menu Body --}}
        @hasSection('usermenu_body')

            <li class="user-body">
                @yield('usermenu_body')
            </li>

        @endif


        {{-- User Menu Footer --}}
        <li class="user-footer">

            @if($profile_url)

                <a href="{{ $profile_url }}" class="btn btn-default btn-flat">

                    <i class="fa fa-fw fa-user text-lightblue"></i>
                    ប្រវត្តិរូប

                </a>

            @endif


            <a class="btn btn-default btn-flat float-right" href="#" onclick="
                   event.preventDefault();
                   document.getElementById('logout-form').submit();
               ">

                <i class="fa fa-fw fa-power-off text-red"></i>
                ចាកចេញ

            </a>


            {{-- Logout Form --}}
            <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">

                @if(config('adminlte.logout_method'))

                    {{ method_field(config('adminlte.logout_method')) }}

                @endif

                {{ csrf_field() }}

            </form>

        </li>

    </ul>

</li>

{{-- ============================================================
LIVE BADGE POLLING (added)
Refreshes just the bell count every 30s, no page reload needed.
Move this into @push('js') in your layout if it supports stacks.
============================================================ --}}
<script>
    setInterval(function () {
        fetch("{{ route('notifications.unreadCount') }}")
            .then(res => res.json())
            .then(data => {
                const badge = document.getElementById('navbarNotifBadge');
                if (!badge) return;
                if (data.count > 0) {
                    badge.style.display = '';
                    badge.textContent = data.count;
                } else {
                    badge.style.display = 'none';
                }
            })
            .catch(() => { });
    }, 30000);
</script>