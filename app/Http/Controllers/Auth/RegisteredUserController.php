<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendVerificationCodeMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

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
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

//        $mailData = [
//            'title' => 'Verification code for verify your account',
//            'body' => 'This is your verification code',
//            'code' => generateUniqueVerificationCode(),
//            'name' => $request->name,
//        ];
//
//        Mail::to($request->email)->send(new SendVerificationCodeMail($mailData));

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('sendMail', ['user' => $user]);
//        return view('auth.verify-code', ['user' => $user]);

//        return redirect(RouteServiceProvider::HOME);
    }

    public function sendMail(User $user) {
        try {
            $mailData = [
                'title' => 'Verification code for verify your account',
                'body' => 'This is your verification code',
                'code' => generateUniqueVerificationCode(),
                'name' => $user->name,
            ];
//            dd($user->email);
            Mail::to($user->email)->send(new SendVerificationCodeMail($mailData));
        }catch (Exception $exception) {
            dd($exception);
        }

        return view('auth.verify-code', ['user' => $user]);
    }
}
