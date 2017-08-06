<table>
    <tr>
        @if(empty($social->fbid))
        <td style="width: 200px;">
            <a href="{{ route('facebook') }}" class="btn-base btn-block btn-social btn-facebook" style="text-decoration: none;">
                <i class="fo-facebook"></i>
                Connect with Facebook
            </a>
        </td>
        @else
        @php
        $user = Socialite::with('facebook')->userFromToken($social->fbtoken);
        @endphp
        <td style="width: 200px;">
            <a href="{{ url('/deauth/facebook') }}" class="btn-base btn-block btn-social btn-facebook" style="text-decoration: none;">
                <i class="fo-facebook"></i>
                Deauthorize Facebook
            </a>
        </td>
        <td style="padding-left: 10px;">
            Connected with: {{ Html::email($user->email) }}
        </td>
        @endif
    </tr>
</table>
