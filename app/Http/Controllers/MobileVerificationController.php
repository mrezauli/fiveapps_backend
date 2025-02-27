<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobileVerificationController extends Controller
{
    public function sendVerificationCode()
    {
        $user = Auth::user();

        if ($user->hasVerifiedMobile()) {
            return response()->json(['message' => 'Mobile number already verified.'], 400);
        }

        $user->sendMobileVerificationNotification();

        return response()->json(['message' => 'Verification code sent.']);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'mobile_verification_code' => 'required|numeric',
        ]);

        $user = Auth::user();

        if ($user->verifyMobile($request->mobile_verification_code)) {
            return response()->json(['message' => 'Mobile number verified successfully.']);
        }

        return response()->json(['message' => 'Invalid verification code.'], 400);
    }
}