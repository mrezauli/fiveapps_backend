<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\BkiictTeacher;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\get;

class BKIICTTeacherController extends Controller
{
    public function index()
    {
        $students = BkiictTeacher::orderByDesc('id')->get();
        return view('bkiict.teacher.index', get_defined_vars());
    }

    public function create()
    {
        return view('bkiict.teacher.create');
    }

    public function store(Request $request)
    {
        $message = 'Trainer created successfully ';
        if ($request->has('id')) {
            $student = BkiictTeacher::find($request->id);
            $rules['email'] = 'required|string|' . Rule::unique('bkiict_trainers', 'email')->whereNot('id', $request->id);
            $rules['phone'] = 'required|string|' . Rule::unique('bkiict_trainers', 'phone')->whereNot('id', $request->id);
            $rules['name'] = 'required|string|max:244';
            $rules['designation'] = 'required|string|max:244';
            $rules['organization'] = 'required|string|max:244';
            $rules['experience'] = 'required|string|max:244';
            $rules['work_at'] = 'required|string|max:244';
            $rules['photo'] = 'nullable|image|mimes:jpg,jpeg,png,gif|max:5000';

            $message = $message . ' updated';
        } else {
            $student = new BkiictTeacher();
            $rules['email'] = 'required|string|' . Rule::unique('bkiict_trainers', 'email');
            $rules['phone'] = 'required|string|' . Rule::unique('bkiict_trainers', 'phone');
            $rules['name'] = 'required|string';
            $rules['designation'] = 'required|string';
            $rules['organization'] = 'required|string';
            $rules['experience'] = 'required|string|max:244';
            $rules['work_at'] = 'required|string|max:244';
            $rules['photo'] = 'required|image|mimes:jpg,jpeg,png,gif|max:5000';

            $message = $message . ' created';
        }
        $request->validate($rules);

        try {
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->designation = $request->designation;
            $student->organization = $request->organization;
            $student->experience = $request->experience;
            $student->work_at = $request->work_at;
            $student->status = $request->status;
            $oldPhoto = $student->photo;
            if ($request->hasFile('photo')) {
                $photo = CustomHelper::storeImage($request->file('photo'), '/bkiict/teacher/');
            }

            $student->photo = $photo ?? $oldPhoto;
            if ($student->save()) {
                if ($request->hasFile('photo') && $oldPhoto) {
                    CustomHelper::deleteFile($oldPhoto);
                }
                return redirect()->route('bkiict.teacher.index')->with('success', $message);
            }
            return redirect()->back()->with('error', 'Could not save data')->withInput();
        } catch (QueryException $e) {
            if ($photo) {
                CustomHelper::deleteFile($photo);
            }
            return redirect()->back()->with('error', 'There is something wrong.')->withInput();
        }
    }

    // public function view($id)
    // {
    //     $student = BkiictTeacher::findOrFail($id);
    //     return view('bkiict.teacher.view', compact('student'));
    // }

    public function edit($id)
    {
        $teacher = BkiictTeacher::findOrFail($id);
        return view('bkiict.teacher.edit', compact('teacher'));
    }

    public function delete($id)
    {
        $ndc = BkiictTeacher::findOrFail($id);
        if ($ndc) {
            if ($ndc->delete()) {
                return redirect()->route('bkiict.teacher.index')->with('success', 'Trainer deleted successfully');
            }
        }
        return redirect()->route('bkiict.teacher.index')->with('error', 'Something went wrong');
    }
}