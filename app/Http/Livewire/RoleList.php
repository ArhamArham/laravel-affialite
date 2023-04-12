<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Role;
use App\Traits\CrudListHelper;
use App\Traits\CrudListInterface;
use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\Component;
use Livewire\WithPagination;

class RoleList extends Component implements CrudListInterface
{
    use WithPagination, CrudListHelper;

    public string $model = Role::class;
    public $sortField = 'id';
    public string $createUrl = 'userManagement.role.create';
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
                'name' => 'Email',
                'key'  => 'email',
            ],
            [
                'name' => 'Expiry Date',
                'key'  => 'expiry_date',
            ],
            [
                'name'  => 'Modules',
                'class' => 'text-xs w-40 w-1/4',
                'cb'    => function ($role) {
                    return implode(', ', $role->rolePermissions->map->module->map->name->toArray());
                },
            ],
            [
                'name'        => 'Active',
                'checkActive' => 'is_active',
                'sort'        => true
            ],
            [
                'name'   => 'Action',
                'anchor' => [
                    [
                        'name'  => 'Edit',
                        'route' => function ($role) {
                            return route('userManagement.role.edit', $role->id);
                        }
                    ],
                    [
                        'name'    => 'Delete',
                        'onclick' => 'test',
                        'route'   => function ($role) {
                            return route("userManagement.role.destroy", $role->id);
                        }
                    ]
                ]
            ]
        ];
    }

    public function getTableName(): string
    {
        return 'Roles';
    }


    public function getWith(): ?string
    {
        return "";
    }

    #[ArrayShape(['enabled' => "bool", 'placeholder' => "string", 'searchFields' => "string[]"])] public function getSearchOptions(): array
    {
        return [
            'enabled'      => true,
            'placeholder'  => 'Search by name, username, email and mobile no',
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
