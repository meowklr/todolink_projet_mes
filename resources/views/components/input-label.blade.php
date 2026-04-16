@props(['value'])

<label {{ $attributes->merge(['class' => 'auth_label']) }}>
    {{ $value ?? $slot }}
</label>
