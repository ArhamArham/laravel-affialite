<?php

namespace App\Http\Controllers;

use App\Models\Network;
use App\Models\Role;
use App\Models\User;
use App\Traits\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    use FileHelper;

    public function index()
    {
        return view('admin.user.index');
    }


    public function create()
    {
        $roles = Role::where('is_active', true)
            ->get();

        $networks = Network::where('is_active', true)
            ->get();

        return view('admin.user.create', compact('networks', 'roles'));
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'first_name'  => 'required|max:255',
            'last_name'   => 'required|max:255',
            'username'    => 'required|max:255|unique:tbl_users',
            'email'       => 'required|email|unique:tbl_users',
            'password'    => 'required|min:8|max:50',
            'mobile_no'   => 'required|max:13',
            'network_id'  => 'required|exists:tbl_networks,id',
            'is_active'   => 'boolean',
            'role_ids'    => 'required|array',
            'role_ids.*'  => 'exists:tbl_roles,id'
        ]);

        unset($validated['role_ids']);

        $user = User::create($validated);

        $user->roles()->sync(
            $request->get('role_ids')
        );

        return response('', 201);
    }

    public function edit(User $user)
    {
        $user->load('roles');

        $roles = Role::where('is_active', true)
            ->get();

        $networks = Network::where('is_active', true)
            ->get();

        return view('admin.user.edit', compact('networks', 'roles', 'user'));
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, User $user)
    {
        $validated = $this->validate($request, [
            'first_name'  => 'required|max:255',
            'last_name'   => 'required|max:255',
            'username'    => 'required|max:255|unique:tbl_users,username,' . $user->id,
            'email'       => 'required|email|unique:tbl_users,id,' . $user->id,
            'mobile_no'   => 'required|max:13',
            'network_id'  => 'required|exists:tbl_networks,id',
            'is_active'   => 'boolean',
            'role_ids'    => 'required|array',
            'role_ids.*'  => 'exists:tbl_roles,id'
        ]);

        unset($validated['role_ids']);

        $user->update($validated);

        $user->roles()->sync(
            $request->get('role_ids')
        );

        return response('', 204);
    }
}
