
@component('mail::message')
    مرحبا  {{$name}}
    <br>
    <span style="float: right">كود تغير الرقم السرى بحسابك على تطبيقنا <strong> Everything </strong> هو<strong style="color: red"> {{$code}}</strong> </span>
    <br>
    <hr>

    شكراٌ

    {{config('app.name') }}
@endcomponent

