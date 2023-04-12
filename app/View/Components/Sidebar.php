<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $menu = [];

    public function __construct()
    {
        $this->menu = collect([
            [
                'name'      => 'Dashboard',
                'icon'      => 'home',
                'link'      => route('dashboard'),
                'condition' => 'dashboard',
                'child'     => [],
            ],
            [
                'name'  => 'User Management',
                'icon'  => 'users',
                'child' => [
                    [
                        'name'      => 'User',
                        'icon'      => 'users',
                        'link'      => route('userManagement.user.index'),
                        'condition' => 'userManagement.user',
                        'child'     => [],
                    ],
                    [
                        'name'      => 'Role',
                        'icon'      => 'lock',
                        'link'      => route('userManagement.role.index'),
                        'condition' => 'userManagement.role',
                        'child'     => [],
                    ],
                ],
            ],
            [
                'name'  => 'Market',
                'icon'  => 'users',
                'child' => [
                    [
                        'name'      => 'Category',
                        'icon'      => 'users',
                        'link'      => route('market.category.index'),
                        'condition' => 'market.category',
                        'child'     => [],
                    ],
                    [
                        'name'      => 'Network',
                        'icon'      => 'users',
                        'link'      => route('market.network.index'),
                        'condition' => 'market.network',
                        'child'     => [],
                    ],
                ],
            ],
            [
                'name'  => 'Affiliate',
                'icon'  => 'activity',
                'child' => [
                    [
                        'name'      => 'Store',
                        'icon'      => 'activity',
                        'link'      => route('affiliate.store.index'),
                        'condition' => 'affiliate.store',
                        'child'     => [],
                    ],
                    [
                        'name'      => 'Coupon Listing',
                        'icon'      => 'activity',
                        'link'      => route('affiliate.coupon.index'),
                        'condition' => 'affiliate.coupon',
                        'child'     => [],
                    ],
                    [
                        'name'      => 'Coupon Sorting',
                        'icon'      => 'activity',
                        'link'      => route('affiliate.coupon.sorting.index'),
                        'condition' => 'affiliate.coupon.sorting',
                        'child'     => [],
                    ]
                ],
            ],
            [
                'name'  => 'Advertisement',
                'icon'  => 'activity',
                'child' => [
                    [
                        'name'      => 'Deal',
                        'icon'      => 'activity',
                        'link'      => route('advertisement.deal.index'),
                        'condition' => 'advertisement.deal',
                        'child'     => [],
                    ],
                    [
                        'name'      => 'Blog',
                        'icon'      => 'activity',
                        'link'      => route('advertisement.blog.index'),
                        'condition' => 'advertisement.blog',
                        'child'     => [],
                    ],
                    [
                        'name'      => 'Page',
                        'icon'      => 'activity',
                        'link'      => route('advertisement.page.index'),
                        'condition' => 'advertisement.page',
                        'child'     => [],
                    ],
                ],
            ],
            [
                'name'  => 'Setting',
                'icon'  => 'activity',
                'child' => [
                    [
                        'name'      => 'Website',
                        'icon'      => 'activity',
                        'link'      => route('setting.website.index'),
                        'condition' => 'setting.website',
                        'child'     => [],
                    ],
                ],
            ]
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     * @return View|string
     */
    public function render()
    {
        $this->convertMenuArrayIntoCollection();

        return view('components.sidebar');
    }

    protected function convertMenuArrayIntoCollection(): void
    {
        $this->menu = $this->menu->map(function ($item) {
            return collect($item)->map(function ($value) {
                return (is_array($value)) ? collect($value)->map(function ($value) {
                    return collect($value)->map(function ($value) {
                        return (is_array($value)) ? collect($value)->map(function ($value) {
                            return collect($value);
                        }) : $value;
                    });
                }) : $value;
            });
        });
    }
}
