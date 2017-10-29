<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SigninController extends Controller
{
    public function signin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ], $request->has('remember'))) {
            return redirect()->route('dashboard');
        }

        return redirect()
            ->back()
            ->with('error', 'Invalid login details');
    }
}