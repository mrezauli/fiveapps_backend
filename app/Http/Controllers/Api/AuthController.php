<?php

namespace App\Http\Controllers\Api;

use App\Helper\CustomHelper;
use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use App\Rules\CurrentPasswordMatch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Summary of registration
     * @created 06-04-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function registration(Request $request)
    {
        $rules = [
            'full_name' => 'required|string|max:244',
            'email' => 'required|email:rfc,dns|unique:users',
            'phone' => 'required|string|max:17|unique:users',
            'password' => 'required|confirmed|string|min:8',
            'photo' => 'required|image|max:21000|mimes:jpg,png,gif,jpeg',
        ];

        if ($request->app_name === 'bcc') {
            $rules['organization'] = 'required|string|max:244';
            $rules['designation'] = 'required|string|max:244';
            $rules['isp_user_type'] = 'required|string|max:244';
            $rules['license_number'] = 'required|string|max:244';
        }

        if ($request->app_name === 'ndc') {
            $rules['organization'] = 'required|string|max:244';
            $rules['designation'] = 'required|string|max:244';
            $rules['user_type'] = 'required|string|max:244';
            $rules['identification_number'] = 'required|string|max:244|' . Rule::unique('users', 'identification_number')->where('app_name', 'ndc');
            $rules['photo'] = 'nullable|image|max:21000|mimes:jpg,png,gif,jpeg';
        }

        if ($request->app_name === 'itee') {
            $rules['occupation'] = 'required|string|max:244';
            $rules['linkedin'] = 'required|string';
        }

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $photo = '';
        if ($request->hasFile('photo')) {
            $photo = CustomHelper::storeImage($request->file('photo'), '/profile/');
        }

        if ($request->app_name === 'itee') {
            $oldOtp = Otp::where('email', $request->email)->first();
        }

        try {

            if ($request->app_name === 'itee') {
                if ($oldOtp) {
                    $oldOtp->delete();
                }
                $otp = rand(10000000, 99999999);
                $valid_until = date('Y-m-d H:i:s', strtotime('+30 minutes'));


                $otp = Otp::create(['email' => $request->email, 'otp' => $otp, 'valid_until' => $valid_until, 'type' => 'registration']);

                $receiver_email = $request->email;

                if ($otp) {
                    Mail::send('mail.otp_template', ['fname' => $request->full_name, 'otp' => $otp->otp], function ($msg) use ($receiver_email) {
                        $msg->to($receiver_email)
                            ->subject('Confirm registration');
                    });
                } else {
                    throw new Exception('Otp not send');
                }
            }

            $data = [
                'name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'photo' => $photo != false ? $photo : null,
                'app_name' => $request->app_name,
                // 'active' => 0
            ];

            if ($request->app_name === 'bcc') {
                $data['organization'] = $request->organization;
                $data['designation'] = $request->designation;
                $data['isp_user_type'] = $request->isp_user_type;
                $data['user_type'] = 'isp_staff';
                $data['license_number'] = $request->license_number;
                $data['active'] = 0;
            }

            if ($request->app_name === 'ndc') {
                $data['organization'] = $request->organization;
                $data['designation'] = $request->designation;
                $data['user_type'] = $request->user_type;
                $data['identification_number'] = $request->identification_number;
                $data['active'] = 1;
            }

            if ($request->app_name === 'bkiict') {
                $data['user_type'] = 'bkiict_student';
                $data['active'] = 1;
            }

            if ($request->app_name === 'itee') {
                $data['user_type'] = 'itee_student';
                $data['occupation'] = $request->occupation;
                $data['linkedin'] = $request->linkedin;
                $data['active'] = 0;
            }

            if (in_array($request->app_name, ['bcc', 'ndc', 'bkiict', 'itee'])) {
                $user = User::create($data);

                if ($request->app_name === 'itee') {
                    return response()->json([
                        'status' => true,
                        'message' => 'User Registration Successfully. Verification is pending.',
                        'email' => $user->email,
                        // 'token' => $user->createToken("authToken")->plainTextToken
                    ], 200);
                } else if ($request->app_name === 'bcc') {
                    return response()->json([
                        'status' => true,
                        'message' => 'Registration is completed. Your account is under verification.',
                        'token' => $user->createToken("authToken")->plainTextToken
                    ], 200);
                } else {
                    return response()->json([
                        'status' => true,
                        'message' => 'User Registration Successfully.',
                        'token' => $user->createToken("authToken")->plainTextToken
                    ], 200);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Please provide correct app_name',
                ], 422);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }

    public function registrationConfirmOtp(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string|min_digits:8|max_digits:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $otp = Otp::where('email', $request->email)->where('otp', $request->otp)->where('type', 'registration')->where('valid_until', '>=', date('Y-m-d H:i:s'))->first();

        if ($otp) {
            $otp->delete();

            $user = User::where('email', $request->email)->first();

            $user->update(['active' => 1]);

            return response()->json([
                'status' => true,
                'message' => 'User Registration Successfully',
                'token' => $user->createToken("authToken")->plainTextToken
            ], 200);

        } else {
            return response()->json([
                'status' => true,
                'message' => 'Otp not match. Please resend registration otp',
            ], 200);
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Login
     * @created 06-04-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function sign_in(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'email' => 'required|email:rfc,dns|exists:users,email',
            'password' => 'required|string|min:8',
            // 'app_name' => 'required|string'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if ($user?->active == 0) {
            return response()->json(['status' => false, 'message' => 'Invalid User', 'errors' => []], 422);
        }

        if (!auth()->attempt($request->only(['email', 'password']))) {
            return response()->json(['status' => false, 'message' => __('Invalid Credentials'), 'errors' => []], 422);
        }

        $accessToken = auth()->user()->createToken('authToken')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'User Login Successfully',
            'userType' => auth()->user()->user_type,
            'token' => $accessToken
        ], 200);

    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Login
     * @created 06-04-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function userProfile(Request $request)
    {
        $user = auth()->user();
        $existPhoto = file_exists(public_path($user?->photo)) && $user->photo != null;

        $responseData = [
            'userId' => $user->id,
            'name' => $user->name ?? 'None',
            'email' => $user->email ?? 'None',
            'phone' => $user->phone ?? 'None',
            'organization' => $user->organization ?? 'None',
            'designation' => $user->designation ?? 'None',
            'occupation' => $user->occupation ?? 'None',
            'linkedin' => $user->linkedin ?? 'None',
            'licenseNumber' => $user->license_number ?? 'None',
            'ispUserType' => $user->isp_user_type ?? 'None',
            'userType' => $user->user_type ?? 'None',
            'photo' => $existPhoto ? $user->photo : '/uploads/profile/demo.jpg',
        ];

        return response()->json(['status' => true, 'message' => '', 'records' => $responseData], 200);
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * Login
     * @created 06-04-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function sign_out(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'Sign Out Successfully',
        ], 200);
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * User Profile Update
     * @created 06-05-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'userId' => ['required'],
            'name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'organization' => ['nullable', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'licenseNumber' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::find($request->userId);
        try {
            if ($user) {
                $user->update([
                    'name' => $request->name,
                    'organization' => $request->organization,
                    'designation' => $request->designation,
                    'phone' => $request->phone,
                    'license_number' => $request->licenseNumber,
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'User Not Found',
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something is error',
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Profile Update Successfully',
        ], 200);
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * User Profile Update
     * @created 06-05-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function updateProfilePhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required|image|max:21000|mimes:jpg,png,gif,jpeg',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = User::find(auth()->user()->id);

            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = CustomHelper::storeImage($request->file('photo'), '/profile/');
            }

            if (!is_null($user->photo)) {
                CustomHelper::deleteFile($user->photo);
            }

            try {
                if ($user) {
                    $user->update([
                        'photo' => $photo,
                    ]);
                } else {
                    return response()->json([
                        'status' => true,
                        'message' => 'User Not Found',
                    ], 404);
                }
            } catch (Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Something is error',
                ], 500);
            }

            return response()->json([
                'status' => true,
                'message' => 'Profile Picture Update Successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * sendOtp
     * @created 06-05-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'email' => 'required|email|exists:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 422);
        }
        $oldOtp = Otp::where('email', $request->email)->first();
        try {
            if ($oldOtp) {
                $oldOtp->delete();
            }
            $otp = Otp::create(['email' => $request->email, 'otp' => rand(1487, 9999), 'type' => 'forget_password']);
            $data['otp'] = $otp->otp;
            $data['email'] = $request->email;
            Mail::send('mail.forget_pass_otp', $data, function ($msg) use ($data) {
                $msg->to($data['email'])
                    ->subject('Forget Password OTP');
            });
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Forget password otp send successfully',
        ], 200);
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * verify otp
     * @created 06-05-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'email' => 'required|email',
            'otp' => 'required|string|min_digits:4|max_digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 422);
        }
        $otp = Otp::where('email', $request->email)->where('otp', $request->otp)->where('type', 'forget_password')->first();

        if ($otp) {
            $otp->delete();

            return response()->json([
                'status' => true,
                'message' => 'Otp Verified Successfully',
            ], 200);

        } else {
            return response()->json([
                'status' => true,
                'message' => 'Otp not match. Please resend forget password otp',
            ], 200);
        }
    }

    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * forget password
     * @created 06-05-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required|string|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 422);
        }
        $user = User::where('email', $request->email)->first();

        try {
            if ($user) {

                $user->update([
                    'password' => Hash::make($request->new_password)
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Password Update Successfully',
                ], 200);

            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'User Not Found',
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something is error',
            ], 500);
        }
    }


    /**
     * @author Touch and Solve <email>
     * @contributor Sajjad sajjad.develpr@gmail.com
     * User Update Password
     * @created 06-05-24
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'current_password' => ['required', 'string', 'min:8', new CurrentPasswordMatch],
            'new_password' => ['required', 'string', 'min:8', 'required_with:password_confirmation', 'same:password_confirmation'],
            'password_confirmation' => ['required', 'string', 'min:8']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::find(auth()->user()->id);

        try {
            if ($user) {
                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'User Not Found',
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something is error',
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Password Update Successfully',
        ], 200);
    }

}
