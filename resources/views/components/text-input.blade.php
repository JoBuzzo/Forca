@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-700 background text-white focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm']) !!}>
