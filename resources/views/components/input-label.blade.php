@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm dark:text-white']) }}>
    {{ $value ?? $slot }}
</label>
