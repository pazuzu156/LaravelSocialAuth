<?php

namespace App\Http\Controllers\Auth\Social;

use App\SocialAccount;
use Illuminate\Http\Request;

class GoogleController extends BaseController
{
    public function __invoke(Request $request)
    {
        try {
            $user = \Socialite::with('google')->user();
        } catch (\Exception $ex) {
            return redirect('/')->with('emsg', 'There was an error trying to authorize with Google');
        }
        
        if (\Auth::check()) {
            if ($sa = $this->isRegistered(\Auth::user()->id)) {
                $sa->gid = $user->id;
                $sa->gtoken = $user->token;

                if ($sa->save()) {
                    return redirect('/')->with('smsg', 'Google successfully authorized!');
                }
            } else {
                $sa = SocialAccount::create([
                    'account_id' => \Auth::user()->id,
                    'fbid' => '',
                    'fbtoken' => '',
                    'gid' => $user->id,
                    'gtoken' => $user->token,
                    'did' => '',
                    'dtoken' => '',
                    'ghid' => '',
                    'ghtoken' => '',
                ]);

                if ($sa) {
                    return redirect('/')->with('smsg', 'Google successfully authorized!');
                }
            }
        } else {
            if ($sa = $this->isAuthorized('google', $user)) {
                $acc = $sa->account();

                \Auth::login($acc);

                if (\Auth::check()) {
                    return redirect('/')->with('smsg', 'You have logged in with Google!');
                }

                return redirect()->route('login')->with('emsg', 'Error logging you in with Google');
            } else {
                return redirect()->route('login')->with('emsg', 'This Google account is not connected to an account here');
            }
        }

        return redirect('/')->with('emsg', 'Error saving Google into into database');
    }
}
