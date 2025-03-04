<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class VerificationController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required',
            'verification_code' => 'required',
        ]);

        $user = User::where('mobile_number', $request->mobile_number)
            ->where('verification_code', $request->verification_code)
            ->where('verification_code_expires_at', '>', now())
            ->first();

        if ($user) {
            $user->update([
                'mobile_verified_at' => now(),
                'verification_code' => null,
                'verification_code_expires_at' => null,
            ]);

            return response()->json(['message' => 'Mobile number verified successfully!']);
        }

        return response()->json(['message' => 'Invalid or expired verification code.'], 400);
    }
}