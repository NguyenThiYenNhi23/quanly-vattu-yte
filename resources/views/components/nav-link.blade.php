@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center rounded-t-lg border-b-2 border-cyan-500 px-3 pt-2 pb-2.5 text-[0.92rem] font-semibold leading-5 text-sky-700 shadow-sm shadow-cyan-100/80 bg-cyan-50/80 focus:outline-none focus:border-cyan-600 transition duration-200 ease-in-out'
            : 'inline-flex items-center rounded-t-lg border-b-2 border-transparent px-3 pt-2 pb-2.5 text-[0.92rem] font-semibold leading-5 text-slate-600 hover:text-sky-700 hover:bg-cyan-50/60 hover:border-cyan-200 focus:outline-none focus:text-sky-700 focus:border-cyan-300 transition duration-200 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
