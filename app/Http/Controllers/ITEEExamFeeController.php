<?php

namespace App\Http\Controllers;

use App\Models\IteeExamCategory;
use App\Models\IteeExamFee;
use App\Models\IteeExamType;
use Exception;
use Illuminate\Http\Request;

class ITEEExamFeeController extends Controller
{
    public function index()
    {
        $exam_fees = IteeExamFee::orderByDesc('id')->get();
        return view('itee.exam-fee.index', get_defined_vars());
    }

    public function create()
    {
        $types = IteeExamType::all();
        $categories = IteeExamCategory::all();
        return view('itee.exam-fee.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        $request->validate([
            'exam_name' => 'required',
            'category_id' => 'required',
            'exam_type_id' => 'required',
            'exam_fee' => 'required|numeric',
            'exam_details' => 'required',
            // 'exam_start' => 'required|date',
            'exam_start' => 'required|date_format:Y-m-d\TH:i',
            // 'exam_end' => 'required|date',
            'exam_end' => 'required|date_format:Y-m-d\TH:i',
        ]);

        try {

            if ($request->has('id')) {
                $exam_fee = IteeExamFee::find($request->id);
            } else {
                $exam_fee = new IteeExamFee();
            }

            $exam_fee->name = $request->exam_name;
            $exam_fee->itee_exam_category_id = $request->category_id;
            $exam_fee->itee_exam_type_id = $request->exam_type_id;
            $exam_fee->fee = $request->exam_fee;
            $exam_fee->details = $request->exam_details;
            $exam_fee->exam_start = $request->exam_start;
            $exam_fee->exam_end = $request->exam_end;
            if ($exam_fee->save()) {
                return redirect()->route('itee.exam-fee.index')->with('success', 'Exam fee saved successfully');
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to save exam fee');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong');
        }
    }

    public function view($id, Request $request)
    {
        $exam_fee = IteeExamFee::findOrFail($request->id);
        return view('itee.exam-fee.view', get_defined_vars());
    }

    public function edit($id, Request $request)
    {
        $exam_fee = IteeExamFee::findOrFail($request->id);
        $types = IteeExamType::all();
        $categories = IteeExamCategory::all();
        return view('itee.exam-fee.edit', get_defined_vars());
    }

    public function delete($id)
    {
        $result = IteeExamFee::findOrFail($id);
        if ($result->delete()) {
            return redirect()->route('itee.exam-fee.index')->with('success', 'Exam fee deleted successfully');
        } else {
            return redirect()->route('itee.exam-fee.index')->with('error', 'Failed to delete exam fee');
        }
    }
}
