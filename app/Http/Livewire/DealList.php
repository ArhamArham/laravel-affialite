<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Deal;
use App\Models\Store;
use App\Traits\CrudListHelper;
use App\Traits\CrudListInterface;
use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\Component;
use Livewire\WithPagination;

class DealList extends Component implements CrudListInterface
{
    use WithPagination, CrudListHelper;

    public string $model = Deal::class;
    public $sortField = 'id';
    public string $createUrl = 'advertisement.deal.create';
    protected string $paginationTheme = 'tailwind';

    public function buildTable(): array
    {
        return [
            [
                'name' => 'Title',
                'key'  => 'title',
                'sort' => true
            ],
            [
                'name'        => 'Active',
                'checkActive' => 'is_active',
                'sort'        => true
            ],
            [
                'name' => 'Created at',
                'cb'   => fn($h) => $h->created_at->format('Y-m-d h:i A'),
                'sort' => true
            ],

            [
                'name'   => 'Action',
                'anchor' => [
                    [
                        'name'  => 'Edit',
                        'route' => function ($department) {
                            return route("advertisement.deal.edit", $department->id);
                        }
                    ],
                    [
                        'name'  => 'Delete',
                        'class' => 'deleteBtn',
                        'route' => function ($department) {
                            return route("advertisement.deal.destroy", $department->id);
                        }
                    ]
                ]
            ]
        ];
    }

    public function getTableName(): string
    {
        return 'Deals';
    }


    public function getWith(): ?string
    {
        return "";
    }

    #[ArrayShape(['enabled' => "bool", 'placeholder' => "string", 'searchFields' => "string[]"])] public function getSearchOptions(): array
    {
        return [
            'enabled'      => true,
            'placeholder'  => 'Search by title',
            'searchFields' => [
                'title',
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
