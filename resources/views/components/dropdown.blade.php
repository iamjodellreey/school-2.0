@props(['label', 'selectName', 'selectId', 'name'])

<div {{ $attributes->merge(['class' => 'input-group input-group-static mb-4']) }}>
    <label for="{{ $label }}" class="ms-0">{{ $selectName }}</label>
    <select name="{{ $name }}" class="form-control" id="{{ $selectId }}">
        {{ $slot }}
    </select>
</div>
