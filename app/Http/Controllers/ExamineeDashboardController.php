<?php

namespace App\Http\Controllers;

use App\Models\IteeBook;
use App\Models\IteeVenue;
use App\Models\IteeExamFee;
use App\Models\IteeExamType;
use Illuminate\Http\Request;
use App\Models\IteeExamCategory;
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
            'exam_fees' => 'required|string|max:244',
            'fee_id' => 'required|integer',
            'itee_book_id' => 'required|string',
            'itee_book_fees' => 'required|string|max:244',
            'full_name' => 'required|string|max:244',
            'email' => 'required|email',
            'phone' => 'required|string|max:244',
            'dob' => 'required|string|max:244',
            'gender' => 'required|string|max:244',
            'address' => 'required|string',
            'post_code' => 'required|string|max:244',
            'occupation' => 'required|string|max:244',
            'linkedin' => 'required|string|max:244',
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:5300',
            'education_qualification' => 'required|string|max:244',
            'discipline' => 'nullable|string|max:244',
            'subject_name' => 'nullable|string|max:244',
            'passing_year' => 'required|string|max:244',
            'institute_name' => 'required|string|max:244',
            'result' => 'required|string|max:244',
            'previous_passing_id' => 'nullable|string|max:244', // not require
            // 'payment'                   => 'required|string|max:244',
            // 'status'    => 'required|string|max:244',
        ]);
        dd($id);

        // 1 3
        // 1|3

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 422);
        }
        $photo = '';
        if ($request->hasFile('photo')) {
            $photo = CustomHelper::storeImage($request->file('photo'), '/itee/photo/');
        }

        try {
            // ------------------
            //
            // ------------------
            $venue = IteeVenue::find($request->itee_venue_id);
            $exam_type = IteeExamType::find($request->itee_exam_type_id);
            $examine_id = $this->generateUniqueExamineeId(str_starts_with($exam_type->name, 'IP') ? 'IP' : 'FE');

            if(IteeExamRegistration::where('full_name', $request->full_name)->where('dob', $request->dob)->first()) {
                throw new Exception('Person is already registered for an exam previously.');
            }
            $examRegistration = IteeExamRegistration::create([
                'examine_id' => $examine_id,
                'user_id' => auth()->user()->id,
                'itee_venue_id' => $request->itee_venue_id,
                'itee_exam_category_id' => $request->itee_exam_category_id,
                'itee_exam_type_id' => $request->itee_exam_type_id,
                'exam_center' => $venue->name,
                'exam_fees' => $request->exam_fees,
                'exam_fees_id' => $request->fee_id,
                'itee_book_id' => explode('|', $request->itee_book_id),
                'itee_book_fees' => $request->itee_book_fees,
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

            $notify_message = "New exam registration submitted";
            $users = User::whereHas('roles', function ($query) {
                $query->where('name', "ITEE Admin");
            })->get();
            Notification::send($users, new AllNotification($notify_message));
            $responseData = ['exam_registration_id' => $examRegistration->id, 'examine_id' => $examine_id];
            return response()->json(['status' => true, 'message' => 'Exam Registration Successfully', 'records' => $responseData], 200);
        } catch (\Throwable $th) {
            if ($request->hasFile('photo') && $photo) {
                $photo = CustomHelper::deleteFile($photo);
            }

            return response()->json(['status' => true, 'message' => 'Something is error.', 'records' => [$th->getMessage()]], 200);
        }

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
}