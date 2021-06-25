<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
  public function index()
  {
    return view('login');
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required',
      'remember_me' => 'boolean',
    ]);

    if (!Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember_me ?? true)) {
      return redirect()
        ->back()
        ->withErrors([
          'email' => 'Email atau password tidak tepat. Mohon masukan email atau password dengan benar.'
        ])
        ->withInput(['email']);
    }

    return redirect(urldecode($request->redirect) ?? route('home'));
  }

  public function logout()
  {
    Auth::logout();
    return redirect()->route('login');
  }
}
