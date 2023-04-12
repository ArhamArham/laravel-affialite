<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\User;
use App\Traits\CrudListHelper;
use App\Traits\CrudListInterface;
use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component implements CrudListInterface
{
    use WithPagination, CrudListHelper;

    public string $model = User::class;
    public $sortField = 'id';
    public string $createUrl = 'userManagement.user.create';
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
                'name' => 'Username',
                'key'  => 'username',
            ],
            [
                'name' => 'Email',
                'key'  => 'email',
            ],
            [
                'name' => 'Mobile No',
                'key'  => 'mobile_no',
            ],
            [
                'name' => 'Network',
                'dot'  => true,
                'key'  => 'network.name',
            ],
            [
                'name' => 'Roles',
                'cb'   => function ($user) {
                    return ucfirst($user->roles()->first()?->name);
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
                    'name'  => 'Edit',
                    'route' => function ($user) {
                        return route('userManagement.user.edit', $user->id);
                    }
                ]
            ]
        ];
    }

    public function getTableName(): string
    {
        return 'Users';
    }

    public function getExtraQuery($query): ?Builder
    {
        return $query->whereNot('id', 1);
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
                'username',
                'email',
                'mobile_no',
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
}
