<?php

namespace App\Http\Controllers\Auth\Basic;

use App\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\ConfirmationMail;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $new = Account::create([
            'email'              => $request->email,
            'password'           => \Hash::make($request->password),
            'confirmation_token' => str_random(24),
        ]);

        if ($new) {
            \Mail::to($request->email)->send(new ConfirmationMail($new->confirmation_token, $new->email));

            return redirect('/auth/login')->with('smsg', 'Registration success. Please check your email to gain access to your account');
        }

        return redirect('/auth/register')->with('emsg', 'There was an error registering you. Please try again');
    }
}
