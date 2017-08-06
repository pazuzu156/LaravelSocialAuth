<?php

namespace App\Http\Controllers\Auth\Basic;

use App\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!isset($request->email)) {
            return redirect()->route('login')->with('emsg', '<strong>Invalid Confirmation Link</strong><br><br>An email was not provided in the confirmation link');
        }

        if (!isset($request->token)) {
            return redirect()->route('login')->with('emsg', '<strong>Invalid Confirmation Link</strong><br><br>Confirmation token is missing');
        }

        $acc = Account::where('email', '=', $request->email);

        if ($acc->count()) {
            $acc = $acc->first();

            if ($acc->confirmation_token == $request->token) {
                $acc->confirmation_token = '';
                $acc->save();

                return redirect()->route('login')->with('smsg', 'Account confirmed! You may now login');
            }
        }

        return redirect()->route('login')->with('emsg', 'Invalid confirmation link!');
    }
}
