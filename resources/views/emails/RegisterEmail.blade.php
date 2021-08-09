@component('mail::message')
# Introduction

Thank you for Registering to our App.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
