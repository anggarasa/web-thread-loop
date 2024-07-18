@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-black focus:border-abu-tua focus:ring-abu-tua rounded-md shadow-sm']) !!}>
