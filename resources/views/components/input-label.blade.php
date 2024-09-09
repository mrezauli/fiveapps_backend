@props(['value'])
@props(['exception'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
    <span class="text-red-500">{{ $exception ?? '' }}</span>
</label>
