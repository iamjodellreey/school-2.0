@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'list-inline']) }}>
        @foreach ((array) $messages as $message)
            <li class="list-inline-item text-danger">{{ $message }}</li>
        @endforeach
    </ul>
@endif
