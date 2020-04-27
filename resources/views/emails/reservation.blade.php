@component('mail::message')
# Reservation Completed<br>
<img src="https://i.ibb.co/cQt6g0B/blue.png" style="width:150px;"><br>
<hr>
Hi, This message is to inform that you have made a successful reservation.<br>
Name : {{ $data["name"] }}<br>
Check in : {{ $data["check_in"] }}<br>
Check out : {{ $data["check_out"] }}<br>
Total Tax: &#8377; {{ $data["total_tax"] }}<br>
Total : &#8377; {{ $data["total"] }}<br>

<hr>
Thanks,<br>
{{ config('app.name') }}
@endcomponent