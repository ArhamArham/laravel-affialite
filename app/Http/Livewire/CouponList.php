<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use App\Traits\CrudListHelper;
use App\Traits\CrudListInterface;
use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\Component;
use Livewire\WithPagination;

class CouponList extends Component implements CrudListInterface
{
    use WithPagination, CrudListHelper;

    public string $model = Coupon::class;
    public $sortField = 'id';
    public string $createUrl = 'affiliate.coupon.create';
    protected string $paginationTheme = 'tailwind';

    public function buildTable(): array
    {
        return [
            [
                'name' => 'Offer box',
                'key'  => 'offer_box',
                'sort' => true
            ],
            [
                'name' => 'Store',
                'key'  => 'store.name',
                'dot'  => true
            ],
            [
                'name' => 'Expiry Date',
                'key'  => 'expiry_date',
                'sort' => true
            ],
            [
                'name' => 'Type',
                'cb'   => fn ($m) => ucfirst($m->type),
                'sort' => true
            ],
            [
                'name' => 'Code',
                'key'  => 'code',
                'sort' => true
            ],
            [
                'name'        => 'Active',
                'checkActive' => 'is_active',
                'sort'        => true
            ],
            [
                'name'        => 'Featured for home',
                'checkActive' => 'featured_for_home',
                'sort'        => true
            ],
            [
                'name' => 'Created at',
                'cb'   => fn ($h) => $h->created_at->format('Y-m-d h:i A'),
                'sort' => true
            ],

            [
                'name'   => 'Action',
                'anchor' => [
                    [
                        'name'  => 'Edit',
                        'route' => function ($department) {
                            return route("affiliate.coupon.edit", $department->id);
                        }
                    ],
                    [
                        'name'  => 'Delete',
                        'class' => 'deleteBtn',
                        'route' => function ($department) {
                            return route("affiliate.coupon.destroy", $department->id);
                        }
                    ]
                ]
            ]
        ];
    }

    public function getTableName(): string
    {
        return 'Coupons';
    }


    public function getWith(): ?string
    {
        return "store";
    }

    #[ArrayShape(['enabled' => "bool", 'placeholder' => "string", 'searchFields' => "string[]"])] public function getSearchOptions(): array
    {
        return [
            'enabled'      => true,
            'placeholder'  => 'Search by offer box',
            'searchFields' => [
                'offer_box',
            ]
        ];
    }

    public function hasPagination(): bool
    {
        return true;
    }

    #[ArrayShape(['enabled' => "bool", 'perPage' => "int"])] public function getPerPageOptions(): array
    {
        return [
            'enabled' => true,
            'perPage' => 15,
        ];
    }

    public function getExtraQuery($query): ?Builder
    {
        return null;
    }
}
