{{-- bouton d'action principal --}}
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn--solid']) }}>
    {{ $slot }}
</button>
