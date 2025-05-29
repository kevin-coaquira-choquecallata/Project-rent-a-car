<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;

//use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'max:255', 'unique:users,email', 'regex:/^[\w\.\-]+@[\w\-]+\.[a-zA-Z]{2,}$/'],
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/'
                ],
            ],
            [
                'password.regex' => 'La contraseña debe tener al menos una letra mayúscula, una minúscula y un número.',
                'email.regex' => 'El correo debe tener un formato válido como ejemplo@dominio.com',
            ]
        );
        //dd($validator->errors()->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect($this->redirectTo($user));
    }
    protected function redirectTo($user)
    {

        if (!$user || !$user->role) {
            return '/';
        }

        return match ($user->role->nombre) {
            'admin' => '/admin/usuarios',
            'oficina' => '/oficina',
            'lavadero' => '/lavadero',
            'mecanico' => '/mecanico',
            default => '/',
        };
    }
}
