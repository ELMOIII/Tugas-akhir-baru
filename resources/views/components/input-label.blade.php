@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm', 'style' => 'color:#526075;font-weight:800;']) }}>
    {{ $value ?? $slot }}
</label>
