<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login.index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        if (Auth::attempt($credentials)) {
            return redirect()->intended('task');
        }

        return redirect()->back()->withErrors(['login_failed' => 'Please check your credentials.']);
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
