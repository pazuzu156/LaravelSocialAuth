<?php

namespace App\Http\Controllers\Auth\Social;

use App\SocialAccount;
use Illuminate\Http\Request;

class DiscordController extends BaseController
{
    public function __invoke(Request $request)
    {
        try {
            $user = \Socialite::with('discord')->user();
        } catch (\Exception $ex) {
            if (isset($request->error)) {
                return redirect('/')->with('emsg', 'An error occurred while authorizing Discord: '.$request->error);
            }

            return redirect('/')->with('emsg', 'There was an error trying to authorize with Discord');
        }

        if (\Auth::check()) {
            if ($sa = $this->isRegistered(\Auth::user()->id)) {
                $sa->did = $user->id;
                $sa->dtoken = $user->token;

                if ($sa->save()) {
                    return redirect('/')->with('smsg', 'Discord successfully authorized!');
                }
            } else {
                $sa = SocialAccount::create([
                    'account_id' => \Auth::user()->id,
                    'fbid' => '',
                    'fbtoken' => '',
                    'gid' => '',
                    'gtoken' => '',
                    'did' => $user->id,
                    'dtoken' => $user->token,
                    'ghid' => '',
                    'ghtoken' => ',,'
                ]);

                if ($sa) {
                    return redirect('/')->with('smsg', 'Discord successfully authorized!');
                }
            }
        } else {
            if ($sa = $this->isAuthorized('discord', $user)) {
                $acc = $sa->account();

                \Auth::login($acc);

                if (\Auth::check()) {
                    return redirect('/')->with('smsg', 'You have logged in with Discord!');
                }

                return redirect()->route('login')->with('emsg', 'Error logging you in with Discord');
            } else {
                return redirect()->route('login')->with('emsg', 'This Discord account is not connected to an account here');
            }
        }

        return redirect('/')->with('emsg', 'Error saving Discord into into database');
    }
}
