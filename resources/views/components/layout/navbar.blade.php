<div x-data="{ 
         mobileMenuOpen: false,
         init() {
             this.$watch('mobileMenuOpen', value => {
                 if (value) {
                     document.body.classList.add('overflow-hidden');
                 } else {
                     document.body.classList.remove('overflow-hidden');
                 }
             });
         }
     }">

    <!-- Fixed Top Navbar (Pinned to top on scroll across all devices) -->
    <nav id="navbar"
         class="fixed top-0 left-0 right-0 w-full z-50 bg-[#090D16]/95 backdrop-blur-md text-white py-3 sm:py-3.5 px-4 sm:px-6 lg:px-8 border-b border-white/10 shadow-lg transition-all duration-300 font-sans">

        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">

            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 transition-transform duration-200 hover:scale-105 shrink-0" aria-label="RDC BEAR Beranda">
                <x-logo :height="34" textSize="text-sm sm:text-base lg:text-lg tracking-wider" :dark="true" />
            </a>

            <!-- Desktop Nav Links (Nordic Haven All-Caps Style) -->
            <div class="hidden lg:flex items-center gap-3 xl:gap-6 2xl:gap-8 text-[11px] xl:text-[13px] font-bold tracking-wider text-slate-200">
                @php
                    $navLinks = [
                        ['url' => route('home'),        'active' => request()->routeIs('home'),        'label' => 'BERANDA'],
                        ['url' => route('menu'),        'active' => request()->routeIs('menu'),        'label' => 'MENU'],
                        ['url' => route('story'),       'active' => request()->routeIs('story'),       'label' => 'CERITA KAMI'],
                        ['url' => route('reservation'), 'active' => request()->routeIs('reservation'), 'label' => 'RESERVASI'],
                        ['url' => route('gallery'),     'active' => request()->routeIs('gallery'),     'label' => 'GALERI'],
                        ['url' => route('promos'),      'active' => request()->routeIs('promos'),      'label' => 'PROMO & ACARA'],
                        ['url' => route('reviews'),     'active' => request()->routeIs('reviews'),     'label' => 'ULASAN'],
                        ['url' => route('contact'),     'active' => request()->routeIs('contact'),     'label' => 'KONTAK KAMI'],
                    ];
                @endphp
                @foreach($navLinks as $link)
                    <a href="{{ $link['url'] }}"
                       class="nordic-nav-link py-1 whitespace-nowrap {{ $link['active'] ? 'active font-extrabold' : '' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            <!-- Mobile & Tablet Hamburger Toggle Button -->
            <div class="flex items-center gap-2.5 sm:gap-3 shrink-0 lg:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="relative w-10 h-10 rounded-xl flex items-center justify-center text-white hover:bg-white/10 focus:outline-none transition-colors"
                        :aria-expanded="mobileMenuOpen.toString()"
                        aria-label="Toggle navigasi menu">
                    <div class="w-5 h-4 relative flex flex-col justify-between pointer-events-none">
                        <span class="w-full h-0.5 bg-white rounded-full transition-all duration-300 transform origin-left"
                              :class="{ 'rotate-45 translate-x-0.5 -translate-y-0.5 bg-amber-400!': mobileMenuOpen }"></span>
                        <span class="w-full h-0.5 bg-white rounded-full transition-all duration-300"
                              :class="{ 'opacity-0 translate-x-2': mobileMenuOpen }"></span>
                        <span class="w-full h-0.5 bg-white rounded-full transition-all duration-300 transform origin-left"
                              :class="{ '-rotate-45 translate-x-0.5 translate-y-0.5 bg-amber-400!': mobileMenuOpen }"></span>
                    </div>
                </button>
            </div>

        </div>
    </nav>

    <!-- Backdrop Overlay for Mobile Drawer -->
    <div x-show="mobileMenuOpen" x-cloak
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileMenuOpen = false"
         class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 lg:hidden"
         aria-hidden="true">
    </div>

    <!-- Off-Canvas Mobile & Tablet Slide-Over Drawer -->
    <aside x-show="mobileMenuOpen" x-cloak
           x-transition:enter="transition ease-out duration-300 transform"
           x-transition:enter-start="translate-x-full"
           x-transition:enter-end="translate-x-0"
           x-transition:leave="transition ease-in duration-200 transform"
           x-transition:leave-start="translate-x-0"
           x-transition:leave-end="translate-x-full"
           @keydown.escape.window="mobileMenuOpen = false"
           class="fixed top-0 right-0 bottom-0 w-full max-w-xs sm:max-w-sm bg-[#090D16] border-l border-white/10 z-50 lg:hidden shadow-2xl flex flex-col overflow-hidden font-sans">
        
        <!-- Drawer Header -->
        <div class="flex items-center justify-between px-6 py-4.5 border-b border-white/10 bg-[#0C1220]">
            <a href="{{ route('home') }}" @click="mobileMenuOpen = false" class="flex items-center gap-2">
                <x-logo :height="30" textSize="text-sm sm:text-base tracking-wider" :dark="true" />
            </a>
            <button @click="mobileMenuOpen = false"
                    class="w-9 h-9 rounded-full bg-white/5 hover:bg-white/15 active:scale-95 text-slate-300 hover:text-white flex items-center justify-center transition-all"
                    aria-label="Tutup menu">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Drawer Nav Links (Scrollable) -->
        <div class="flex-1 overflow-y-auto px-5 py-5 space-y-6">
            <div class="space-y-1">
                <p class="text-[10px] font-extrabold tracking-widest text-slate-400 uppercase px-3 mb-2">
                    Menu Navigasi
                </p>
                @foreach($navLinks as $link)
                    <a href="{{ $link['url'] }}"
                       @click="mobileMenuOpen = false"
                       class="flex items-center justify-between px-3.5 py-3 rounded-xl text-xs sm:text-sm font-bold tracking-wider transition-all duration-150
                              {{ $link['active'] 
                                 ? 'bg-amber-400/15 text-amber-400 border border-amber-400/30' 
                                 : 'text-slate-200 hover:text-white hover:bg-white/5' }}">
                        <span class="flex items-center gap-3">
                            @if($link['active'])
                                <span class="w-2 h-2 rounded-full bg-amber-400 shadow-[0_0_8px_rgba(245,158,11,0.8)]"></span>
                            @else
                                <span class="w-2 h-2 rounded-full bg-white/20"></span>
                            @endif
                            <span>{{ $link['label'] }}</span>
                        </span>
                        <svg class="w-4 h-4 {{ $link['active'] ? 'text-amber-400' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @endforeach
            </div>

            <!-- Quick Reserve Action & Store Info -->
            <div class="pt-2 space-y-3">
                <a href="{{ route('reservation') }}"
                   @click="mobileMenuOpen = false"
                   class="w-full flex items-center justify-center gap-2 py-3.5 px-4 rounded-full bg-amber-400 hover:bg-amber-300 text-slate-950 font-bold text-xs uppercase tracking-wider shadow-lg hover:shadow-amber-400/20 active:scale-[0.98] transition-all">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>
                        <path d="m9 16 2 2 4-4"/>
                    </svg>
                    <span>RESERVASI MEJA SEKARANG</span>
                </a>

                <!-- Operational hours & location snippet -->
                <div class="p-4 rounded-2xl bg-white/3 border border-white/10 space-y-2.5 text-xs text-slate-300">
                    <div class="flex items-center gap-2 text-amber-400 font-bold text-[11px] uppercase tracking-wider">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        <span>Jam Operasional</span>
                    </div>
                    <p class="text-[11px] text-slate-400 leading-relaxed pl-5.5">
                        Sen &ndash; Jum: 07.00 &ndash; 18.00<br>
                        Sab &ndash; Min: 08.00 &ndash; 19.00
                    </p>
                    <div class="pt-2 border-t border-white/5 flex items-center gap-2 text-[11px] text-slate-400">
                        <svg class="w-3.5 h-3.5 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="truncate">Jl. Jenderal Ahmad Yani III No.30, Tulungagung</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Drawer Footer -->
        <div class="px-6 py-4 border-t border-white/10 bg-[#0C1220] flex items-center justify-between text-xs text-slate-400">
            <span class="font-serif-nordic italic text-sm text-slate-300">RDC BEAR Coffee</span>
            <div class="flex items-center gap-2.5">
                <a href="https://instagram.com" target="_blank" rel="noopener" class="w-8 h-8 rounded-full bg-white/5 hover:bg-amber-400 hover:text-slate-950 flex items-center justify-center transition-all text-slate-300" aria-label="Instagram">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                    </svg>
                </a>
                <a href="https://wa.me/628123456789" target="_blank" rel="noopener" class="w-8 h-8 rounded-full bg-white/5 hover:bg-amber-400 hover:text-slate-950 flex items-center justify-center transition-all text-slate-300" aria-label="WhatsApp">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                </a>
            </div>
        </div>
    </aside>

    <!-- Sticky Mobile Book Table Bar (Visible ONLY on mobile screens < 640px, fixed at viewport bottom, hidden when drawer is open) -->
    <div x-show="!mobileMenuOpen"
         class="fixed bottom-0 left-0 right-0 z-40 sm:hidden bg-[#090D16]/95 backdrop-blur-md border-t border-white/10 px-4 py-2.5 shadow-[0_-4px_20px_rgba(0,0,0,0.5)]">
        <a href="{{ route('reservation') }}"
           class="flex items-center justify-center gap-2 w-full py-2.5 rounded-full bg-amber-400 hover:bg-amber-300 active:scale-[0.98] text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-md"
           aria-label="Book a table at RDC BEAR">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                <line x1="16" x2="16" y1="2" y2="6"/>
                <line x1="8" x2="8" y1="2" y2="6"/>
                <line x1="3" x2="21" y1="10" y2="10"/>
                <path d="m9 16 2 2 4-4"/>
            </svg>
            <span>BOOK TABLE</span>
        </a>
    </div>

</div>
