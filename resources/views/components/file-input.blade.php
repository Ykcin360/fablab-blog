@props(['disabled' => false])

<input type="file" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border border-gray-300 hover:bg-gray-200 focus:outline-sky-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-sky-500 dark:focus:border-sky-600 dark:hover:bg-sky-600 rounded-md shadow-sm file:hidden']) !!} >
