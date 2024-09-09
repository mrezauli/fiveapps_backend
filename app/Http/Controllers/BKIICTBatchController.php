<?php

namespace App\Http\Controllers;

use App\Models\BkiictBatch;
use App\Models\BkiictCourse;
use Exception;
use Illuminate\Http\Request;

class BKIICTBatchController extends Controller
{
    public function index()
    {
        $batches = BkiictBatch::orderByDesc('id')->get();
        return view('bkiict.batch.index', get_defined_vars());
    }
    public function create()
    {
        $courses = BkiictCourse::orderByDesc('id')->get();
        return view('bkiict.batch.create', get_defined_vars());
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'number' => 'required|numeric',
            'class_start' => 'required|date',
            'course_end' => 'required|date',
            'deadline' => 'required|date|before_or_equal:class_start',
            'bkiict_course_id' => 'required',
            // 'status' => 'required',
            'status' => 'required|string|in:ongoing,upcoming,deactive',
        ]);

        try {
            if ($request->has('id')) {
                $batch = BkiictBatch::findOrFail($request->id);
                $batch->update($request->all());
                return redirect()->back()->with('success', 'Batch updated successfully.');
            }

            $isExists = BkiictBatch::where('number', $request->number)->where('bkiict_course_id', $request->bkiict_course_id)->exists();

            if ($isExists) {
                return redirect()->back()->with('error', 'Batch already exists')->withInput();
            }
            BkiictBatch::create($request->all());
            return redirect()->route('bkiict.batch.index')->with('success', 'Batch created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.')->withInput();
        }
    }
    public function edit($id)
    {
        try {
            $batch = BkiictBatch::findOrFail($id);
            $courses = BkiictCourse::orderByDesc('id')->get();
            return view('bkiict.batch.edit', get_defined_vars());
        } catch (Exception $e) {
            return redirect()->route('bkiict.batch.index')->with('error', 'Something went wrong. Please try again later.');
        }
    }
    public function delete($id)
    {
        try {
            $batch = BkiictBatch::findOrFail($id);
            $batch->delete();
            return redirect()->route('bkiict.batch.index')->with('success', 'Batch deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('bkiict.batch.index')->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
