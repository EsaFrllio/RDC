@extends('layouts.app')

@section('title', 'RDC BEAR - Specialty Coffee')

@section('content')

{{-- ================================================================= --}}
{{-- 1. HERO BANNER WITH SLIDESHOW & OBSIDIAN GRADIENT (NORDIC LAYOUT) --}}
{{-- ================================================================= --}}
<section x-data="{
    activeSlide: 0,
    totalSlides: 5,
    timer: null,
    startTimer() {
        if (this.timer) clearInterval(this.timer);
        this.timer = setInterval(() => {
            this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
        }, 4000);
    },
    goTo(index) {
        this.activeSlide = index;
        this.startTimer();
    },
    init() {
        this.startTimer();
    }
}" class="relative min-h-115 sm:min-h-130 lg:min-h-140 flex items-center overflow-hidden text-white bg-[#090D16]">

    {{-- Background Slideshow --}}
    <div class="absolute inset-0 z-0">
        @php
            $heroImages = [
                'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=2000&q=90',
                'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=2000&q=90',
                'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=2000&q=90',
                'https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=2000&q=90',
                'https://images.unsplash.com/photo-1447933601403-0c6688de566e?auto=format&fit=crop&w=2000&q=90'
            ];
        @endphp
        @foreach($heroImages as $idx => $img)
            <div x-show="activeSlide === {{ $idx }}"
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 scale-105"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-700"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 w-full h-full">
                <img src="{{ $img }}" alt="RDC BEAR Coffee" class="w-full h-full object-cover">
            </div>
        @endforeach
    </div>

    {{-- Split Overlay: Solid Obsidian on Left, Smooth Transition to Photo on Right --}}
    <div class="absolute inset-0 z-10 bg-linear-to-r from-[#090D16] via-[#090D16]/90 sm:via-[#090D16]/75 sm:to-transparent pointer-events-none"></div>
    <div class="absolute inset-0 z-10 bg-linear-to-t from-[#090D16]/40 via-transparent to-transparent pointer-events-none"></div>

    {{-- Hero Content (Simple & Clean Editorial Typography) --}}
    <div class="relative z-20 max-w-7xl mx-auto px-6 sm:px-10 py-16 sm:py-24 w-full">
        <div class="max-w-xl space-y-4" data-aos="fade-up" data-aos-duration="900">
            <h1 class="font-serif-nordic font-bold text-4xl sm:text-6xl lg:text-7xl text-white tracking-wider leading-[1.08] uppercase">
                A TASTE <br>
                <span class="font-serif italic lowercase text-2xl sm:text-3xl lg:text-4xl font-normal text-amber-400 block my-0.5">of</span>
                WARMTH
            </h1>
            <p class="font-sans text-sm sm:text-base text-slate-200 font-medium tracking-wide pt-1"
               data-aos="fade-up" data-aos-delay="150" data-aos-duration="900">
                "Taste the warmth of RDC BEAR"
            </p>
        </div>
    </div>

    {{-- Slideshow Dots (Centered Bottom - Nordic Style) --}}
    <div class="absolute bottom-6 sm:bottom-8 left-1/2 -translate-x-1/2 z-30 flex items-center justify-center gap-3"
         data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
        @for($i = 0; $i < 5; $i++)
            <button type="button"
                    @click="goTo({{ $i }})"
                    :class="{ 'is-active': activeSlide === {{ $i }} }"
                    class="hero-dot {{ $i === 0 ? 'is-active' : '' }}"
                    aria-label="Slide {{ $i + 1 }}"></button>
        @endfor
    </div>

    {{-- Operating Hours Card (Bottom Right Frosted Glass) --}}
    <div class="hidden sm:block absolute bottom-6 sm:bottom-8 right-6 sm:right-10 z-20"
         data-aos="fade-left" data-aos-delay="200" data-aos-duration="800">
        <div class="px-5 py-3 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white text-center shadow-lg">
            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-200">
                OPEN FROM
            </p>
            <p class="text-xs sm:text-sm font-semibold tracking-wider text-white mt-0.5">
                07:00 - 19:00 WIB
            </p>
        </div>
    </div>

</section>


{{-- ================================================================= --}}
{{-- 2. ABOUT US / STORY SECTION (NORDIC HAVEN 2-COL EDITORIAL)       --}}
{{-- ================================================================= --}}
@php
    $menuCount  = \App\Models\Menu::count();
    $rating     = $contactSettings->google_rating ?? '4.9';
    $customers  = $contactSettings->happy_customers_label ?? '1K+';
@endphp

<section class="about-wrapper bg-[#F8FAFC] py-16 sm:py-24 border-b border-slate-200/80 overflow-hidden" id="about">
    <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">

            {{-- Left Photo with RDC BEAR branded overlay --}}
            <div class="lg:col-span-5 relative" data-aos="fade-right" data-aos-duration="850">
                <div class="relative rounded-3xl sm:rounded-4xl overflow-hidden shadow-2xl shadow-slate-900/10 border border-slate-200/80 group aspect-4/5 bg-slate-950">
                    <img 
                        src="https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=1000&q=90" 
                        alt="RDC BEAR Specialty Coffee" 
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 block opacity-90"
                    >

                    <!-- Top Overlay: RDC BEAR Badge & Tag -->
                    <div class="absolute top-5 sm:top-6 left-5 sm:left-6 right-5 sm:right-6 flex items-center justify-between z-10">
                        <div class="flex items-center gap-2 bg-slate-950/75 backdrop-blur-md px-3 py-1.5 rounded-xl border border-white/15">
                            <img src="{{ asset('images/logo.png') }}" alt="RDC BEAR Logo" class="w-5 h-5 object-contain brightness-0 invert">
                            <span class="text-xs font-black text-white tracking-wider uppercase font-sans">RDC BEAR</span>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-amber-400 bg-slate-950/75 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/15">
                            EST. 2024
                        </span>
                    </div>

                    <!-- Center-Right Typographic Badge -->
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 text-right z-10 drop-shadow-md select-none">
                        <p class="font-sans font-black text-xl sm:text-2xl text-white tracking-widest uppercase leading-tight">
                            ENJOY<br>YOUR CUP.
                        </p>
                        <p class="text-[11px] font-bold tracking-widest text-amber-400 uppercase mt-1">
                            COFFEE MOMENT
                        </p>
                    </div>

                    <!-- Bottom Obsidian Gradient with Location & Tag -->
                    <div class="absolute inset-x-0 bottom-0 z-10 p-5 sm:p-6 pt-16 bg-linear-to-t from-[#090D16] via-[#090D16]/80 to-transparent">
                        <div class="flex items-end justify-between gap-4 text-white">
                            <p class="text-[11px] sm:text-xs text-slate-300 font-medium leading-relaxed max-w-[70%]">
                                {{ $contactSettings->address ?? '128 Minimalist Ave, Design District, City Center 10012' }}
                            </p>
                            <p class="text-[11px] sm:text-xs font-bold text-amber-400 shrink-0">
                                #rdcbear
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Content --}}
            <div class="lg:col-span-7 space-y-6 lg:pl-2" data-aos="fade-left" data-aos-duration="850">
                <div>
                    <span class="about-badge">
                        TENTANG KAMI
                    </span>
                </div>

                <h2 class="about-title">
                    Selamat Datang di<br>
                    <span class="about-brand">RDC BEAR</span>
                </h2>

                <div class="space-y-4 about-desc">
                    <p>
                        Sebuah ruang yang terinspirasi dari kehangatan dan kesederhanaan desain Scandinavian minimalis. Kami menghadirkan perpaduan antara kopi spesialti berkualitas, suasana tenang, dan interior minimalis yang membuat setiap kunjungan terasa nyaman dan menenangkan.
                    </p>
                    <p>
                        Dibangun dengan konsep <em>cozy &amp; clean aesthetic</em>, RDC BEAR dirancang sebagai tempat di mana siapa pun bisa berhenti sejenak dari kesibukan, menikmati waktu sendiri, bekerja dengan fokus, atau berkumpul bersama teman dan keluarga.
                    </p>
                </div>

                {{-- Stats Row --}}
                <div class="grid grid-cols-3 gap-6 sm:gap-10 pt-4 border-t border-slate-200/80">
                    <div class="stat-item" data-aos="zoom-in" data-aos-delay="150">
                        <div class="stat-number">
                            {{ $menuCount > 0 ? $menuCount . '+' : '50+' }}
                        </div>
                        <div class="stat-label">
                            Menu Pilihan
                        </div>
                    </div>

                    <div class="stat-item" data-aos="zoom-in" data-aos-delay="300">
                        <div class="stat-number">
                            {{ $rating ?: '4.9' }}
                        </div>
                        <div class="stat-label">
                            Rating Google
                        </div>
                    </div>

                    <div class="stat-item" data-aos="zoom-in" data-aos-delay="450">
                        <div class="stat-number">
                            {{ $customers ?: '1K+' }}
                        </div>
                        <div class="stat-label">
                            Happy Customers
                        </div>
                    </div>
                </div>

                <div class="pt-2" data-aos="fade-up" data-aos-delay="500">
                    <a href="{{ route('story') }}" class="inline-flex items-center gap-2 font-bold text-xs uppercase tracking-wider text-amber-600 hover:text-amber-700 transition-colors group">
                        <span>BACA CERITA SELENGKAPNYA</span>
                        <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>



{{-- ================================================================= --}}
{{-- 3. SIGNATURE SELECTIONS (MENU PREVIEW)                            --}}
{{-- ================================================================= --}}
<section class="py-16 sm:py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 sm:px-10 space-y-12">

        <div class="text-center max-w-xl mx-auto space-y-2" data-aos="fade-up" data-aos-duration="750">
            <span class="text-xs font-extrabold tracking-widest text-amber-600 uppercase">PILIHAN MENU</span>
            <h2 class="font-serif-nordic font-bold text-3xl sm:text-5xl text-slate-900">
                Pilihan Favorit Pengunjung
            </h2>
            <p class="font-script text-xl text-slate-600">
                Pilihan menu favorit yang paling dicintai pengunjung
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8">
            @if(isset($featuredMenus) && $featuredMenus->isNotEmpty())
                @foreach($featuredMenus->take(3) as $idx => $item)
                    <div class="nordic-card p-5 space-y-4 group"
                         data-aos="fade-up"
                         data-aos-delay="{{ ($loop->iteration) * 120 }}"
                         data-aos-duration="750">
                        <div class="rounded-2xl overflow-hidden h-50 sm:h-55 bg-slate-100">
                            <img src="{{ $item->image_url }}"
                                 alt="{{ $item->name }}"
                                 class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700">
                        </div>
                        <div class="space-y-1.5">
                            <div class="flex items-baseline justify-between gap-2">
                                <h3 class="font-serif-nordic font-bold text-xl text-slate-900 group-hover:text-amber-600 transition-colors">
                                    {{ $item->name }}
                                </h3>
                                <span class="font-sans font-extrabold text-sm text-amber-600 shrink-0">
                                    {{ $item->formatted_price }}
                                </span>
                            </div>
                            <p class="text-xs text-slate-500 leading-relaxed line-clamp-2">
                                {{ $item->description }}
                            </p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-3 text-center py-12 text-slate-400 text-sm">
                    Menu pilihan akan segera hadir.
                </div>
            @endif
        </div>

        <div class="text-center pt-4" data-aos="fade-up" data-aos-delay="250">
            <a href="{{ route('menu') }}" class="btn-nordic-dark group">
                <span>LIHAT SEMUA MENU</span>
                <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>

    </div>
</section>


{{-- ================================================================= --}}
{{-- 4. OPERATIONAL HOURS BANNER (WARM OBSIDIAN ATMOSPHERE)             --}}
{{-- ================================================================= --}}
@if(!empty($contactSettings->business_hours))
<section class="relative overflow-hidden min-h-95 sm:min-h-110 flex items-center">

    {{-- Background Photo --}}
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1600093463592-8e36ae95ef56?auto=format&fit=crop&w=2000&q=90"
             alt="RDC BEAR Interior"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-linear-to-r from-[#090D16]/95 via-[#090D16]/80 to-[#1E293B]/60"></div>
    </div>

    {{-- Content --}}
    <div class="relative z-10 max-w-7xl mx-auto px-6 sm:px-10 py-12 sm:py-16 w-full text-white">
        <div class="max-w-2xl space-y-6" data-aos="fade-up" data-aos-duration="800">

            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-amber-400/20 border border-amber-400/30 text-amber-400 flex items-center justify-center shrink-0">
                    <i data-lucide="clock" class="w-5 h-5"></i>
                </div>
                <span class="text-xs font-extrabold tracking-widest text-amber-400 uppercase">JAM OPERASIONAL</span>
            </div>

            <h2 class="font-serif-nordic font-bold text-3xl sm:text-5xl text-white leading-tight">
                {{ $contactSettings->business_hours }}
            </h2>

            <p class="font-sans text-sm sm:text-base text-slate-300 leading-relaxed max-w-lg">
                Kami siap menyambut Anda setiap hari. Datang, nikmati suasana hangat kafe kami, dan rasakan secangkir kopi terbaik kami.
            </p>

            <div>
                <a href="{{ route('reservation') }}" class="btn-nordic-primary group">
                    <i data-lucide="calendar-check" class="w-4 h-4 text-slate-950"></i>
                    <span>RESERVASI SEKARANG</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 text-slate-950 transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>

        </div>
    </div>

</section>
@endif


{{-- ================================================================= --}}
{{-- 5. SPECIAL PROMOS & EVENTS PREVIEW                                --}}
{{-- ================================================================= --}}
@if(isset($promos) && $promos->isNotEmpty())
<section class="py-16 sm:py-24 bg-[#F8FAFC] overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 sm:px-10 space-y-12">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4" data-aos="fade-up" data-aos-duration="750">
            <div class="space-y-2">
                <span class="text-xs font-extrabold tracking-widest text-amber-600 uppercase">PROMO &amp; ACARA</span>
                <h2 class="font-serif-nordic font-bold text-3xl sm:text-5xl text-slate-900">Penawaran Spesial</h2>
            </div>
            <a href="{{ route('promos') }}" class="font-bold text-xs uppercase tracking-wider text-amber-600 hover:text-amber-700 transition-colors shrink-0">
                LIHAT SEMUA PROMO &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
            @foreach($promos as $promo)
                <div class="nordic-card overflow-hidden flex flex-col group"
                     data-aos="fade-up"
                     data-aos-delay="{{ $loop->iteration * 150 }}"
                     data-aos-duration="750">
                    <div class="relative h-50 sm:h-60 overflow-hidden bg-slate-100">
                        <img src="{{ $promo->image_url }}"
                             alt="{{ $promo->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @if($promo->start_date || $promo->end_date)
                            <div class="absolute top-4 left-4 bg-slate-950/90 text-amber-300 px-3 py-1 rounded-full text-[10px] font-bold tracking-wider uppercase border border-white/20 shadow-md">
                                @if($promo->start_date && $promo->end_date)
                                    {{ $promo->start_date->format('d M') }} – {{ $promo->end_date->format('d M Y') }}
                                @elseif($promo->end_date)
                                    Hingga {{ $promo->end_date->format('d M Y') }}
                                @else
                                    Mulai {{ $promo->start_date->format('d M Y') }}
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="p-6 space-y-3 flex-1 flex flex-col justify-between">
                        <div class="space-y-2">
                            <h3 class="font-serif-nordic font-bold text-2xl text-slate-900 group-hover:text-amber-600 transition-colors">
                                {{ $promo->title }}
                            </h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                {{ $promo->description }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="inline-flex items-center gap-1.5 text-amber-600 font-bold">
                                <i data-lucide="tag" class="w-3.5 h-3.5"></i> Penawaran Spesial
                            </span>
                            <a href="{{ route('reservation') }}" class="font-bold text-slate-900 hover:text-amber-600 transition-colors">
                                Reservasi &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
@endif


{{-- ================================================================= --}}
{{-- 6. COMMUNITY TESTIMONIALS (KATA MEREKA)                           --}}
{{-- ================================================================= --}}
@if(isset($testimonials) && $testimonials->isNotEmpty())
<section class="py-16 sm:py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 sm:px-10 space-y-12">

        <div class="text-center max-w-xl mx-auto space-y-2" data-aos="fade-up" data-aos-duration="750">
            <span class="text-xs font-extrabold tracking-widest text-amber-600 uppercase">ULASAN PENGUNJUNG</span>
            <h2 class="font-serif-nordic font-bold text-3xl sm:text-5xl text-slate-900">
                Cerita Dari Pengunjung
            </h2>
            <p class="font-script text-xl text-slate-600">
                Ulasan tulus dari para pecinta kopi RDC BEAR
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-8">
            @foreach($testimonials as $testimonial)
                <div class="nordic-card p-6 sm:p-8 flex flex-col justify-between space-y-6"
                     data-aos="fade-up"
                     data-aos-delay="{{ $loop->iteration * 120 }}"
                     data-aos-duration="750">
                    <div class="space-y-4">
                        {{-- Stars --}}
                        <div class="flex items-center gap-1">
                            @for($i = 1; $i <= 5; $i++)
                                <i data-lucide="star" class="w-4 h-4 {{ $i <= $testimonial->rating ? 'fill-amber-400 text-amber-400' : 'text-slate-200' }}"></i>
                            @endfor
                        </div>
                        {{-- Quote --}}
                        <p class="font-sans text-sm sm:text-base text-slate-700 leading-relaxed">
                            &ldquo;{{ $testimonial->review }}&rdquo;
                        </p>
                    </div>

                    {{-- Author --}}
                    <div class="pt-4 border-t border-slate-100">
                        <h4 class="font-bold text-xs sm:text-sm text-slate-900">{{ $testimonial->name }}</h4>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center pt-4" data-aos="fade-up" data-aos-delay="250">
            <a href="{{ route('reviews') }}" class="btn-nordic-dark group">
                <span>LIHAT SEMUA ULASAN</span>
                <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>

    </div>
</section>
@endif

@endsection
