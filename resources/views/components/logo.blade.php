@props([
    'height'   => 38,
    'showText' => true,
    'dark'     => false,   // true = white/inverted (for dark backgrounds)
    'light'    => false,   // true = dark text (for light backgrounds like footer or login)
    'textSize' => 'text-base sm:text-lg',
    'vertical' => false,
])

@php
    // light=true  → dark background suppressed → original dark logo on white navbar
    // dark=true   → force white logo (brightness-0 invert) for dark footer/section
    // default     → white logo for transparent dark navbar
    $imgClass  = $light ? '' : 'brightness-0 invert';
    $textColor = $light ? 'text-slate-900' : 'text-white';
@endphp

<div class="flex {{ $vertical ? 'flex-col items-center md:items-start gap-2' : 'items-center gap-2.5 sm:gap-3' }} group select-none">
    <div class="flex items-center justify-center shrink-0" style="height: {{ $height }}px;">
        <img
            src="{{ asset('images/logo.png') }}"
            alt="RDC BEAR Logo"
            height="{{ $height }}"
            style="height: {{ $height }}px; max-height: {{ $height }}px; width: auto; object-fit: contain; display: block;"
            class="transition-transform duration-300 group-hover:scale-105 {{ $imgClass }}"
        >
    </div>

    @if($showText)
    <div class="flex flex-col justify-center">
        <span class="font-sans font-black {{ $textSize }} tracking-wider uppercase {{ $textColor }} leading-none">
            RDC BEAR
        </span>
    </div>
    @endif
</div>

