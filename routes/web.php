<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (\Auth::check()) {
        return view('home', [
            'user' => Auth::user(),
            'social' => Auth::user()->social(),
        ]);
    } else {
        return redirect('/auth/login');
    }
});

Route::get('/privacy', function () {
    return view('privacy');
});

Route::prefix('auth')->group(function ($route) {
    $route->middleware(['guest'])->group(function ($route) {
        $route->get('login', function () {
            return view('auth.login');
        })->name('login');

        $route->get('register', function () {
            return view('auth.register');
        });

        $route->get('confirmation', Auth\Basic\ConfirmationController::class);

        $route->post('login', Auth\Basic\LoginController::class);
        $route->post('register', Auth\Basic\RegistrationController::class);
    });

    $route->middleware(['auth'])->group(function ($route) {
        $route->get('logout', function () {
            Auth::logout();
            return redirect()->route('login')->with('smsg', 'You have logged out!');
        });
    });

    $route->get('facebook-redirect', function () {
        return Socialite::with('facebook')->redirect();
    })->name('facebook');
    $route->get('facebook-callback', Auth\Social\FacebookController::class);

    $route->get('google-redirect', function () {
        return Socialite::with('google')->redirect();
    })->name('google');
    $route->get('google-callback', Auth\Social\GoogleController::class);

    $route->get('discord-redirect', function () {
        return Socialite::with('discord')->scopes(['email'])->redirect();
    })->name('discord');
    $route->get('discord-callback', Auth\Social\DiscordController::class);

    $route->get('github-redirect', function () {
        return Socialite::with('github')->redirect();
    })->name('github');
    $route->get('github-callback', Auth\Social\GithubController::class);
});

Route::prefix('deauth')->group(function ($route) {
    $route->middleware(['auth'])->group(function ($route) {
        $route->get('facebook', 'Auth\Social\DeauthController@facebook');
        $route->get('google', 'Auth\Social\DeauthController@google');
        $route->get('discord', 'Auth\Social\DeauthController@discord');
        $route->get('github', 'Auth\Social\DeauthController@github');
    });
});
