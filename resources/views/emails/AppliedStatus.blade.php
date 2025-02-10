<x-mail::message>
Dear {{ $details['applicant_name'] }},<br>

<p>
    {{ $details['message'] }}
</p>

Sincerly,<br>
{{ $details['company_name'] }}<br>
{{ $details['company_address'] }}<br>
{{ $details['company_contact'] }}<br>

</x-mail::message>
