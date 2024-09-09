<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class NDCUserController extends Controller
{
    public function index()
    {
        $bcc_Staffs = User::whereIn('user_type', ['ndc_admin', 'ndc_security_admin', 'ndc_internal', 'ndc_vendor', 'ndc_customer'])->orderByDesc('id')->get();
        return view('ndc.ndc_user.index', get_defined_vars());
    }

    public function create()
    {
        return view('ndc.ndc_user.create');
    }

    public function edit($id)
    {
        $staff = User::findOrFail($id);

        return view('ndc.ndc_user.edit', get_defined_vars());
    }

    public function view($id)
    {
        $staff = User::findOrFail($id);
        return view('ndc.ndc_user.view', get_defined_vars());
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
        $message = 'NDC User successfully ';
        if ($request->has('id')) {
            $bccStaff = User::find($request->id);
            $rules['email'] = 'required|string|' . Rule::unique('users', 'email')->where('app_name', 'ndc')->whereNot('id', $request->id);
            $rules['phone'] = 'required|string|' . Rule::unique('users', 'phone')->where('app_name', 'ndc')->whereNot('id', $request->id);
            $rules['name'] = 'required|string|max:244';
            $rules['designation'] = 'required|string|max:244';
            $rules['organization'] = 'required|string|max:244';
            $rules['user_type'] = 'required|string|max:244';
            $rules['password'] = 'nullable|string|min:8';
            $rules['confirm_password'] = 'required_with:password|same:password';
            $message = $message . ' updated';
        } else {
            $bccStaff = new User();
            $rules['email'] = 'required|string|' . Rule::unique('users', 'email')->where('app_name', 'ndc');
            $rules['phone'] = 'required|string|' . Rule::unique('users', 'phone')->where('app_name', 'ndc');
            $rules['name'] = 'required|string';
            $rules['designation'] = 'required|string';
            $rules['organization'] = 'required|string|max:244';
            $rules['user_type'] = 'required|string|max:30';
            $rules['password'] = 'required|string|min:8';
            $rules['confirm_password'] = 'required|same:password';
            $message = $message . ' created';
            $bccStaff->app_name = 'ndc';
        }
        if ($request->user_type === 'ndc_admin') {
            $rules['ndc_admin_sector'] = 'required|string|in:Physical Security & Infrastructure,Network,Co Location,Server & Cloud,Email';
        }
        $request->validate($rules);

        try {
            $bccStaff->name = $request->name;
            $bccStaff->email = $request->email;
            $bccStaff->phone = $request->phone;
            $bccStaff->designation = $request->designation;
            $bccStaff->organization = $request->organization;
            $bccStaff->user_type = $request->user_type;
            if ($request->ndc_admin_sector) {
                $bccStaff->ndc_admin_sector = $request->ndc_admin_sector;
            }
            $bccStaff->active = $request->status;
            if ($request->password != null) {
                $bccStaff->password = Hash::make($request->password);
            }
            if ($bccStaff->save()) {
                $roleAdmin = Role::where('name', 'NDC Admin')->first();
                $roleSecurityAdmin = Role::where('name', 'NDC Security Admin')->first();
                if (!$roleAdmin) {
                    $roleAdmin = Role::create(['name' => 'NDC Admin']);
                }
                if (!$roleSecurityAdmin) {
                    $roleSecurityAdmin = Role::create(['name' => 'NDC Security Admin']);
                }
                if ($roleSecurityAdmin && $bccStaff->user_type === 'ndc_security_admin') {
                    $bccStaff->assignRole($roleSecurityAdmin);
                }
                if ($roleAdmin && $bccStaff->user_type === 'ndc_admin') {
                    $bccStaff->assignRole($roleAdmin);
                }
                return redirect()->route('ndc.user.index')->with('success', $message);
            }
            return redirect()->back()->withInput()->with('error', 'Data not updated');
        } catch (QueryException $e) {

            // return RedirectHelper::backWithInputFromException();

            return redirect()->back()->withInput()->with('error', 'Something went wrong');
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
        $ndc = User::find($id);
        if ($ndc) {
            if ($ndc->delete()) {
                return redirect()->route('ndc.user.index')->with('success', 'NDC User deleted successfully');
            }
        }
        return redirect()->route('ndc.user.index')->with('error', 'Something went wrong');
    }
}
