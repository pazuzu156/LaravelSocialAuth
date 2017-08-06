<table>
    <tr>
        @if(empty($social->ghid))
        <td style="width: 200px;">
            <a href="{{ route('github') }}" class="btn-base btn-block btn-social btn-github" style="text-decoration: none;">
                <i class="fo-github"></i>
                Connect with Github
            </a>
        </td>
        @else
        @php
        $user = Socialite::with('github')->userFromToken($social->ghtoken);
        @endphp
        <td style="width: 200px;">
            <a href="{{ url('/deauth/github') }}" class="btn-base btn-block btn-social btn-github" style="text-decoration: none;">
                <i class="fo-github"></i>
                Deauthorize Github
            </a>
        </td>
        <td style="padding-left: 10px;">
            Connected with: {{ Html::email($user->email) }}
        </td>
        @endif
    </tr>
</table>
