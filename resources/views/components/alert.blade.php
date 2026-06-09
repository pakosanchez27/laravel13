@props(['type' => 'success', 'message' => ''])

@php

$colors = [
    'success' => 'bg-green-100 border-green-400 text-green-700',
    'error' => 'bg-red-100 border-red-400 text-red-700',
    'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-700',
    'info' => 'bg-blue-100 border-blue-400 text-blue-700',
];

    $class = $colors[$type] ?? $colors['success'];

@endphp


@if ($message)
    <div class="my-10 text-center border-l-8 py-3 text-sm font-bold uppercase {{ $class }}" role="alert">
        <span class="block sm:inline">{{ $message }}</span>
    </div>
@endif
