<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    */

    'title' => 'Prum Santepheap',
    'title_prefix' => '',
    'title_postfix' => ' | Hospital Management System',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    */

    'use_ico_only' => false,
    'use_full_favicon' => true,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    */

    'google_fonts' => [
        'allowed' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    */

    'logo' => '<b>Prum</b> Santepheap',
    'logo_img' => 'vendor/adminlte/dist/img/logo.jpg',
    'logo_img_class' => 'brand-image img-circle elevation-2',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Prum Santepheap Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/logo.jpg',
            'alt' => 'Prum Santepheap Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    */

    'preloader' => [
        'enabled' => false,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/logo.jpg',
            'alt' => 'Prum Santepheap',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-success',
    'usermenu_image' => true,
    'usermenu_desc' => false,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    */

    'layout_topnav' => false,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    */

    'classes_auth_card' => 'card-outline card-success',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => 'text-success',
    'classes_auth_btn' => 'btn-flat btn-success',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    */

    'classes_body' => 'font-khmer',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-light-primary',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar
    |--------------------------------------------------------------------------
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    */

    'use_route_url' => false,

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'login_url' => 'login',

    'register_url' => false,

    'password_reset_url' => false,

    'password_email_url' => 'password/email',

    'profile_url' => false,

    'disable_darkmode_routes' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Asset Bundling
    |--------------------------------------------------------------------------
    */

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    */

    'menu' => [

        /*
        |--------------------------------------------------------------------------
        | Top Navigation
        |--------------------------------------------------------------------------
        */

        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        [
            'text' => 'ផ្ទាំងព័ត៌មាន',
            'url' => 'home',
            'icon' => 'fas fa-tachometer-alt',
        ],

        /*
        |--------------------------------------------------------------------------
        | General Management
        |--------------------------------------------------------------------------
        */

        [
            'header' => 'ការគ្រប់គ្រងទូទៅ',
        ],

        [
            'text' => 'ដេប៉ាតឺម៉ង់',
            'url' => 'department',
            'icon' => 'fas fa-sitemap',
            'can' => 'manage-departments',
        ],

        [
            'text' => 'អ្នកជំងឺ',
            'url' => 'patients',
            'icon' => 'fas fa-user-injured',
            'can' => 'view-patients',
        ],

        [
            'text' => 'វេជ្ជបណ្ឌិត',
            'url' => 'doctor',
            'icon' => 'fas fa-user-md',
            'can' => 'view-doctors',
        ],

        [
            'text' => 'បន្ទប់',
            'url' => 'room',
            'icon' => 'fas fa-procedures',
            'can' => 'manage-rooms',
        ],

        /*
        |--------------------------------------------------------------------------
        | Clinical Management
        |--------------------------------------------------------------------------
        */

        [
            'header' => 'ការគ្រប់គ្រងវេជ្ជសាស្ត្រ',
        ],

        [
            'text' => 'ការណាត់ជួប',
            'url' => 'appointment',
            'icon' => 'fas fa-calendar-check',
            'can' => 'view-appointments',
        ],

        [
            'text' => 'កំណត់ត្រាវេជ្ជសាស្ត្រ',
            'route' => 'medical-records.index',
            'icon' => 'fas fa-notes-medical',
            'can' => 'view-medical-records',
        ],

        [
            'text' => 'មន្ទីរពិសោធន៍',
            'url' => 'lab',
            'icon' => 'fas fa-vials',
            'can' => 'view-lab-results',
        ],

        /*
        |--------------------------------------------------------------------------
        | Pharmacy
        |--------------------------------------------------------------------------
        */

        [
            'header' => 'ឱសថស្ថាន',
        ],

        [
            'text' => 'ឱសថស្ថាន',
            'url' => 'pharmacy',
            'icon' => 'fas fa-pills',
            'can' => 'view-medicines',
        ],

        /*
        |--------------------------------------------------------------------------
        | Finance
        |--------------------------------------------------------------------------
        */

        [
            'header' => 'ហិរញ្ញវត្ថុ',
        ],

        [
            'text' => 'ការទូទាត់ប្រាក់',
            'url' => 'billing',
            'icon' => 'fas fa-file-invoice-dollar',
            'can' => 'view-invoices',
        ],

        [
            'text' => 'ការកំណត់ការទូទាត់',
            'url' => 'settings/billing',
            'icon' => 'fas fa-money-check-alt',
            'can' => 'manage-billing-settings',
        ],

        /*
        |--------------------------------------------------------------------------
        | System Administration
        |--------------------------------------------------------------------------
        */

        [
            'header' => 'ការគ្រប់គ្រងប្រព័ន្ធ',
            'can' => 'manage-system-settings',
        ],

        [
            'text' => 'ការកំណត់ប្រព័ន្ធ',
            'icon' => 'fas fa-cogs',
            'can' => 'manage-system-settings',
            'submenu' => [

                [
                    'text' => 'ការកំណត់ទូទៅ',
                    'url' => 'settings/general',
                    'icon' => 'fas fa-sliders-h',
                    'can' => 'manage-system-settings',
                ],

                [
                    'text' => 'អ្នកប្រើប្រាស់',
                    'url' => 'user',
                    'icon' => 'fas fa-users',
                    'can' => 'manage-users',
                ],

                [
                    'text' => 'ការកំណត់ QR Code',
                    'url' => 'settings/qrcode',
                    'icon' => 'fas fa-qrcode',
                    'can' => 'manage-system-settings',
                ],

                [
                    'text' => 'ការបម្រុងទុកទិន្នន័យ',
                    'url' => 'settings/backup',
                    'icon' => 'fas fa-database',
                    'can' => 'manage-backups',
                ],

            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Support
        |--------------------------------------------------------------------------
        */

        [
            'header' => 'ជំនួយ',
        ],

        [
            'text' => 'Support',
            'url' => 'support',
            'icon' => 'fas fa-life-ring',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    */

    'plugins' => [

        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],

        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],

        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],

        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],

        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],

        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],

        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    */

    'livewire' => false,

];