@props(['contact' => null])

@php
    $address = $contact->address          ?? 'Jl. Jenderal Ahmad Yani III No.30, Bago, Tamanan, Tulungagung';
    $email   = $contact->email            ?? 'hello@rdcbear.com';
    $phone   = $contact->phone            ?? null;
    $waLink  = $contact->whatsapp_link    ?? null;
    $igLink  = $contact->instagram_link   ?? null;
    $ttLink  = $contact->tiktok_link      ?? null;
@endphp

<footer class="footer-gradient text-white relative overflow-hidden pt-12 sm:pt-16 pb-24 sm:pb-12 font-sans border-t border-white/10">

    {{-- ── Main 3-column Layout Container ── --}}
    <div class="relative max-w-7xl mx-auto px-6 sm:px-10 mb-8 sm:mb-12">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start text-center md:text-left">
            
            {{-- Col 1: Logo & Brand Name (4 cols) --}}
            <div class="md:col-span-4 flex flex-col items-center md:items-start space-y-3">
                <a href="{{ route('home') }}" class="group inline-block">
                    <x-logo :height="48" :dark="true" :vertical="true" textSize="text-2xl sm:text-3xl" />
                </a>
                <p class="text-slate-400 leading-relaxed max-w-xs font-serif-nordic text-base italic">
                    &ldquo;Cultivating warmth in every cup, every single day.&rdquo;
                </p>
            </div>

            {{-- Col 2: Location (4 cols) --}}
            <div class="md:col-span-4 flex flex-col items-center justify-center text-center space-y-2.5">
                <h4 class="font-bold text-xs uppercase tracking-widest text-amber-400">LOKASI KAMI</h4>
                @if($address)
                <div class="flex items-start justify-center gap-2 text-xs text-slate-300 leading-relaxed max-w-xs">
                    <i data-lucide="map-pin" class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                    <span>{{ $address }}</span>
                </div>
                @endif
                @if(!empty($contact->business_hours))
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-[11px] text-slate-300 mt-1">
                    <i data-lucide="clock" class="w-3.5 h-3.5 text-amber-400"></i>
                    <span>{{ $contact->business_hours }}</span>
                </div>
                @endif
            </div>

            {{-- Col 3: Contact & Socials (4 cols) --}}
            <div class="md:col-span-4 flex flex-col items-center md:items-end justify-center text-center md:text-right space-y-3">
                <h4 class="font-bold text-xs uppercase tracking-widest text-amber-400">HUBUNGI KAMI</h4>
                
                {{-- Social Icons --}}
                <div class="flex items-center gap-2.5">
                    @if($waLink)
                    <a href="{{ $waLink }}" target="_blank" rel="noopener" aria-label="WhatsApp"
                       class="w-9 h-9 rounded-full bg-white/5 hover:bg-amber-400 text-slate-300 hover:text-slate-950 border border-white/10 flex items-center justify-center transition-all duration-200 hover:scale-110 shadow-sm">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                    </a>
                    @endif

                    @if($igLink)
                    <a href="{{ $igLink }}" target="_blank" rel="noopener" aria-label="Instagram"
                       class="w-9 h-9 rounded-full bg-white/5 hover:bg-amber-400 text-slate-300 hover:text-slate-950 border border-white/10 flex items-center justify-center transition-all duration-200 hover:scale-110 shadow-sm">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                        </svg>
                    </a>
                    @endif

                    @if($ttLink)
                    <a href="{{ $ttLink }}" target="_blank" rel="noopener" aria-label="TikTok"
                       class="w-9 h-9 rounded-full bg-white/5 hover:bg-amber-400 text-slate-300 hover:text-slate-950 border border-white/10 flex items-center justify-center transition-all duration-200 hover:scale-110 shadow-sm">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.28 6.28 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.95a8.2 8.2 0 004.79 1.53V7.05a4.85 4.85 0 01-1.02-.36z"/>
                        </svg>
                    </a>
                    @endif

                    @if($email)
                    <a href="mailto:{{ $email }}" aria-label="Email"
                       class="w-9 h-9 rounded-full bg-white/5 hover:bg-amber-400 text-slate-300 hover:text-slate-950 border border-white/10 flex items-center justify-center transition-all duration-200 hover:scale-110 shadow-sm">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </a>
                    @endif
                </div>

                <div class="text-xs text-slate-400 space-y-0.5">
                    @if($phone)<p>{{ $phone }}</p>@endif
                    @if($email)<p>{{ $email }}</p>@endif
                </div>
            </div>

        </div>
    </div>

    {{-- ── Full-width horizontal divider line ── --}}
    <div class="max-w-7xl mx-auto px-6 mb-4 sm:mb-6">
        <div class="border-t border-white/10"></div>
    </div>

    {{-- ── Copyright Section ── --}}
    <div class="relative max-w-7xl mx-auto px-6 text-center text-xs text-slate-400 font-normal space-y-1 pb-2 sm:pb-4">
        <p>&copy; {{ date('Y') }} RDC BEAR Specialty Coffee. All rights reserved.</p>
        <p class="text-[10px] text-slate-500">
            Specialty Coffee Tulungagung
        </p>
    </div>

</footer>
