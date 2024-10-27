<?php

namespace App\Http\Controllers;

use App\Models\IteeBook;
use App\Models\IteeVenue;
use App\Models\IteeExamFee;
use App\Helper\CustomHelper;
use App\Models\IteeExamType;
use Illuminate\Http\Request;
use App\Models\IteeExamCategory;
use App\Models\IteeExamRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            // 'user_id'   => 'required|string|max:244',
            'itee_venue_id' => 'required|integer',
            'itee_exam_category_id' => 'required|integer',
            'itee_exam_type_id' => 'required|integer',
            'itee_exam_fees_id' => 'required|integer', //need to fix
            'itee_book_id' => 'required|string',
            //'itee_book_fees' => 'required|string|max:244', //need to fix
            'full_name' => 'required|string|max:244',
            'email' => 'required|email',
            'phone' => 'required|string|max:244',
            'dob' => 'required|string|max:244',
            'gender' => 'required|string|max:244',
            'address' => 'required|string',
            'post_code' => 'required|string|max:244',
            'occupation' => 'required|string|max:244',
            'linkedin' => 'required|string|max:244',
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:5300', //need to fix
            'education_qualification' => 'required|string|max:244',
            //'discipline' => 'nullable|string|max:244', //need to fix
            'subject_name' => 'nullable|string|max:244',
            'passing_year' => 'required|string|max:244',
            'institute_name' => 'required|string|max:244',
            'result' => 'required|string|max:244',
            'previous_passing_id' => 'nullable|string|max:244', // not require
            // 'payment'                   => 'required|string|max:244',
            // 'status'    => 'required|string|max:244',
        ]);

        if ($validator->fails()) {
            // Redirect back with validation errors and old input
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $photo = '';
        if ($request->hasFile('photo')) {
            $photo = CustomHelper::storeImage($request->file('photo'), '/itee/photo/');
        }
            $venue = IteeVenue::find($request->itee_venue_id);
            $exam_type = IteeExamType::find($request->itee_exam_type_id);
            $examine_id = $this->generateUniqueExamineeId(str_starts_with($exam_type->name, 'IP') ? 'IP' : 'FE');

            if(IteeExamRegistration::where('full_name', $request->full_name)->where('dob', $request->dob)->first()) {
                return redirect()->back()->withErrors($validator)->withInput();;
            }

            $examRegistration = IteeExamRegistration::create([
                'examine_id' => $examine_id,
                'user_id' => auth()->user()->id,
                'itee_venue_id' => $request->itee_venue_id,
                'itee_exam_category_id' => $request->itee_exam_category_id,
                'itee_exam_type_id' => $request->itee_exam_type_id,
                'exam_center' => $venue->name,
                'exam_fees' => IteeExamFee::find($request->itee_exam_fees_id)?->pluck('fee')->first(),
                'exam_fees_id' => $request->itee_exam_fees_id,
                'itee_book_id' => explode('|', $request->itee_book_id),
                'itee_book_fees' => IteeBook::whereIn('id', explode('|', $request->itee_book_id))->sum('book_price'),
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'address' => $request->address,
                'post_code' => $request->post_code,
                'occupation' => $request->occupation,
                'linkedin' => $request->linkedin,
                'photo' => $photo,
                'education_qualification' => $request->education_qualification,
                'subject_name' => $request->subject_name,
                'passing_year' => $request->passing_year,
                'institute_name' => $request->institute_name,
                'result' => $request->result,
                'previous_passing_id' => $request->previous_passing_id,
                'payment' => 'Unpaid',
                'status' => 0,
            ]);

            $message = 'Success! Your course in in review!';

            return view('examinee.dashboard', compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function home()
    {
        $examFees = IteeExamFee::with(['exam_type', 'exam_category'])->get();
        return view('examinee.home', compact('examFees'));
    }

    private function generateUniqueExamineeId($prefix)
    {
        $idx = $prefix;
        $idx .= date('y');
        $currentMonth = intval(date('m'));
        $idx .= $currentMonth > 4 && $currentMonth < 11 ? 2 : 1;
        $rnd = rand(111111, 999999);
        $idx .= substr($rnd, 0, 5);
        if (IteeExamRegistration::where('examine_id', $idx)->exists())
            $idx = $this->generateUniqueExamineeId($prefix);

        return $idx;
    }
}
