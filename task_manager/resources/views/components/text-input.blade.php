@props(['disabled' => false, 'task' => null])

@php
    $borderColor = $task && $errors->has($task) ? 'border-red-500' : 'border-gray-300';
@endphp

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ' . $borderColor]) !!}>
