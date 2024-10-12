<?php

namespace App\Http\Controllers;

use App\Models\IteeExamFee;
use Illuminate\Http\Request;

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
        //dd(IteeExamFee::find($id));
        return view('examinee.dashboard-checkout');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}