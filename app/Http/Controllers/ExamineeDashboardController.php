<?php

namespace App\Http\Controllers;

use App\Models\IteeBook;
use App\Models\IteeExamFee;
use Illuminate\Http\Request;
use App\Models\IteeAdmitCardData;
use Illuminate\Support\Facades\DB;
use App\Models\IteeExamRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ExamineeDashboardController extends Controller
{
    public function home()
    {
        $examFees = IteeExamFee::with(['exam_type', 'exam_category'])->get();
        return view('examinee.home', compact('examFees'));
    }

    public function profile()
    {
        return view('examinee.dashboard-profile');
    }

    public function settings()
    {
        return view('examinee.dashboard-settings');
    }

    public function settingsChange(Request $request)
    {
        $request->validate([
            'old_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('The old password is incorrect.');
                }
            }],
            'new_password' => ['required', 'string', 'min:8', 'confirmed', 'different:old_password'],
        ]);

        // Update the user's password
    $user = Auth::user();
    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('status', 'Password updated successfully!');
    }

    public function enrolled()
    {
        $examRegs = IteeExamRegistration::with(['examType', 'category', 'fee'])->where('user_id', auth()->user()->id)->get();
        return view('examinee.dashboard-enrolled-courses', compact('examRegs'));
    }

    public function unpaid()
    {
        $examRegs = IteeExamRegistration::with(['examType', 'category', 'fee'])->where('user_id', auth()->user()->id)->where('payment', 'Unpaid')->get();
        return view('examinee.dashboard-unpaid-courses', compact('examRegs'));
    }

    public function admitCard()
    {
        $admitCards = DB::table('itee_exam_registrations')
                        ->leftJoin('itee_admit_card_data', 'itee_exam_registrations.examine_id', '=', 'itee_admit_card_data.examine_id')
                        ->where('itee_exam_registrations.user_id', auth()->user()->id)
                        ->whereNotNull('itee_exam_registrations.transaction_id')
                        ->select('itee_exam_registrations.examine_id', 'itee_exam_registrations.full_name', 'itee_admit_card_data.id')
                        ->get();
        return view('examinee.dashboard-admit-card', compact('admitCards'));
    }

    public function result()
    {
        $results = DB::table('itee_exam_registrations')
                        ->leftJoin('itee_exam_results', 'itee_exam_registrations.examine_id', '=', 'itee_exam_results.examine_id')
                        ->where('itee_exam_registrations.user_id', auth()->user()->id)
                        ->whereNotNull('itee_exam_registrations.transaction_id')
                        ->select('itee_exam_results.examine_id', 'itee_exam_results.passer_id', 'itee_exam_results.name', 'itee_exam_results.morning_passer', 'itee_exam_results.afternoon_passer', 'itee_exam_results.passing_session', 'itee_exam_results.exam_type')
                        ->get();
        return view('examinee.dashboard-result', compact('results'));
    }

    public function payHostedCheckout(string $id)
    {
        $examReg = IteeExamRegistration::with(['examType', 'category', 'fee'])->find($id);
        $books = IteeBook::whereIn('id', $examReg->itee_book_id)->get();
        $totalBill = $examReg->exam_fees + $books->sum('book_price');
        return view('examinee.exampleHosted', compact('examReg', 'totalBill', 'books'));
    }
}
