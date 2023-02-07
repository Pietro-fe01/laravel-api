<x-mail::message>
<h1>New review has been sent by {{ $review->user_name }} !</h1>

<p>
    <h4>Message: </h4>
    {{ $review->text_review }}
</p>

<small>Sent on: {{ $review->review_created  }}</small>
</x-mail::message>
