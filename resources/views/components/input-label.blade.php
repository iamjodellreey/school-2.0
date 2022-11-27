@props(['label'])

<label {{ $attributes->merge(['class' => 'form-label']) }}>{{ $label }}</label>
