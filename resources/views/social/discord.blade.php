<table>
    <tr>
        @if(empty($social->did))
        <td style="width: 200px;">
            <a href="{{ route('discord') }}" class="btn-base btn-block btn-social btn-discord" style="text-decoration: none;">
                <i class="fo-discord"></i>
                Connect with Discord
            </a>
        </td>
        @else
        @php
        $user = Socialite::with('discord')->userFromToken($social->dtoken);
        @endphp
        <td style="width: 200px;">
            <a href="{{ url('/deauth/discord') }}" class="btn-base btn-block btn-social btn-discord" style="text-decoration: none;">
                <i class="fo-discord"></i>
                Deauthorize Discord
            </a>
        </td>
        <td style="padding-left: 10px;">
            Connected with: {{ Html::email($user->email) }}
        </td>
        @endif
    </tr>
</table>
