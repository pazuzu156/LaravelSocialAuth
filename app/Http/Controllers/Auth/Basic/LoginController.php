<?php

namespace App\Http\Controllers\Auth\Basic;

use App\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $acc = Account::where('email', '=', $request->email);
        
        if (\Hash::check($request->password, $acc->first()->password)) {
            if (empty($acc->first()->confirmation_token)) {
                \Auth::login($acc->first());

                if (\Auth::check()) {
                    return redirect('/')->with('smsg', 'You have logged in!');
                } else {
                    return redirect()->route('login')->with('emsg', 'Error logging you in. Please try again later');
                }
            } else {
                return redirect()->route('login')->with('emsg', 'You must confirm your account. Please read the email you should have received.');
            }
        } else {
            return redirect()->route('login')->withInput()->withErrors(['password' => 'Invalid Password'])->with('emsg', 'Invalid form submission!');
        }
    }
}
