@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2.5 border-l-4 border-cyan-500 text-start text-[0.96rem] font-semibold text-sky-700 bg-cyan-50 rounded-r-lg focus:outline-none focus:text-sky-800 focus:bg-cyan-100 focus:border-cyan-600 transition duration-200 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2.5 border-l-4 border-transparent text-start text-[0.96rem] font-semibold text-slate-600 hover:text-sky-700 hover:bg-sky-50 hover:border-cyan-200 focus:outline-none focus:text-sky-700 focus:bg-sky-50 focus:border-cyan-300 transition duration-200 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
