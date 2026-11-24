@props(['stock' => 0])
@php
    if ($stock <= 0) {
        $label = 'Habis';
        $classes = 'bg-red-100 text-red-700';
    } elseif ($stock < 10) {
        $label = 'Menipis';
        $classes = 'bg-yellow-100 text-yellow-700';
    } else {
        $label = 'Aman';
        $classes = 'bg-green-100 text-green-700';
    }
@endphp
<span {{ $attributes->merge(['class' => "inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium $classes"]) }}>
    {{ $label }}
</span>

