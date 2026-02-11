@props([
	'color' => null,
])

@php
	$colorClass = match ($color) {
		'success' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
		'info' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
		'danger' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
		'warning' => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200',
		'purple' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
		'neutral' => 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200',
		default => 'bg-neutral-200 dark:bg-neutral-800 text-black dark:text-white',
	};
@endphp

<div {{ $attributes->class("$colorClass px-2 py-px rounded w-max text-xs")->merge() }}>{{ $slot }}</div>