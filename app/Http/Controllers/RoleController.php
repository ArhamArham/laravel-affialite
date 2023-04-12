<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Role;
use App\Models\UserGroup;
use App\Traits\FileHelper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    use FileHelper;

    public function index()
    {
        return view('admin.role.index');
    }

    public function create()
    {
        $modules = Module::whereNull('parent_id')
            ->where('is_active', true)
            ->with('children')
            ->get();

        return view('admin.role.create', compact('modules'));
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name'          => 'required|max:255',
            'email'         => 'nullable|email',
            'expiry_date'   => 'nullable|date',
            'permissions'   => 'nullable',
            'is_active'     => 'in:0,1'
        ]);

        $role = Role::create([
            'name'          => $validated['name'],
            'email'         => $validated['email'],
            'expiry_date'   => $validated['expiry_date'],
            'is_active'     => $validated['is_active']
        ]);

        foreach ($validated['permissions'] as $moduleId => $permission) {
            $role->rolePermissions()->create([
                'module_id'   => $moduleId,
                'permissions' => $permission
            ]);
        }

        return redirect(route('userManagement.role.index'));
    }

    public function edit(Role $role)
    {
        $role->load('rolePermissions');

        $modules = Module::whereNull('parent_id')
            ->where('is_active', true)
            ->with('children')
            ->get();

        return view('admin.role.edit', compact('modules', 'role'));
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, Role $role)
    {
        $validated = $this->validate($request, [
            'name'          => 'required|max:255',
            'email'         => 'nullable|email',
            'expiry_date'   => 'nullable|date',
            'permissions'   => 'nullable',
            'is_active'     => 'in:0,1'
        ]);

        $role->update([
            'name'          => $validated['name'],
            'email'         => $validated['email'],
            'expiry_date'   => $validated['expiry_date'],
            'is_active'     => $validated['is_active']
        ]);

        $role->rolePermissions()->delete();

        foreach ((array)@ $validated['permissions'] as $moduleId => $permission) {
            $role->rolePermissions()->create([
                'module_id'   => $moduleId,
                'permissions' => $permission
            ]);
        }

        return redirect(route('userManagement.role.index'));
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->rolePermissions()->delete();

        $role->delete();

        return redirect(route('userManagement.role.index'));
    }
}
