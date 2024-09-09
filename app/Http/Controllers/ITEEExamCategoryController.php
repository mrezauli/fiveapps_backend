<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\IteeExamCategory;
use App\Models\IteeExamType;
use App\Models\IteeNotice;
use App\Models\IteeVenue;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ITEEExamCategoryController extends Controller
{
    public function index()
    {
        $items = IteeExamCategory::orderByDesc('id')->get();
        return view('itee.exam_category.index', get_defined_vars());
    }

    public function create()
    {
        return view('itee.exam_category.create', get_defined_vars());
    }

    public function edit($id)
    {
        $item = IteeExamCategory::findOrFail($id);

        return view('itee.exam_category.edit', get_defined_vars());
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
        $message = 'ITEE Exam Category successfully ';
        if ($request->has('id')) {
            $iteeExamCategory = IteeExamCategory::find($request->id);
            $rules['name'] = 'required';
            $rules['status'] = 'required';
            $message = $message . ' updated';
        } else {
            $iteeExamCategory = new IteeExamCategory();
            $rules['name'] = 'required';
            $rules['status'] = 'required';
            $message = $message . ' created';
        }
        $request->validate($rules);

        try {
            $iteeExamCategory->name = $request->name;
            $iteeExamCategory->status = $request->status;

            if ($iteeExamCategory->save()) {

                return redirect()->route('itee.exam.category.index')->with('success', $message);
            }
            return RedirectHelper::backWithInput();
        } catch (QueryException $e) {

            return RedirectHelper::backWithInputFromException();
        }

    }

    public function delete($id)
    {
        $iteeExamCategory = IteeExamCategory::find($id);
        if ($iteeExamCategory) {
            try {
                if ($iteeExamCategory->delete()) {
                    return redirect()->route('itee.exam.category.index')->with('success', 'Itee Exam Category deleted successfully');
                }
            } catch (\Exception $th) {
                dd($th->getMessage());
                return redirect()->route('itee.exam.category.index')->with('error', 'Something went wrong');
            }
        } else {
            return back();
        }

    }
}
