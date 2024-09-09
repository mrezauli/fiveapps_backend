<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\NttnProvider;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $bcc_Staffs = User::orderByDesc('id')->get();

        return view('user.index', get_defined_vars());
    }

    public function create()
    {
        $roles = Role::get();
        $providers = NttnProvider::select('id', 'name', 'slug')->get();

        return view('user.create', get_defined_vars());
    }

    public function edit($id)
    {
        $staff = User::findOrFail($id);
        $roles = Role::get();
        $roleName = CustomHelper::userRoleName($staff);
        $providers = NttnProvider::select('id', 'name', 'slug')->get();
        return view('user.edit', get_defined_vars());
    }

    public function view($id)
    {
        $staff = User::findOrFail($id);
        return view('user.view', get_defined_vars());
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Login
     * @created 16-04-24
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function store(Request $request)
    {
        $message = 'User Create successfully ';
        if ($request->has('id')) {
            $newUser = User::find($request->id);
            $rules['email'] = 'required|string|unique:' . with(new User)->getTable() . ',email,' . $request->id;
            $rules['phone'] = 'required|string|unique:' . with(new User)->getTable() . ',phone,' . $request->id;
            $rules['name'] = 'required|string';
            $rules['role'] = 'required';
            $rules['designation'] = 'required|string';
            $rules['password'] = 'nullable|string|min:8';
            $rules['confirm_password'] = 'required_with:password|string|same:password|min:8';
            $userType = toDash(getRoleNameById($request->role));
            if (starts_with($userType, "nttn")) {
                if (empty($request->provider_slug)) {
                    $rules['provider_slug'] = 'required';
                    $validator = $request->validate($rules);
                    return RedirectHelper::backWithValidationError($validator);
                }
                $newUser->user_type = "nttn_" . $request->provider_slug . '_staff';
            } else if (starts_with($userType, "bcc")) {
                $newUser->user_type = "bcc_staff";
            } else {
                $newUser->user_type = "";
            }
            $message = $message . ' updated';
            $userType = toDash(getRoleNameById($request->role));
            if (starts_with($userType, "nttn")) {
                if (empty($request->provider_slug)) {
                    $rules['provider_slug'] = 'required';
                    $validator = $request->validate($rules);
                    return RedirectHelper::backWithValidationError($validator);
                }
                $newUser->user_type = "nttn_" . $request->provider_slug . '_staff';
            } else if (starts_with($userType, "bcc")) {
                $newUser->user_type = "bcc_staff";
            } else {
                $newUser->user_type = "";
            }
            $validator = $request->validate($rules);
        } else {
            $newUser = new User();
            $rules['email'] = 'required|string|unique:' . with(new User)->getTable() . ',email,' . ',id';
            $rules['phone'] = 'required|string|unique:' . with(new User)->getTable() . ',phone,' . ',id';
            $rules['name'] = 'required|string';
            $rules['role'] = 'required';
            $rules['designation'] = 'required|string';
            $rules['password'] = 'required|string|min:8';
            $rules['confirm_password'] = 'required|string|same:password|min:8';
            $message = $message . ' created';
            $validator = $request->validate($rules);
            $userType = toDash(getRoleNameById($request->role));
            if (starts_with($userType, "nttn")) {
                if (empty($request->provider_slug)) {
                    $rules['provider_slug'] = 'required';
                    $validator = $request->validate($rules);
                    return RedirectHelper::backWithValidationError($validator);
                }
                $newUser->user_type = "nttn_" . $request->provider_slug . '_staff';
            } else if (starts_with($userType, "bcc")) {
                $newUser->user_type = "bcc_staff";
            } else {
                $newUser->user_type = "";
            }
            $newUser->active = $request->status;
        }


        try {
            $newUser->name = $request->name;
            $newUser->email = $request->email;
            $newUser->phone = $request->phone;
            $newUser->designation = $request->designation;
            if ($request->password != null) {
                $newUser->password = Hash::make($request->password);
            }
            if ($newUser->save()) {
                $role = Role::find($request->role);
                if ($role) {
                    $newUser->assignRole($role);
                }
                return redirect()->route('user.index')->with('success', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {

            return RedirectHelper::backWithInputFromException();
        }

    }

    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'nullable|string|min:8',
            'confirm_password' => 'required_with:password|string|same:password|min:8',
        ]);
        $user = User::find($id);
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            return back();
        }
    }

    public function delete($id)
    {
        $nttn = User::find($id);
        if ($nttn) {
            if ($nttn->delete()) {
                return redirect()->route('user.index')->with('success', 'User deleted successfully');
            }
        }
        return redirect()->route('user.index')->with('error', 'Something went wrong!!!');
    }
}