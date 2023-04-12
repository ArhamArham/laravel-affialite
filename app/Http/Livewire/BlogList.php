<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use App\Traits\CrudListHelper;
use App\Traits\CrudListInterface;
use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\Component;
use Livewire\WithPagination;

class BlogList extends Component implements CrudListInterface
{
    use WithPagination, CrudListHelper;

    public string $model = Blog::class;
    public $sortField = 'id';
    public string $createUrl = 'advertisement.blog.create';
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
                'name' => 'Slug',
                'key'  => 'slug',
                'sort' => true
            ],
            [
                'name'  => 'Image',
                'image' => 'image_link',
            ],
            [
                'name' => 'Category',
                'key'  => 'blog_category.name',
                'dot'  => true
            ],
            [
                'name'  => 'Stores',
                'class' => 'text-xs w-40 w-1/4',
                'cb'    => function ($role) {
                    return implode(', ', $role->stores->pluck('name')->toArray());
                },
            ],
            [
                'name'        => 'Active',
                'checkActive' => 'is_active',
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
                            return route("advertisement.blog.edit", $department->id);
                        }
                    ],
                    [
                        'name'  => 'Delete',
                        'class' => 'deleteBtn',
                        'route' => function ($department) {
                            return route("advertisement.blog.destroy", $department->id);
                        }
                    ]
                ]
            ]
        ];
    }

    public function getTableName(): string
    {
        return 'Blogs';
    }


    public function getWith(): ?string
    {
        return "blog_category";
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
