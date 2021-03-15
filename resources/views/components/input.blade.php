<x-label name="{{ $label }}" attribute="{{ $attribute }}"/>

@if ($readonly)
    <input {{ $attributes }} type="text" name="{{ $attribute }}" id="{{ $attribute }}" value="{{ $value }}" class="bg-gray-200 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" tabindex="-1" readonly>
@else
    <input {{ $attributes }} type="text" name="{{ $attribute }}" id="{{ $attribute }}" value="{{ $value }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
@endif