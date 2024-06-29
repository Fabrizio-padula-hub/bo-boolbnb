@props(['active'])

@php
$classes = ($active ?? false)
            ? 'transition duration-150 ease-linear rounded-lg py-3 px-2 group'
            : 'transition duration-150 ease-linear rounded-lg py-3 px-2 group';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
