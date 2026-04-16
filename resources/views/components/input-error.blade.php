@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'auth_error']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
