<?php

namespace App\Http\Controllers\Auth\Social;

use App\SocialAccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected function isRegistered($account_id)
    {
        $sa = SocialAccount::where('account_id', '=', $account_id);

        return ($sa->count() > 0) ? $sa->first() : false;
    }

    protected function isAuthorized($service, $user)
    {
        switch (strtolower($service)) {
            case 'facebook':
                $id = 'fbid';
                break;
            case 'google':
                $id = 'gid';
                break;
            case 'discord':
                $id = 'did';
                break;
            case 'github':
                $id = 'ghid';
                break;
        }

        $sa = SocialAccount::where($id, '=', $user->id);

        return ($sa->count() > 0) ? $sa->first() : false;
    }
}
