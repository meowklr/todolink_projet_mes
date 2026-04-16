@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'auth_input']) }}>
