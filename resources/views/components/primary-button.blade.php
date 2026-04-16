<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn--solid']) }}>
    {{ $slot }}
</button>
