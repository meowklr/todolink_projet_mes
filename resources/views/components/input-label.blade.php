@props(['value'])

{{-- label de champ de formulaire --}}
<label {{ $attributes->merge(['class' => 'auth_label']) }}>
    {{ $value ?? $slot }}
</label>
