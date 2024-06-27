<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon; // Importato Carbon per la gestione delle date

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
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'date_of_birth' => [
                'required',
                 'date',
                    function($attribute, $value, $fail) {
                        // condizione che verifica che l'utente non inserisca una data futura
                        if (Carbon::parse($value)->isFuture()) {
                            $fail('La data di nascita non può essere futura.');
                        }// condizione che verifica che l'utente non sia minorenne
                        elseif (Carbon::parse($value)->diffInYears(now()) < 18) {
                            $fail('L\'utente deve essere maggiorenne.');
                        }// condizione che verifica che l'utente non abbia più di 90 anni
                        if (Carbon::parse($value)->diffInYears(now()) > 90) {
                            $fail('L\'utente non può avere più di 90 anni.');
                        }
                    },
    
        ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
