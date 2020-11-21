@component('mail::message')
<h1>Transaction Status :</h1>

<h2>Purchase Successful</h2>
<p class="align-center">Thank you for using our website. For more details check your dashboard</p>
@component('mail::button', ['url' => ''])
Visit My Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
