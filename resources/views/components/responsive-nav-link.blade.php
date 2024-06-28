@props(['active'])

@php
$classes = ($active ?? false)
            ? 'hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group'
            : 'hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
