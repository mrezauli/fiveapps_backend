<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\get;

class BKIICTStudentController extends Controller
{
    public function index()
    {
        $students = User::whereIn('user_type', ['bkiict_student', 'bkiict_admin'])->orderByDesc('id')->get();
        return view('bkiict.students.index', get_defined_vars());
    }

    public function create()
    {
        return view('bkiict.students.create');
    }

    public function store(Request $request)
    {
        $message = 'Student created successfully ';
        if ($request->has('id')) {
            $student = User::find($request->id);
            $rules['email'] = 'required|string|' . Rule::unique('users', 'email')->where('app_name', 'bkiict')->whereNot('id', $request->id);
            $rules['phone'] = 'required|string|' . Rule::unique('users', 'phone')->where('app_name', 'bkiict')->whereNot('id', $request->id);
            $rules['name'] = 'required|string|max:244';
            // $rules['designation'] = 'required|string|max:244';
            // $rules['organization'] = 'required|string|max:244';
            // $rules['user_type'] = 'required|string|max:244';
            $rules['password'] = 'nullable|string|min:8';
            $rules['confirm_password'] = 'required_with:password|same:password';
            $message = $message . ' updated';
        } else {
            $student = new User();
            $rules['email'] = 'required|string|' . Rule::unique('users', 'email')->where('app_name', 'bkiict');
            $rules['phone'] = 'required|string|' . Rule::unique('users', 'phone')->where('app_name', 'bkiict');
            $rules['name'] = 'required|string';
            // $rules['designation'] = 'required|string';
            // $rules['organization'] = 'required|string|max:244';
            // $rules['user_type'] = 'required|string|max:30';
            $rules['password'] = 'required|string|min:8';
            $rules['confirm_password'] = 'required|same:password';
            $message = $message . ' created';
            $student->app_name = 'bkiict';
        }
        $request->validate($rules);

        try {
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            // $student->designation = $request->designation;
            // $student->organization = $request->organization;
            $student->user_type = $request->user_type;
            $student->active = $request->status;
            if ($request->password != null) {
                $student->password = Hash::make($request->password);
            }
            if ($student->save()) {
                $role = Role::where('name', 'BKIICT Admin')->first();
                if ($role && $student->user_type === 'bkiict_admin') {
                    $student->assignRole($role);
                }
                return redirect()->route('bkiict.user.index')->with('success', $message);
            }
            return redirect()->back()->withInput()->with('error', 'Could not save data');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->with('error', 'There is something wrong.');
        }
    }

    public function view($id)
    {
        $student = User::where('user_type', 'itee_student')->findOrFail($id);
        return view('bkiict.students.view', compact('student'));
    }

    public function edit($id)
    {
        $student = User::where('user_type', 'itee_student')->findOrFail($id);
        return view('bkiict.students.edit', compact('student'));
    }

    public function delete($id)
    {
        $ndc = User::where('user_type', 'itee_student')->findOrFail($id);
        if ($ndc) {
            if ($ndc->delete()) {
                return redirect()->route('bkiict.user.index')->with('success', 'Student deleted successfully');
            }
        }
        return redirect()->route('bkiict.user.index')->with('error', 'Something went wrong');
    }
}