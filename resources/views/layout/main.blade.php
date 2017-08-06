<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>{{ config('app.name') }}</title>
        {!! Html::style('css/app.css') !!}
        {!! Html::script('js/app.js') !!}
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle collapses" type="button" data-toggle="collapse" data-target="#navbar-header-collapse-1">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="{{ url('/') }}" class="navbar-brand">{{ config('app.name') }}</a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-header-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" target="_blank"><i class="fo-github"></i> Github</a></li>
                        @auth
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{!! Gravatar::avatar()->img(Auth::user()->email, 'Gravatar', ['width' => 24]) !!} {{ Auth::user()->email }} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            @if(Session::has('smsg'))
            <div class="alert alert-success alert-dismissable" role="alert">
                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {!! Session::get('smsg') !!}
            </div>
            @elseif(Session::has('emsg'))
            <div class="alert alert-danger alert-dismissable" role="alert">
                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {!! Session::get('emsg') !!}
            </div>
            @endif
            @yield('content')
        </div>
        <div class="footer navbar-default">
            <div class="container">
                <div class="footer_text">
                    Site &copy; 2017 <a href="https://kalebklein.com" target="_blank">Kaleb Klein</a>
                    |
                    <a href="https://validator.w3.org/check?uri=referer" target="_blank">Valid HTML5</a>
                </div>
            </div>
        </div>
    </body>
</html>
