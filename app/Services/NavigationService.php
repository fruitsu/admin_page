<?php

namespace App\Services;

// use App\Models\Order;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Talanoff\ImpressionAdmin\Helpers\NavItem;

class NavigationService
{

    /**
     * Backend navigation
     *
     * @return array
     */
    public function backend()
    {
        $items = [
            (object)[
                'name' => __('admin.careers.title'),
                'route' => route('admin.careers.index'),
                'icon' => 'i-receipt',
                'match' => app('router')->currentRouteNamed('admin.careers.*'),
            ],
            (object)[
                'name' => __('admin.pages.title'),
                'route' => route('admin.pages.index'),
                'icon' => 'i-gallery',
                'match' => app('router')->currentRouteNamed('admin.pages.*'),
            ],
            (object)[
                'name' => __('admin.portfolios.title'),
                'route' => route('admin.portfolios.index'),
                'icon' => 'i-portfolio',
                'match' => app('router')->currentRouteNamed('admin.portfolios.*'),
            ]
        ];

        if (Auth::user()->hasRole('admin')) {
            $items[] = (object)[
                'name' => __('admin.users.title'),
                'route' => route('admin.users.index'),
                'match' => app('router')->currentRouteNamed('admin.users.*'),
                'icon' => 'i-users',
            ];
        }

        return $items;
    }
}
