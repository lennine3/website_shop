<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Libraries\Upload;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Validators\PasswordMatchValidator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use function App\Libraries\StripSlug;

class UserController extends Controller
{
    private $upload;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct()
    {
        $this->upload=new Upload();
    }
    public function index()
    {
        $users = User::get();
        return view('user::index', compact('users'));
    }

    public function userSetting(User $user)
    {
        $role=Role::all();
        return view('user::setting', compact('user', 'role'));
    }
    public function userSettingProcess(User $user, Request $request)
    {
        $nameAvatar = '';
        if (request()->hasFile('avatarImage')) {
            $file = request()->file('avatarImage');
            $source_path = config('user.image.image_save_path').'/'.$user->id.'/';
            $file_name = StripSlug($user->name) . '.' . $file->getClientOriginalExtension();
            $result = $this->upload->doUpload($source_path, $file, $file_name, [], true);
            $img = $user->avatar;

            if (isset($img) && (file_exists($source_path . "/" . $img) == '1')) {
                unlink($source_path . "/" . $img);
            }
            $nameAvatar = $result['name'];
        }
        $data = $request->only(['name', 'email', 'phone', 'dob', 'address', 'gender', 'status', 'email']);

        if ($nameAvatar) {
            $data['avatar'] = $nameAvatar;
        }
        $user->update($data);

        return redirect()->back()->with('success', 'Permission assigned successfully.');
    }

    public function userSettingPasswordProcess(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        if ($validator->passes()) {
            $user->update(['password'=>Hash::make($request->password)]);
            return response()->json([
                'success' => true,
                'message' => 'Password changed',
            ]);
        } else {
            // validation failed, handle errors
            $errors = $validator->errors();
            return response()->json([
                'success' => false,
                'errors' => $errors,
            ]);
        }

        // $user->password=Hash::make($request->password);
    }
    public function assignPermission(Request $request, $userId, $permissionId)
    {
        $isChecked = $request->input('isChecked');
        $message = trans('user::user.controller.success');
        $status=true;
        $user = User::find($userId);
        $permission = Permission::find($permissionId);

        if ($isChecked=='true') {
            $result = $user->givePermissionTo($permission);
        } else {
            $result = $user->revokePermissionTo($permission);
        }
        if (!$result) {
            $message = trans('user::user.controller.error');
            $status=false;
        }
        return response()->json([
            'success' => $status,
            'message' => $message,
        ]);
    }
}
