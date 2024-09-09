<?php

namespace App\Http\Controllers;

use App\Models\BkiictCenter;
use App\Models\BkiictCourse;
use App\Models\BkiictTeacher;
use Exception;
use Illuminate\Http\Request;

class BKIICTCourseController extends Controller
{
    public function index()
    {
        $courses = BkiictCourse::orderByDesc('id')->get();
        return view('bkiict.course.index', get_defined_vars());
    }

    public function create()
    {
        $centers = BkiictCenter::where('status', 1)->get();
        $cordinators = BkiictTeacher::where('work_at', 'coordinator')->get();
        $instructors = BkiictTeacher::where('work_at', 'instructor')->get();
        return view('bkiict.course.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|min:10|max:1024',
            'tools' => 'required|string|min:3|max:1024',
            'requirements' => 'required|string|min:3|max:2048',
            'project' => 'required|string|min:3|max:2048',
            'overview' => 'required|string|min:10',
            'outline' => 'required|string|min:10',
            'center_id' => 'required|numeric',
            'type' => 'required|string|in:short,long,customized',
            'duration' => 'required|string|min:3|max:255',
            'hours' => 'required|numeric',
            'classes' => 'required|numeric',
            'fee' => 'required|string|min:3|max:255',
            'shift' => 'required|string|min:3|max:255',
            'cordinator' => 'required',
            'instructor' => 'required',
            // 'deadline' => 'required|string|min:3|max:255',
            // 'class_start' => 'required|string|min:3|max:255',
            // 'status' => 'required|string|in:ongoing,upcoming,deactive',
            'status' => 'required',
        ]);


        $request->merge(['instructor' => json_encode($request->instructor)]);


        try {
            if ($request->has('id')) {
                $center = BkiictCourse::findOrFail($request->id);
                $center->update($request->all());
                return redirect()->back()->with('success', 'Course updated successfully.');
            }
            BkiictCourse::create($request->all());
            return redirect()->route('bkiict.course.index')->with('success', 'Course created successfully.');
        } catch (Exception $e) {
            return redirect()->route('bkiict.course.create')->with('error', 'Something happened wrong, please try again later.')->withInput();
        }
    }

    // public function view($id)
    // {
    //     try {
    //         $course = BkiictCourse::findOrFail($id);
    //         return view('bkiict.course.view', compact('course'));
    //     } catch (Exception $e) {
    //         return redirect()->route('bkiict.course.index')->with('error', 'Course not found');
    //     }
    // }

    public function edit($id)
    {
        try {
            $course = BkiictCourse::findOrFail($id);
            $centers = BkiictCenter::where('status', 1)->get();
            $cordinators = BkiictTeacher::where('work_at', 'coordinator')->get();
            $instructors = BkiictTeacher::where('work_at', 'instructor')->get();
            return view('bkiict.course.edit', get_defined_vars());
        } catch (Exception $e) {
            return redirect()->route('bkiict.course.index')->with('error', 'Course not found');
        }
    }


    public function delete($id)
    {
        try {
            $center = BkiictCourse::findOrFail($id);
            $center->delete();
            return redirect()->route('bkiict.course.index')->with('success', 'Course deleted successfully');
        } catch (Exception $e) {
            return redirect()->route('bkiict.course.index')->with('error', 'Course not found');
        }
    }
}
