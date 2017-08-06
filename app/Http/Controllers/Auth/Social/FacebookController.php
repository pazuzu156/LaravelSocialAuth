<?php

namespace App\Http\Controllers\Auth\Social;

use App\SocialAccount;
use Illuminate\Http\Request;

class FacebookController extends BaseController
{
    public function __invoke(Request $request)
    {
        try {
            $user = \Socialite::with('facebook')->user();
        } catch (\Exception $ex) {
            if (isset($request->error) &&
                $request->error_reason == 'user_denied') {
                return redirect('/')->with('emsg', 'An error occurred while authorizing Facebook: '.$request->error_reason);
            }

            return redirect('/')->with('emsg', 'There was an error trying to authorize with Facebook');
        }

        if (\Auth::check()) {
            if ($sa = $this->isRegistered(\Auth::user()->id)) {
                $sa->fbid = $user->id;
                $sa->fbtoken = $user->token;

                if ($sa->save()) {
                    return redirect('/')->with('smsg', 'Facebook successfully authorized!');
                }
            } else {
                $sa = SocialAccount::create([
                    'account_id' => \Auth::user()->id,
                    'fbid' => $user->id,
                    'fbtoken' => $user->token,
                    'gid' => '',
                    'gtoken' => '',
                    'did' => '',
                    'dtoken' => '',
                    'ghid' => '',
                    'ghtoken' => '',
                ]);

                if ($sa) {
                    return redirect('/')->with('smsg', 'Facebook successfully authorized!');
                }
            }
        } else {
            if ($sa = $this->isAuthorized('facebook', $user)) {
                $acc = $sa->account();

                \Auth::login($acc);

                if (\Auth::check()) {
                    return redirect('/')->with('smsg', 'You have logged in with Facebook!');
                }

                return redirect()->route('login')->with('emsg', 'Error logging you in with Facebook');
            } else {
                return redirect()->route('login')->with('emsg', 'This Facebook account is not connected to an account here');
            }
        }

        return redirect('/')->with('emsg', 'Error saving Facebook into into database');
    }
}
