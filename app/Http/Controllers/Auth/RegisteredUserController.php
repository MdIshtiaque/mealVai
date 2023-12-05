<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendVerificationCodeJob;
use App\Mail\SendVerificationCodeMail;
use App\Models\User;
use App\Models\VerificationCode;
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('sendMail', ['user' => $user]);
//        return view('auth.verify-code', ['user' => $user]);

//        return redirect(RouteServiceProvider::HOME);
    }

    public function sendMail(User $user)
    {
        try {
            SendVerificationCodeJob::dispatch($user);
        } catch (Exception $exception) {
            dd($exception);
        }

        return view('auth.verify-code', ['user' => $user]);
    }

    public function verify(Request $request)
    {
        $user = VerificationCode::with('user')->where('user_id', auth()->user()->id)->first();
        if ($request->code != $user->code) {
            return back();
        } else {
            $user->user->update([
                'is_verified' => true
            ]);

            $user->delete();

            flash()->addSuccess('You have successfully Logged in');
            return redirect()->route('dashboard');
        }
    }
}
