@component('mail::message')
# Reservation Completed<br>
<img src="https://i.ibb.co/cQt6g0B/blue.png" style="width:150px;"><br>
<hr>
Hi, This message is to inform that you have made a successful reservation.
<hr>

<p>Name : {{ $data["name"] }}</p>
<p>Check in : {{ $data["check_in"] }}</p>
<p>Check out : {{ $data["check_out"] }}</p>
<p>Total Tax: &#8377; {{ $data["total_tax"] }}</p>
<p>Total : &#8377; {{ $data["total"] }}</p>

<hr>
Thanks,<br>
{{ config('app.name') }}
@endcomponent