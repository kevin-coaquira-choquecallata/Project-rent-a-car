<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Verifica el correo y redirige según el rol.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if (!$request->user()->hasVerifiedEmail()) {
            if ($request->user()->markEmailAsVerified()) {
                event(new Verified($request->user()));
            }
        }

        return redirect($this->redirectTo($request->user()));
    }

    /**
     * Devuelve la URL a redirigir según el rol del usuario.
     */
    protected function redirectTo($user): string
    {
        return match ($user->role->nombre ?? null) {
            'admin' => '/admin/usuarios',
            'oficina' => '/oficina',
            'lavadero' => '/lavadero',
            'mecanico' => '/mecanico',
            default => '/sinrol',
        };
    }
}
