<?php

return [
    'default_filesystem_disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),
    'auth' => [
        'guard' => env('FILAMENT_AUTH_GUARD', 'web'),
        'pages' => [
            'login' => \App\Filament\Pages\Auth\Login::class,
        ],
    ],
    'plugin' => [
        'navigation' => [
            'groups' => [
                'إدارة الموظفين',
                'إدارة المهام',
                'الإعدادات',
            ],
        ],
    ],
    'brand' => [
        'name' => 'مركز جويل',
    ],
    'default_avatar_provider' => \Filament\AvatarProviders\UiAvatarsProvider::class,
    'default_date_format' => 'Y/m/d',
    'default_datetime_format' => 'Y/m/d H:i:s',
    'default_time_format' => 'H:i:s',
    'default_locale' => 'ar',
    'locales' => [
        'ar',
    ],
    'cache' => [
        'enabled' => true,
        'duration' => 3600, // 1 hour
        'icons' => true,
        'assets' => true,
    ],
    'performance' => [
        'enable_route_caching' => true,
        'enable_view_caching' => true,
        'enable_resource_caching' => true,
        'enable_icon_caching' => true,
        'enable_asset_caching' => true,
    ],
]; 