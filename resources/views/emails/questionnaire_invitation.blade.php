<x-mail::message>
# Questionnaire Invitation

You have been invited to answer the following questionnaire: **{{ $questionnaire->title}}**

<x-mail::button :url="$url">
Answer Questionnaire
</x-mail::button>

**NOTE:** This url is unique to you and should not be shared with others.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
