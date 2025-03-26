<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Notifications\VerifyMobileNumber;
use Xenon\LaravelBDSms\Sender;
use Xenon\LaravelBDSms\Provider\Ssl;

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
            'password' => Hash::make($request->password),
            'user_type' => 'itee_student',
            'active' => 0

            // 'verification_code' => Str::random(6), // Generate a 6-digit code
            // 'verification_code_expires_at' => now()->addMinutes(30), // Code expires in 30 minutes
            //'mobile_verify_code' => random_int(111111, 999999),
            //'mobile_verify_code_sent_at' => now(),
            //'mobile_attempts_left' => config('mobile.max_attempts'),
        ]);



        //$user->notify(new VerifyMobileNumber($user->verification_code));


        event(new Registered($user));
        $sender = Sender::getInstance();
        $sender->setProvider(Ssl::class); //change this provider class according to need
        $sender->setMobile($user->phone);
        //$sender->setMobile(['017XXYYZZAA','018XXYYZZAA']);
        $sender->setMessage("Your verification code is {$user->mobile_verify_code}");
        $sender->setQueue(false); //set true if you want to sent sms from queue
        $sender->setConfig(
        [
            'api_token' => 'Tanim-36c252c0-ef7f-44b1-aa5b-a0c4d55a7dd4',
            'sid' => 'BGDNONMASKING',
            'csms_id' => '005'
        ]
        );
        $status = $sender->send();
        //dd($sender->send());


        //$user->sendEmailVerificationNotification();

        //assign 'examinee' role to user
        $user->assignRole('Examinee');


        Auth::login($user);

        //making separate dashboard for examinee
        //return redirect(route('dashboard', absolute: false));
        return redirect(route('dashboard'));
    }
}