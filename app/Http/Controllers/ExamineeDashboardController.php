<?php

namespace App\Http\Controllers;

use App\Models\IteeExamFee;
use Illuminate\Http\Request;
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
        //$examFees = IteeExamFee::with(['exam_type', 'exam_category'])->whereIn('id', $examFeesIds)->get();
        return view('examinee.dashboard-enrolled-courses', compact('examRegs'));
    }

    public function unpaid()
    {
        $examFeesIds = IteeExamRegistration::where('user_id', auth()->user()->id)->where('user_id', auth()->user()->id)->get(['exam_fees_id']);
        $examFees = IteeExamFee::with(['exam_type', 'exam_category'])->whereIn('id', $examFeesIds)->get();
        return view('examinee.dashboard-enrolled-courses', compact('examFees'));
    }
}
