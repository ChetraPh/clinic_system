<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    <a href="{{ route('dashboard') }}"
       class="brand-link"
       style="display:flex !important; align-items:center !important; height:57px !important;">

        <img
            src="{{ asset('images/logo.jpg') }}"
            alt="Prum Santepheap Logo"
            style="
                width:40px !important;
                height:40px !important;
                min-width:40px !important;
                max-width:40px !important;
                object-fit:contain !important;
                display:block !important;
                opacity:1 !important;
                visibility:visible !important;
                margin-right:10px !important;
            "
        >

        <span
            class="brand-text font-weight-light"
            style="
                font-weight:600 !important;
                color:#006D36 !important;
                opacity:1 !important;
                visibility:visible !important;
            "
        >
            PrumSantepheap
        </span>
    </a>

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview"
                role="menu"

                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif

                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif
            >

                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')

            </ul>
        </nav>
    </div>

</aside>