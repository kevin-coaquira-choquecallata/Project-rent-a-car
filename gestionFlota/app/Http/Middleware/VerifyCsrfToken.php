<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    // Aquí puedes excluir rutas si lo necesitas
    protected $except = [
        //
    ];
}
