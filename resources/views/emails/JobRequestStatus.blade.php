<x-mail::message>
# job has been {{ $details['approval'] }}

Dear {{ $details['company_name'] }},<br>

@if($details['approval'] == 'approved')
The job you requested was approved.
@else
Sorry, the job you requested job was declined.
@endif
For futher details click below:<br>

<x-mail::button :url="{{ $details['url'] }}">
    Click Me
</x-mail::button>

Thank you for your co-operation.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
