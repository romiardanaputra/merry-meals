<?php

/**
 * Dashboard Configuration
 * Role-based navigation and feature settings
 * Based on DASHBOARD_ARCHITECTURE.md specifications
 */

return [
    /**
     * Navigation items per role
     * Each item: route, label, icon, badge (optional)
     */
    'navigation' => [
        'superadmin' => [
            ['route' => 'superadmin.dashboard', 'label' => 'Dashboard', 'icon' => 'home'],
            ['route' => 'superadmin.users.index', 'label' => 'All Users', 'icon' => 'users'],
            ['route' => 'superadmin.partners.index', 'label' => 'Partners', 'icon' => 'building'],
            ['route' => 'superadmin.orders.index', 'label' => 'Orders', 'icon' => 'shopping-bag'],
            ['route' => 'superadmin.donations.index', 'label' => 'Donations', 'icon' => 'heart'],
            ['route' => 'superadmin.reports.index', 'label' => 'Reports', 'icon' => 'chart'],
            ['route' => 'superadmin.settings', 'label' => 'Settings', 'icon' => 'cog'],
        ],

        'admin' => [
            ['route' => 'admin.index', 'label' => 'Dashboard', 'icon' => 'home'],
            ['route' => 'admin.index', 'label' => 'All Users', 'icon' => 'users'],
            ['route' => 'admin.partners.index', 'label' => 'Partners', 'icon' => 'building'],
            ['route' => 'admin.orders.index', 'label' => 'Orders', 'icon' => 'shopping-bag'],
            ['route' => 'donator.list', 'label' => 'Donations', 'icon' => 'heart'],
            ['route' => 'admin.reports.index', 'label' => 'Reports', 'icon' => 'chart'],
        ],

        'member' => [
            ['route' => 'member.dashboard', 'label' => 'Dashboard', 'icon' => 'home'],
            ['route' => 'meal.menu', 'label' => 'Browse Meals', 'icon' => 'food'],
            ['route' => 'member.orders', 'label' => 'My Orders', 'icon' => 'shopping-bag'],
            ['route' => 'profile.edit', 'label' => 'Profile', 'icon' => 'user'],
        ],

        'driver' => [
            ['route' => 'driver.dashboard', 'label' => 'Dashboard', 'icon' => 'home'],
            ['route' => 'driver.dashboard', 'label' => 'Deliveries', 'icon' => 'truck'],
            ['route' => 'profile.edit', 'label' => 'Profile', 'icon' => 'user'],
        ],

        'partner' => [
            ['route' => 'partner.index', 'label' => 'Dashboard', 'icon' => 'home'],
            ['route' => 'meal.index', 'label' => 'Meals', 'icon' => 'food'],
            ['route' => 'partner.orders.index', 'label' => 'Orders', 'icon' => 'shopping-bag'],
            ['route' => 'partner.profile.edit', 'label' => 'Restaurant', 'icon' => 'building'],
        ],
    ],

    /**
     * Icon SVG paths
     */
    'icons' => [
        'home' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
        'users' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
        'building' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>',
        'shopping-bag' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>',
        'heart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
        'chart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
        'cog' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>',
        'user' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
        'truck' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-6 0V3a2 2 0 012-2h2a2 2 0 012 2v4m-6 0h6"/>',
        'food' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>',
        'clock' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    ],

    /**
     * Dashboard feature flags per role
     */
    'features' => [
        'superadmin' => [
            'show_all_stats' => true,
            'can_manage_settings' => true,
            'can_view_reports' => true,
            'can_manage_all_users' => true,
        ],
        'admin' => [
            'show_all_stats' => true,
            'can_manage_settings' => false,
            'can_view_reports' => true,
            'can_manage_all_users' => false,
        ],
        'member' => [
            'show_order_stats' => true,
            'show_nutrition' => true,
        ],
        'driver' => [
            'show_delivery_stats' => true,
            'show_availability_toggle' => true,
        ],
        'partner' => [
            'show_meal_stats' => true,
            'show_order_queue' => true,
        ],
    ],

    /**
     * Dashboard theme
     */
    'theme' => [
        'sidebar_bg' => '#222222',
        'primary_color' => '#FF7B54',
        'content_bg' => '#F8F8F8',
    ],
];
