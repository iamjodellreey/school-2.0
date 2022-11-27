@props(['route', 'verb' => 'post'])

<div {{ $attributes->merge(['class' => 'p-4']) }}>
    <form method="post" action="{{ $route }}">
        @csrf
        @method($verb)

        {{ $slot }}
    </form>
</div>
