<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse;

class CustomLoginResponse implements LoginResponse
{
    public function toResponse($request)
    {
        $user = Auth::user();

        return redirect()->intended(match ($user->role) {
            'client' => route('client.services.index'),
            'employee' => route('employee.services.index'),
            'admin' => route('dashboard'),
            default => route('homepage'),
        });
    }
}
