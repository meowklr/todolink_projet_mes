@props(['disabled' => false])

{{-- champ de saisie reutilisable --}}
<input @disabled($disabled) {{ $attributes->merge(['class' => 'auth_input']) }}>
