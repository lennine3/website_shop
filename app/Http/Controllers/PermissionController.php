<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionController extends Controller
{
    public function createRole(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        Role::create(['name' => $validatedData['name']]);

        return redirect()->back()->with('success', 'Role created successfully.');
    }

    public function createPermission(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $validatedData['name']]);

        return redirect()->back()->with('success', 'Permission created successfully.');
    }

    public function assignPermission(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission' => 'required|exists:permissions,name',
        ]);

        $user = User::findOrFail($validatedData['user_id']);
        $permission = Permission::findOrFail($validatedData['permission']);

        $user->givePermissionTo($permission);

        return redirect()->back()->with('success', 'Permission assigned successfully.');
    }

    public function assignRole(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($validatedData['user_id']);
        $role = Role::findOrFail($validatedData['role']);

        $user->assignRole($role);

        return redirect()->back()->with('success', 'Role assigned successfully.');
    }

    public function roleView(){
        return view('admin.role.role-create');
    }
}
