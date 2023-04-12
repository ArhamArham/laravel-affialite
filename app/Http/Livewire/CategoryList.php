<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Traits\CrudListHelper;
use App\Traits\CrudListInterface;
use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryList extends Component implements CrudListInterface
{
    use WithPagination, CrudListHelper;

    public string $model = Category::class;
    public $sortField = 'id';
    public string $createUrl = 'market.category.create';
    protected string $paginationTheme = 'tailwind';

    public function buildTable(): array
    {
        return [
            [
                'name' => 'Name',
                'key'  => 'name',
                'sort' => true
            ],
            [
                'name'        => 'Active',
                'checkActive' => 'is_active',
                'sort'        => true
            ],
            [
                'name'        => 'Featured For Home',
                'checkActive' => 'featured_for_home',
                'sort'        => true
            ],
            [
                'name'  => 'Icon',
                'image' => 'icon_link',
            ],
            [
                'name'   => 'Action',
                'anchor' => [
                    [
                        'name'  => 'Edit',
                        'route' => function ($department) {
                            return route("market.category.edit", $department->id);
                        }
                    ]
                ]
            ]
        ];
    }

    public function getTableName(): string
    {
        return 'Categories';
    }


    public function getWith(): ?string
    {
        return "";
    }

    #[ArrayShape(['enabled' => "bool", 'placeholder' => "string", 'searchFields' => "string[]"])] public function getSearchOptions(): array
    {
        return [
            'enabled'      => true,
            'placeholder'  => 'Search by name',
            'searchFields' => [
                'name',
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
