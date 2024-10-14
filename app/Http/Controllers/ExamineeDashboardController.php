<?php

namespace App\Http\Controllers;

use App\Models\IteeBook;
use App\Models\IteeVenue;
use App\Models\IteeExamFee;
use App\Models\IteeExamType;
use Illuminate\Http\Request;
use App\Models\IteeExamCategory;
use Illuminate\Support\Facades\Auth;

class ExamineeDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $examFees = IteeExamFee::with(['exam_type', 'exam_category'])->get();
        return view('examinee.dashboard-courses', compact('examFees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('examinee.dashboard-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $examFee = IteeExamFee::with(['exam_type', 'exam_category'])->findOrFail($id);
        //dd($examFee->exam_type->id);
        $venues = IteeVenue::all();
        $categories = IteeExamCategory::all();
        $types = IteeExamType::all();
        $fees = IteeExamFee::all();
        $books = IteeBook::all();
        if (Auth::check()) {
            $user = Auth::user();
        }
        return view('examinee.dashboard-submit-course', compact('venues', 'categories', 'types', 'examFee', 'fees', 'books', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $examFee = IteeExamFee::with(['exam_type', 'exam_category'])->findOrFail($id);
        //dd($examFee->exam_type->id);
        $examFees = IteeExamFee::with(['exam_type', 'exam_category'])->get();
        return view('examinee.dashboard-courses', compact('examFees', 'examFee'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}