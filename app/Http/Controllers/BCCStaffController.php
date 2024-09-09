<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class BCCStaffController extends Controller
{
    public function index()
    {
        $bcc_Staffs = User::where(['user_type' => 'bcc_staff', 'active' => 1])->orderByDesc('id')->get();
        return view('bcc_staff.index', get_defined_vars());
    }

    public function create()
    {
        return view('bcc_staff.create');
    }

    public function edit($id)
    {
        $staff = User::findOrFail($id);

        return view('bcc_staff.edit', get_defined_vars());
    }

    public function view($id)
    {
        $staff = User::findOrFail($id);
        return view('bcc_staff.view', get_defined_vars());
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
        $message = 'BCC Staff successfully ';
        if ($request->has('id')) {
            $bccStaff = User::find($request->id);
            $rules['email'] = 'required|string|' . Rule::unique('users', 'email')->where('app_name', 'bcc')->whereNot('id', $request->id);
            $rules['phone'] = 'required|string|' . Rule::unique('users', 'phone')->where('app_name', 'bcc')->whereNot('id', $request->id);
            $rules['name'] = 'required|string';
            $rules['designation'] = 'required|string';
            $rules['password'] = 'nullable|string|min:8';
            $rules['confirm_password'] = 'required_with:password|same:password';
            $rules['utype'] = 'required|in:isp_staff,bcc_staff,nttn_sbl_staff,nttn_adsl_staff';
            $message = $message . ' updated';
        } else {
            $bccStaff = new User();
            $rules['email'] = 'required|string|' . Rule::unique('users', 'email')->where(['app_name' => 'bcc']);
            $rules['phone'] = 'required|string|' . Rule::unique('users', 'phone')->where(['app_name' => 'bcc']);
            $rules['name'] = 'required|string';
            $rules['designation'] = 'required|string';
            $rules['password'] = 'required|string|min:8';
            $rules['confirm_password'] = 'required|string|same:password|min:8';
            $message = $message . ' created';
            $bccStaff->user_type = 'bcc_staff';
            $bccStaff->active = $request->status;
        }
        $request->validate($rules);

        try {
            $bccStaff->app_name = 'bcc';
            $bccStaff->name = $request->name;
            $bccStaff->email = $request->email;
            $bccStaff->phone = $request->phone;
            if ($request->has('id') && $request->has('utype')) {
                $bccStaff->user_type = $request->utype;
            }
            $bccStaff->designation = $request->designation;
            if ($request->password != null) {
                $bccStaff->password = Hash::make($request->password);
            }
            if ($bccStaff->save()) {
                $role = Role::where('name', 'BCC Staff')->first();
                if ($role) {
                    $bccStaff->assignRole($role);
                }
                return redirect()->route('bcc_staff.index')->with('success', $message);
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
        try {
            $user = User::find($id);
            if ($user) {
                $user->password = Hash::make($request->password);
                $user->save();
                return back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $nttn = User::find($id);
        if ($nttn->user_type == 'bcc_staff') {
            if ($nttn->delete()) {
                return redirect()->route('bcc_staff.index')->with('success', 'Staff deleted successfully');
            }
        }
        return redirect()->route('bcc_staff.index')->with('error', 'Something went wrong');
    }
}