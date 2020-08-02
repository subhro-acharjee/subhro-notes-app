@component('mail::message')
Welcome {{$name}} to the Mynotes

Click Below to active your account
@component('mail::button', ['url' => url('/')."/"."verifymail/".$tokken])
Click Here
@endcomponent

<small>if button doesn't works then click on the link <a href="{{url('/')."/"."verifymail/".$tokken}}" target="_blank" rel="noopener noreferrer">{{url('/')."/"."verifymail/".$tokken}}</a></small>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
