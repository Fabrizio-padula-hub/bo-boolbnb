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
        $request->validate(
            [
                'name' => ['required', 'string', 'min:3', 'max:50'],
                'lastname' => ['required', 'string', 'min:3','max:50'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'date_of_birth' => [
                    'required',
                    'date',
                    function($attribute, $value, $fail) {
                        // Condizione che verifica che l'utente non inserisca una data futura
                        if (Carbon::parse($value)->isFuture()) {
                            $fail('La data di nascita non è valida');
                        }
                        // Condizione che verifica che l'utente non sia minorenne
                        elseif (Carbon::parse($value)->diffInYears(now()) < 18) {
                            $fail('L\'utente deve essere maggiorenne.');
                        }
                        // Condizione che verifica che l'utente non abbia più di 90 anni
                        elseif (Carbon::parse($value)->diffInYears(now()) > 90) {
                            $fail('L\'utente non può avere più di 90 anni.');
                        }
                    }
                ],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],
            [
                'name.required' => 'Il campo nome è obbligatorio',
                'name.min'=> 'Il campo nome deve essere di almeno 3 caratteri',
                'name.max'=>'Il come nome deve essere di massimo 50 caratteri',
                'name.string'=>'Il campo nome deve essere una parola',
                'lastname.required'=> 'Il campo cognome è obbligatorio',
                'lastname.min'=> 'Il campo cognome deve essere di almeno 3 caratteri',
                'lastname.max'=>'Il come nome deve essere di massimo 50 caratteri',
                'lastname.string'=>'Il campo nome deve essere una parola',
                'email.required' => 'Il campo email è obbligatorio ',
                'email.email' => 'Inserisci un indirizzo email valido.',
                'email.unique' => 'Questo indirizzo email è presente',
                'date_of_birth.required' => 'Il campo data di nascita è obbligatorio',
                'date_of_birth.date' => 'Inserisci una data di nascita valida',
                'password.required' => 'Il campo password è obbligatorio',
                'password.confirmed' => 'La conferma della password non corrisponde',
               
            ]
        );
        

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
