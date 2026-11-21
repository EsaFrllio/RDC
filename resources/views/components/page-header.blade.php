@props([
    'icon'      => 'star',
    'badge'     => '',
    'title'     => '',
    'highlight' => '',
    'subtitle'  => '',
])

<section class="page-header-gradient relative text-white border-b border-white/10 overflow-hidden py-12 sm:py-16">
    {{-- Decorative Background Pattern & Glow --}}
    <div class="absolute inset-0 bg-[radial-gradient(#ffffff0a_1px,transparent_1px)] bg-size-[24px_24px] pointer-events-none"></div>
    <div class="absolute -top-12 -right-12 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 sm:px-10 relative z-10" data-aos="fade-up" data-aos-duration="750">
        <div class="space-y-4 max-w-3xl">

            {{-- Badge --}}
            @if($badge)
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-400/15 backdrop-blur-md border border-amber-400/30 text-amber-300 text-[11px] font-bold tracking-widest uppercase">
                <i data-lucide="{{ $icon }}" class="w-3.5 h-3.5 text-amber-400"></i>
                <span>{!! $badge !!}</span>
            </div>
            @endif

            {{-- Title in Cormorant Garamond Serif --}}
            <h1 class="font-serif-nordic font-bold text-3xl sm:text-5xl lg:text-6xl text-white tracking-tight leading-tight">
                {!! $title !!}@if($highlight) <span class="italic font-normal bg-linear-to-r from-amber-200 via-amber-400 to-yellow-500 bg-clip-text text-transparent">{!! $highlight !!}</span>@endif
            </h1>

            {{-- Subtitle --}}
            @if($subtitle)
            <p class="font-sans text-sm sm:text-base text-slate-300 leading-relaxed font-normal">
                {!! $subtitle !!}
            </p>
            @endif

            {{-- Extra slot content (chips, CTAs, filters) --}}
            @if($slot->isNotEmpty())
            <div class="pt-2">
                {{ $slot }}
            </div>
            @endif

        </div>
    </div>
</section>
