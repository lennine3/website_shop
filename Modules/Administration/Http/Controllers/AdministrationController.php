<?php

namespace Modules\Administration\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdministrationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('administration::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function rolePage()
    {
        $permissions=Permission::get();
        $roles=Role::get();
        return view('administration::role.index', compact('permissions', 'roles'));
    }
    public function roleEditPage($id)
    {
        $editData=Role::findOrFail($id);
        $permissions=Permission::get();
        $roles=Role::get();
        return view('administration::role.index', compact('permissions', 'editData', 'roles'));
    }
    public function assignRole(Request $request)
    {
        // dd($request->all());

        if ($request->role_id!=null) {
            $role=Role::findOrFail($request->role_id);
            $role->update([
                'name' => $request->input('name')
            ]);
            $role->syncPermissions($request->input('permission'));
        } else {
            $validatedData = $request->validate([
                'name' => 'required|unique:roles|max:255',
                'permission' => 'nullable|array',
                'permission.*' => 'integer|exists:permissions,id',
            ]);
            $role = Role::create([
                'name' => $validatedData['name'],
            ]);

            if (isset($validatedData['permission'])) {
                $role->permissions()->attach($validatedData['permission']);
            }
        }

        if ($role) {
            $message = trans('role.controller.success');
        } else {
            $message = trans('role.controller.error');
            $message = 'Đã có lỗi xảy ra trong quá trình thực hiện!';
        }
        return response()->json(['message' => $message,'status'=>'success']);
        // return redirect()->route('role.page')
        //     ->with('success', 'Role created successfully.');
    }

    public function permissionPage()
    {
        $permissions=Permission::get();
        return view('administration::permission.index', compact('permissions'));
    }
    public function permissionEditPage($id)
    {
        $editData=Permission::findOrFail($id);
        $permissions=Permission::get();
        return view('administration::permission.index', compact('permissions', 'editData'));
    }
    public function assignPermission(Request $request)
    {
        $request->permission_id!='' ? $permission=Permission::findOrFail($request->permission_id) : $permission = new Permission();
        $permission->name = $request->name;
        $permission->title=$request->title;
        $permission->guard_name = 'web'; // Or 'admin' if you're using a custom guard
        $permission->save();
        if ($permission) {
            $message = trans('role.controller.success');
        } else {
            $message = trans('role.controller.error');
        }
        return response()->json(['message' => $message,'status'=>'success']);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('administration::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('administration::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
