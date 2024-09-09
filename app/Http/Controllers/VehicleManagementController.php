<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\User;
use App\Models\VlmStaffHierarchy;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class VehicleManagementController extends Controller
{
    public function index()
    {   
        $bcc_Staffs = User::whereIn('user_type', ['vlm_driver', 'vlm_staff', 'vlm_senior_officer', 'vlm_admin'])->orderByDesc('id')->get();
        return view('vm.user.index', get_defined_vars());
    }

    public function create()
    {
        return view('vm.user.create');
    }

    public function edit($id)
    {
        $staff = User::findOrFail($id);

        return view('vm.user.edit', get_defined_vars());
    }

    public function view($id)
    {
        $item = User::findOrFail($id);
        return view('vm.user.view', get_defined_vars());
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
        $message = 'VM User successfully ';
        if ($request->has('id')) {
            $vlmStaff = User::find($request->id);
            $rules['email'] = 'required|string|' . Rule::unique('users', 'email')->where('app_name', 'vlm')->whereNot('id', $request->id);
            $rules['phone'] = 'required|string|' . Rule::unique('users', 'phone')->where('app_name', 'vlm')->whereNot('id', $request->id);
            $rules['name'] = 'required|string|max:244';
            $rules['designation'] = 'required|string|max:244';
            $rules['organization'] = 'required|string|max:244';
            $rules['user_type'] = 'required|string|max:244';
            $rules['password'] = 'nullable|string|min:8';
            $rules['confirm_password'] = 'required_with:password|same:password';
            $message = $message . ' updated';
        } else {
            $vlmStaff = new User();
            $rules['email'] = 'required|string|' . Rule::unique('users', 'email')->where('app_name', 'vlm');
            $rules['phone'] = 'required|string|' . Rule::unique('users', 'email')->where('app_name', 'vlm');
            $rules['name'] = 'required|string';
            $rules['designation'] = 'required|string';
            $rules['organization'] = 'required|string|max:244';
            $rules['user_type'] = 'required|string|max:30';
            $rules['password'] = 'required|string|min:8';
            $rules['confirm_password'] = 'required|same:password';
            $message = $message . ' created';
        }
        $request->validate($rules);

        try {
            $vlmStaff->name = $request->name;
            $vlmStaff->email = $request->email;
            $vlmStaff->phone = $request->phone;
            $vlmStaff->designation = $request->designation;
            $vlmStaff->organization = $request->organization;
            $vlmStaff->user_type = $request->user_type;
            $vlmStaff->active = $request->status;
            $vlmStaff->app_name = 'vlm';
            if ($request->password != null) {
                $vlmStaff->password = Hash::make($request->password);
            }
            if ($vlmStaff->save()) {
                if ($vlmStaff->user_type === 'vlm_admin') {
                    $role_admin = Role::where('name', 'VLM Admin')->first();
                    if ($role_admin)
                        $vlmStaff->assignRole($role_admin);
                } else if ($vlmStaff->user_type === 'vlm_senior_officer') {
                    $role_senior_officer = Role::where('name', 'VLM Senior Officer')->first();
                    if ($role_senior_officer)
                        $vlmStaff->assignRole($role_senior_officer);
                } /* --- */ else if ($vlmStaff->user_type === 'vlm_staff') {
                    $role_staff = Role::where('name', 'VLM Staff')->first();
                    if ($role_staff)
                        $vlmStaff->assignRole($role_staff);
                }
                return redirect()->route('vm.user.index')->with('success', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {
            dd($e->getMessage());
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
        $vlm = User::find($id);
        if ($vlm) {
            if ($vlm->delete()) {
                return redirect()->route('vm.user.index')->with('success', 'VLM User deleted successfully');
            }
        }
        return redirect()->route('vm.user.index')->with('error', 'Something went wrong');
    }

    // Staff Hierarchy

    public function staffHierarchy(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->has('senior_officer') && $request->has('junior_staff')) {
                $senior_officer = $request->senior_officer;
                $junior_staff = $request->junior_staff;

                $staffHierarchy = VlmStaffHierarchy::where('seniorStaffId', $senior_officer)->first();
                try {
                    if ($staffHierarchy) {
                        $staffHierarchy->juniorStaffs = json_encode(explode(',', $junior_staff));
                        $staffHierarchy->save();
                    } else {
                        $staffHierarchy = new VlmStaffHierarchy();
                        $staffHierarchy->seniorStaffId = $senior_officer;
                        $staffHierarchy->juniorStaffs = json_encode(explode(',', $junior_staff));
                        $staffHierarchy->save();
                    }
                    return back()->with('success', 'Staff hierarchy updated successfully');
                } catch (Exception $e) {
                    return back()->with('error', 'Something is error');
                }

            } else {
                return back()->with('error', 'Please select senior officer and junior staff');
            }
        } else {
            $senior_staffs = User::where('user_type', 'vlm_senior_officer')->where('app_name', 'vlm')->orderByDesc('id')->get();
            return view('vm.user.hierarchy-manage', get_defined_vars());
        }
    }

    public function staffs()
    {
        try {
            $seniorId = request()->get('seniorId');
            $seniorStaff = VlmStaffHierarchy::where('seniorStaffId', $seniorId)->first();
            $juniorStaffs = $seniorStaff?->juniorStaffs;
            $allJuniors = User::select('id', 'name')->where('user_type', 'vlm_staff')->where('app_name', 'vlm')->get();

            return response()->json(['juniorStaffs' => json_decode($juniorStaffs) ?? [], 'allJuniors' => $allJuniors/* ->toArray() */ ?? ['sdsd']]);
        } catch (\Exception $e) {
            return response()->json(['juniorStaffs' => [], 'allJuniors' => [], 'error' => $e->getMessage()]);
        }
    }
}
