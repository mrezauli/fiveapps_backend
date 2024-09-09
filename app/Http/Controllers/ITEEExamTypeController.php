<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Helper\RedirectHelper;
use App\Models\IteeExamCategory;
use App\Models\IteeExamType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class ITEEExamTypeController extends Controller
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
        $items = IteeExamType::orderByDesc('id')->get();
        return view('itee.exam_type.index', get_defined_vars());
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
        $categories = IteeExamCategory::where('status', 1)->get();
        return view('itee.exam_type.create', get_defined_vars());
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
        $item = IteeExamType::findOrFail($id);
        $categories = IteeExamCategory::where('status', 1)->get();

        return view('itee.exam_type.edit', get_defined_vars());
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
        $message = 'ITEE Exam Type successfully ';
        if ($request->has('id')) {
            $iteeExamType = IteeExamType::find($request->id);
            $rules['name'] = 'required';
            $rules['category_id'] = 'required';
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:1024';
            $rules['status'] = 'required';
            $message = $message . ' updated';
        } else {
            $iteeExamType = new IteeExamType();
            $rules['name'] = 'required';
            $rules['category_id'] = 'required';
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|max:1024';
            $rules['status'] = 'required';
            $message = $message . ' created';
        }
        $request->validate($rules);

        try {
            $oldFile = $iteeExamType->image;
            if ($request->hasFile('image')) {
                $file = CustomHelper::fileSystem($request->file('image'), "/itee/exam_type/");
            }

            $iteeExamType->name = $request->name;
            $iteeExamType->category_id = $request->category_id;
            $iteeExamType->image = $file->path ?? $oldFile;
            $iteeExamType->status = $request->status;

            if ($iteeExamType->save()) {

                return redirect()->route('itee.exam.type.index')->with('success', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {

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
        $iteeExamType = IteeExamType::find($id);
        if ($iteeExamType) {
            if ($iteeExamType->delete()) {
                return redirect()->route('itee.exam.type.index')->with('success', 'Itee Exam Category deleted successfully');
            }
        }
        return redirect()->route('itee.exam.type.index')->with('error', 'Something went wrong');
    }
}
