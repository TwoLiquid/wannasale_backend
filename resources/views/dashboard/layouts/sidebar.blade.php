<!-- BEGIN SIDEBAR -->
<nav class="page-sidebar" data-pages="sidebar">
    <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
    <div class="sidebar-overlay-slide from-top" id="appMenu"></div>
    <!-- END SIDEBAR MENU TOP TRAY CONTENT-->
    <!-- BEGIN SIDEBAR MENU HEADER-->
    <div class="sidebar-header">
        <img src="{{ asset('assets/dashboard/img/logo.png') }}" alt="logo" class="brand" data-src="{{ asset('assets/dashboard/img/logo.png') }}" data-src-retina="{{ asset('assets/dashboard/img/logo.png') }}" height="26" />
        <div class="sidebar-header-controls">
            <button data-toggle-pin="sidebar" class="btn btn-link visible-lg-inline" type="button" style="margin-left: -18px"><i class="fa fs-12"></i></button>
        </div>
    </div>
    <!-- END SIDEBAR MENU HEADER-->
    <!-- START SIDEBAR MENU -->
    <div class="sidebar-menu">
        <!-- BEGIN SIDEBAR MENU ITEMS-->
        <ul class="menu-items p-t-20 p-b-30">

            @php
                /** @var \App\Models\Site[]|\Illuminate\Database\Eloquent\Collection $sites */
                /** @var bool $canAddSite */
                $siteLinks = [];
                foreach ($sites as $site) {
                    $siteLinks[] = [
                        'name' => $site->name,
                        'route' => 'dashboard.sites.view',
                        'parameters' => $site->id,
                        'featherIcon' => 'layout'
                    ];
                }
                if ($canAddSite === true) {
                    $siteLinks[] = [
                        'name' => 'Добавить',
                        'route' => 'dashboard.sites.create',
                        'featherIcon' => 'plus'
                    ];
                }
            @endphp

            @include('dashboard.layouts.partials.sidebar-item', [
                'name' => 'Сайты',
                'routeRoot' => ['dashboard.sites', 'dashboard.items', 'dashboard.widgets'],
                'featherIcon' => 'copy',
                'links' => $siteLinks
            ])

            @include('dashboard.layouts.partials.sidebar-item', [
                'name' => 'Клиенты',
                'routeRoot' => 'dashboard.clients',
                'route' => 'dashboard.clients',
                'featherIcon' => 'users'
            ])

            @include('dashboard.layouts.partials.sidebar-item', [
                'name' => 'Запросы',
                'routeRoot' => 'dashboard.requests',
                'route' => 'dashboard.requests',
                'featherIcon' => 'corner-right-down'
            ])

            @include('dashboard.layouts.partials.sidebar-item', [
                'name' => 'Оплата',
                'routeRoot' => ['dashboard.subscription', 'dashboard.cards', 'dashboard.transactions'],
                'featherIcon' => 'percent',
                'links' => [
                    [
                        'name' => 'Подписка',
                        'route' => 'dashboard.subscription',
                        'featherIcon' => 'check-square'
                    ],
                    [
                        'name' => 'Карты',
                        'route' => 'dashboard.cards',
                        'featherIcon' => 'credit-card'
                    ],
                    [
                        'name' => 'Транзакции',
                        'route' => 'dashboard.transactions',
                        'featherIcon' => 'repeat'
                    ]
                ]
            ])

            @include('dashboard.layouts.partials.sidebar-item', [
                'name' => 'Настройки',
                'routeRoot' => 'dashboard.settings',
                'route' => 'dashboard.settings',
                'featherIcon' => 'settings'
            ])

</ul>
<div class="clearfix"></div>
</div>
<!-- END SIDEBAR MENU -->
</nav>
<!-- END SIDEBAR -->
