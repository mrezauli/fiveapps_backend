<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\District;
use App\Models\Division;
use App\Models\NttnProvider;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\User;
use App\Notifications\UserCreateNotification;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class NTTNStaffController extends Controller
{
    public function index()
    {
        if (CustomHelper::userRoleName(auth()->user()) == 'Super Admin') {

            $staffs = User::where('active', User::$statusArray[1])->where(function ($query) {
                $query->where('user_type', '=', 'nttn_sbl_staff')
                    ->orWhere('user_type', '=', 'nttn_adsl_staff');
            })->orderByDesc('id')->get();
        } else {
            $staffs = User::where('active', User::$statusArray[1])->where('user_type', auth()->user()->user_type)->orderByDesc('id')->get();
        }
        return view('nttn_staff.index', get_defined_vars());
    }

    public function create()
    {
        $divisions = Division::all();
        $districts = District::get(['id', 'name', 'division_id']);
        $upazilas = Upazila::get(['id', 'name', 'district_id']);
        $unions = Union::get(['id', 'name', 'upazila_id']);

        return view('nttn_staff.create', get_defined_vars());
    }

    public function edit($id)
    {
        $divisions = Division::all();
        $districts = District::get(['id', 'name', 'division_id']);
        $upazilas = Upazila::get(['id', 'name', 'district_id']);
        $unions = Union::get(['id', 'name', 'upazila_id']);
        $staff = User::findOrFail($id);

        return view('nttn_staff.edit', get_defined_vars());
    }

    public function view($id)
    {
        $staff = User::findOrFail($id);

        return view('nttn_staff.view', get_defined_vars());
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
        $message = 'NTTN Staff successfully ';
        if ($request->has('id')) {
            $nttn_staff = User::find($request->id);
            $rules['email'] = 'required|string|' . Rule::unique('users', 'email')->where('app_name', 'bcc')->whereNot('id', $request->id);
            $rules['phone'] = 'required|string|' . Rule::unique('users', 'phone')->where('app_name', 'bcc')->whereNot('id', $request->id);
            $rules['name'] = 'required|string';
            $rules['designation'] = 'required|string';
            $rules['division_id'] = 'required|numeric';
            $rules['district_id'] = 'required|numeric';
            $rules['upazila_id'] = 'required|numeric';
            $rules['union_id'] = 'required|numeric';
            $rules['password'] = 'nullable|string|min:8';
            $rules['confirm_password'] = 'required_with:password|same:password';
            if ($request->provider_slug) {
                $nttn_staff->user_type = "nttn_" . $request->provider_slug . '_staff';
            } else {
                $nttn_staff->user_type = auth()->user()->user_type;
            }
            $message = $message . ' updated';
        } else {
            $nttn_staff = new User();
            $rules['email'] = 'required|string|' . Rule::unique('users', 'email')->where('app_name', 'bcc');
            $rules['phone'] = 'required|string|' . Rule::unique('users', 'phone')->where('app_name', 'bcc');
            $rules['name'] = 'required|string';
            $rules['designation'] = 'required|string';
            $rules['division_id'] = 'required|numeric';
            $rules['district_id'] = 'required|numeric';
            $rules['upazila_id'] = 'required|numeric';
            $rules['union_id'] = 'required|numeric';
            $rules['password'] = 'required|string|min:8';
            $rules['confirm_password'] = 'required|string|same:password|min:8';
            $message = $message . ' created';
            if ($request->provider_slug) {
                $nttn_staff->user_type = "nttn_" . $request->provider_slug . '_staff';
            } else {
                $nttn_staff->user_type = auth()->user()->user_type;
            }
            $nttn_staff->active = $request->status;
        }
        $request->validate($rules);

        try {
            $nttn_staff->name = $request->name;
            $nttn_staff->email = $request->email;
            $nttn_staff->phone = $request->phone;
            $nttn_staff->designation = $request->designation;
            $nttn_staff->division_id = $request->division_id;
            $nttn_staff->district_id = $request->district_id;
            $nttn_staff->upazila_id = $request->upazila_id;
            $nttn_staff->union_id = $request->union_id;
            if ($request->password != null) {
                $nttn_staff->password = Hash::make($request->password);
            }
            if ($nttn_staff->save()) {
                $role = Role::where('name', 'NTTN Staff')->first();
                if ($role) {
                    $nttn_staff->assignRole($role);
                }

                $nttn_staff->notify(new UserCreateNotification("Congratulation our touchandsolve family."));
                return redirect()->route('nttn_staff.index')->with('success', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {
            dd($e->getMessage());
            return RedirectHelper::backWithInputFromException();
        }

    }

    public function delete($id)
    {
        $nttn = User::find($id);
        if (starts_with($nttn->user_type, 'nttn')) {
            if ($nttn->delete()) {
                return redirect()->route('nttn_staff.index')->with('success', 'Staff deleted successfully');
            }
        }

        return redirect()->route('nttn_staff.index')->with('error', 'Something went wrong');
    }
}
