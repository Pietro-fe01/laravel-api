<x-mail::message>
<h1>Email sent by {{ $contact['name'] }},</h1>

<div>{{ $contact['email'] }}</div>

<h6>Content:</h6>
<p>{{ $contact['message'] }}</p>
</x-mail::message>