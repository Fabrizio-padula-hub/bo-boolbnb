@props(['active'])

@php
$classes = ($active ?? false)
            ? ''
            : '';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
