<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-lime font-semibold rounded-md text-white hover:bg-lime-darker']) }}>
    {{ $slot }}
</button>
