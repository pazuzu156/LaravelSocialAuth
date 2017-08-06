<?php

namespace App\Http\Controllers\Auth\Social;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class DeauthController extends Controller
{
    public function facebook()
    {
        $sa = $this->social();
        $sa->fbid = '';
        $sa->fbtoken = '';

        return $this->go($sa, 'Facebook');
    }

    public function google()
    {
        $sa = $this->social();
        $sa->gid = '';
        $sa->gtoken = '';

        return $this->go($sa, 'Google');
    }

    public function discord()
    {
        $sa = $this->social();
        $sa->did = '';
        $sa->dtoken = '';

        return $this->go($sa, 'Discord');
    }

    public function github()
    {
        $sa = $this->social();
        $sa->ghid = '';
        $sa->ghtoken = '';

        return $this->go($sa, 'Github');
    }

    private function social()
    {
        return Auth::user()->social();
    }

    private function go($account, $service)
    {
        if ($account->save()) {
            return redirect('/')->with('smsg', $service.' successfully deauthorized');
        }

        return redirect('/')->with('smsg', 'Error deauthorizing '.$service);
    }
}
