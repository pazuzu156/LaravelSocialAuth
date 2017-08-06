<table>
    <tr>
        @if(empty($social->gid))
        <td style="width: 200px;">
            <a href="{{ route('google') }}" class="btn-base btn-block btn-social btn-google" style="text-decoration: none;">
                <i class="fo-google"></i>
                Connect with Google
            </a>
        </td>
        @else
        @php
        $user = Socialite::with('google')->userFromToken($social->gtoken);
        @endphp
        <td style="width: 200px;">
            <a href="{{ url('/deauth/google') }}" class="btn-base btn-block btn-social btn-google" style="text-decoration: none;">
                <i class="fo-google"></i>
                Deauthorize Google
            </a>
        </td>
        <td style="padding-left: 10px;">
            Connected with: {{ Html::email($user->email) }}
        </td>
        @endif
    </tr>
</table>
