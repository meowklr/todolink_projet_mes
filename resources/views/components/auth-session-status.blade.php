@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'auth_status']) }}>
        {{ $status }}
    </div>
@endif
