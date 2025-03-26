<x-mail::message>
# Introduction
# Introduction

Attention votre balance est inférieure à 10 euros : {!! $wallet->balance !!} euros

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
