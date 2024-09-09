<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\IteeCourseOutline;
use App\Models\IteeSyllabus;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class ITEECourseOutlineController extends Controller
{
    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Exam Type Store
     * @created 11-05-24
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function index()
    {
        $items = IteeCourseOutline::orderByDesc('id')->get();
        return view('itee.course_outline.index', get_defined_vars());
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Exam Type Store
     * @created 11-05-24
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function create()
    {
        return view('itee.course_outline.create');
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Exam Type Store
     * @created 11-05-24
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function edit($id)
    {
        $item = IteeCourseOutline::findOrFail($id);

        return view('itee.course_outline.edit', get_defined_vars());
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Exam Type Store
     * @created 11-05-24
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function store(Request $request)
    {
        $message = 'ITEE Course Outline successfully ';
        if ($request->has('id')) {
            $iteeCourseOutline = IteeCourseOutline::find($request->id);
            $rules['name'] = 'required';
            $rules['course_outline_file'] = 'required|file|max:21000|mimes:pdf';
            $rules['status'] = 'required';
            $message = $message . ' updated';
        } else {
            $iteeCourseOutline = new IteeCourseOutline();
            $rules['name'] = 'required';
            $rules['course_outline_file'] = 'required|file|max:21000|mimes:pdf';
            $rules['status'] = 'required';
            $message = $message . ' created';
        }
        $request->validate($rules);
        $oldFile = $iteeCourseOutline->course_outline_file;
        if ($request->hasFile('course_outline_file')) {
            $file = CustomHelper::fileSystem($request->file('course_outline_file'), "/itee/course_outline/");
        }
        try {
            $iteeCourseOutline->name = $request->name;
            $iteeCourseOutline->course_outline_file = $file->path ?? $oldFile;
            $iteeCourseOutline->status = $request->status;

            if ($iteeCourseOutline->save()) {
                if ($request->hasFile('course_outline_file') && $oldFile) {
                    CustomHelper::deleteFile($oldFile);
                }
                return redirect()->route('itee.course.outline.index')->with('success', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {
            if ($request->hasFile('course_outline_file') && $file) {
                CustomHelper::deleteFile($file->path);
            }
            return RedirectHelper::backWithInputFromException();
        }

    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Exam Type Store
     * @created 11-05-24
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function delete($id)
    {
        $iteeCourseOutline = IteeCourseOutline::find($id);
        if ($iteeCourseOutline) {
            if ($iteeCourseOutline->delete()) {
                CustomHelper::deleteFile($iteeCourseOutline->course_outline_file);
                return redirect()->route('itee.course.outline.index')->with('success', 'Itee Course Outline deleted successfully');
            }
        }
        return redirect()->route('itee.course.outline.index')->with('error', 'Something went wrong');
    }
}
