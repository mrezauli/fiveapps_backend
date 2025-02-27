<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Notifications\VerifyMobileNumber;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:17', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'mobile_number' => $request->phone,
            'verification_code' => Str::random(6), // Generate a 6-digit code
            'verification_code_expires_at' => now()->addMinutes(30), // Code expires in 30 minutes
            'password' => Hash::make($request->password),
            'user_type' => 'itee_student',
            'active' => 0
        ]);


        $user->notify(new VerifyMobileNumber($user->verification_code));

        event(new Registered($user));

        //$user->sendEmailVerificationNotification();

        //assign 'examinee' role to user
        $user->assignRole('Examinee');

        Auth::login($user);

        //making separate dashboard for examinee
        //return redirect(route('dashboard', absolute: false));
        return redirect(route('dashboard'));
    }
}