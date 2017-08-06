@component('mail::layout')
@slot('header')
    @component('mail::header', ['url' => url('/')])
        My Auth Website
    @endcomponent
@endslot

# Account Registration

Thanks for registering to my website. In order to gain access, click the confirmation link below, or copy/paste it into your browser.

<a href="{{ $confirmation_link }}">{{ $confirmation_link }}</a>

@slot('footer')
    @component('mail::footer')
        &copy; 2017 Kaleb Klein
    @endcomponent
@endslot
@endcomponent
