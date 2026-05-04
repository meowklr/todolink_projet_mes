@props(['status'])

{{-- affiche les messages de statut de session --}}
@if ($status)
    <div {{ $attributes->merge(['class' => 'auth_status']) }}>
        {{ $status }}
    </div>
@endif
