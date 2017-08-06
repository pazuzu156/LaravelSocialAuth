<?php

namespace App\Http\Controllers\Auth\Social;

use Illuminate\Http\Request;

class GithubController extends BaseController
{
    public function __invoke(Request $request)
    {
        try {
            $user = \Socialite::with('github')->user();
        } catch (\Exception $ex) {
            return redirect('/')->with('emsg', 'There was an error trying to authorize with Github');
        }
        
        if (\Auth::check()) {
            if ($sa = $this->isRegistered(\Auth::user()->id)) {
                $sa->ghid = $user->id;
                $sa->ghtoken = $user->token;

                if ($sa->save()) {
                    return redirect('/')->with('smsg', 'Github successfully authorized!');
                }
            } else {
                $sa = SocialAccount::create([
                    'account_id' => \Auth::user()->id,
                    'fbid' => '',
                    'fbtoken' => '',
                    'gid' => '',
                    'gtoken' => '',
                    'did' => '',
                    'dtoken' => '',
                    'ghid' => $user->id,
                    'ghtoken' => $user->token,
                ]);

                if ($sa) {
                    return redirect('/')->with('smsg', 'Github successfully authorized!');
                }
            }
        } else {
            if ($sa = $this->isAuthorized('github', $user)) {
                $acc = $sa->account();

                \Auth::login($acc);

                if (\Auth::check()) {
                    return redirect('/')->with('smsg', 'You have logged in with Github!');
                }

                return redirect()->route('login')->with('emsg', 'Error logging you in with Github');
            } else {
                return redirect()->route('login')->with('emsg', 'This Github account is not connected to an account here');
            }
        }

        return redirect('/')->with('emsg', 'Error saving Github into into database');
    }
}
