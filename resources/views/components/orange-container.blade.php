@props([
    'size' => 'md', // sm, md, lg, xl, full
    'padding' => true,
    'shadow' => true,
    'rounded' => true,
])

@php
$sizeClasses = [
    'sm' => 'max-w-sm',
    'md' => 'max-w-md',
    'lg' => 'max-w-lg',
    'xl' => 'max-w-xl',
    '2xl' => 'max-w-2xl',
    'full' => 'w-full',
    'auto' => 'w-auto',
];

$classes = implode(' ', array_filter([
    'bg-orange-50 border-2 border-orange-500',
    $sizeClasses[$size] ?? $sizeClasses['md'],
    $padding ? 'p-4 sm:p-6' : '',
    $shadow ? 'shadow-lg shadow-orange-200/50' : '',
    $rounded ? 'rounded-lg' : '',
]));
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
