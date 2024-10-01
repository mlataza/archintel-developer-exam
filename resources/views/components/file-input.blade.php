@props(['disabled' => false, 'hint' => 'JPG, PNG, or BMP (MAX. 1MB)'])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg shadow-sm focus:outline-none']) !!}>
<p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">{{ $hint }}</p>