@extends('layouts.app')

@section('title', 'Cerita Kami - RDC BEAR Specialty Coffee')

@section('content')

@php
    $menuCount = \App\Models\Menu::count();
    $rating    = $contactSettings->google_rating ?? '4.9';
    $customers = $contactSettings->happy_customers_label ?? '1K+';
@endphp

<!-- ================================================================= -->
<!-- 1. MAIN OUR STORY / ABOUT HERO SECTION (RDC BEAR SIGNATURE PALETTE)-->
<!-- ================================================================= -->
<section class="about-wrapper bg-[#F8FAFC] py-14 sm:py-20 lg:py-24 border-b border-slate-200/80 overflow-hidden" id="about">
    <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">

            <!-- LEFT IMAGE CARD (RDC BEAR BRANDED OVERLAY) -->
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

            <!-- RIGHT CONTENT (RDC AMBER & SLATE ACCENTS) -->
            <div class="lg:col-span-7 space-y-6 lg:pl-2" data-aos="fade-left" data-aos-duration="850">
                
                <div>
                    <span class="about-badge">
                        TENTANG KAMI
                    </span>
                </div>

                <h1 class="about-title">
                    Selamat Datang di<br>
                    <span class="about-brand">RDC BEAR</span>
                </h1>

                <div class="space-y-4 about-desc">
                    <p>
                        Sebuah ruang yang terinspirasi dari kehangatan dan kesederhanaan desain Scandinavian minimalis. Kami menghadirkan perpaduan antara kopi spesialti berkualitas, suasana tenang, dan interior minimalis yang membuat setiap kunjungan terasa nyaman dan menenangkan.
                    </p>
                    <p>
                        Dibangun dengan konsep <em>cozy &amp; clean aesthetic</em>, RDC BEAR dirancang sebagai tempat di mana siapa pun bisa berhenti sejenak dari kesibukan, menikmati waktu sendiri, bekerja dengan fokus, atau berkumpul bersama teman dan keluarga.
                    </p>
                </div>

                <!-- STATS ROW (RDC AMBER ACCENT) -->
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

            </div>

        </div>
    </div>
</section>

<!-- ================================================================= -->
<!-- 2. SOURCING & ROOTS SECTION                                       -->
<!-- ================================================================= -->
<section class="py-16 sm:py-20 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-12 space-y-16">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-5 space-y-4" data-aos="fade-right" data-aos-duration="800">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-amber-100 text-amber-800 text-xs font-bold tracking-wider uppercase">
                    <i data-lucide="heart" class="w-3.5 h-3.5 text-amber-600"></i> SOURCING BIJI KOPI
                </span>
                <h2 class="font-serif-nordic font-bold text-3xl sm:text-4xl text-slate-900">Berakar dari Tanah Terbaik</h2>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed font-sans">
                    Kami percaya kopi yang luar biasa bermula jauh sebelum proses sangrai. Kopi berakar dari kesuburan tanah, iklim pegunungan, dan ketelatenan tangan petani yang merawatnya. RDC BEAR bermitra langsung dengan perkebunan lokal berkelanjutan.
                </p>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed font-sans">
                    Dengan menjaga relasi jangka panjang, kami memastikan hasil panen terbaik dengan kompensasi yang adil bagi komunitas petani.
                </p>
            </div>

            <div class="lg:col-span-4 rounded-2xl overflow-hidden shadow-md h-72 sm:h-80"
                 data-aos="fade-up" data-aos-delay="150" data-aos-duration="800">
                <img src="https://images.unsplash.com/photo-1611854779393-1b2da9d400fe?auto=format&fit=crop&w=800&q=80" 
                     alt="Hands holding coffee cherries" 
                     class="w-full h-full object-cover">
            </div>

            <div class="lg:col-span-3 space-y-4 flex flex-col justify-between h-72 sm:h-80"
                 data-aos="fade-left" data-aos-delay="250" data-aos-duration="800">
                <div class="rounded-2xl overflow-hidden h-44 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1587734195503-904fca47e0e9?auto=format&fit=crop&w=800&q=80" 
                         alt="Coffee beans in spoon" 
                         class="w-full h-full object-cover">
                </div>
                <div class="bg-slate-950 text-white rounded-2xl p-5 shadow-sm border border-slate-800">
                    <h3 class="font-serif-nordic font-bold text-3xl text-amber-400">100%</h3>
                    <p class="text-xs text-slate-300 font-medium leading-snug mt-1">
                        Biji Arabika Pilihan dari Perkebunan Berkelanjutan.
                    </p>
                </div>
            </div>
        </div>

        <!-- THE ART OF THE ROAST -->
        <div class="pt-12 border-t border-slate-200 space-y-10">
            <div class="text-center max-w-xl mx-auto space-y-2" data-aos="fade-up" data-aos-duration="750">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-amber-100 text-amber-800 text-xs font-bold tracking-wider uppercase">
                    <i data-lucide="coffee" class="w-3.5 h-3.5 text-amber-600"></i> PROSES SANGRAI
                </span>
                <h2 class="font-serif-nordic font-bold text-3xl sm:text-4xl text-slate-900">Seni di Balik Proses Sangrai</h2>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-sans">
                    Sangrai adalah titik temu antara sains dan intuisi. Roaster kami menonjolkan karakter rasa unik yang tersimpan di dalam setiap biji kopi.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="rounded-3xl overflow-hidden shadow-lg h-72 sm:h-84" data-aos="fade-right" data-aos-duration="800">
                    <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=1000&q=80" 
                         alt="Coffee Roasting Process" 
                         class="w-full h-full object-cover">
                </div>
                <div class="space-y-4" data-aos="fade-left" data-aos-duration="800">
                    <div class="nordic-card p-6 space-y-2">
                        <h3 class="font-serif-nordic font-bold text-xl text-slate-900">Profil Sangrai Presisi</h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-sans">
                            Setiap profil sangrai dikalibrasi secara cermat untuk menonjolkan aroma floral, keasaman buah yang seimbang, dan rasa manis alami.
                        </p>
                    </div>
                    <div class="nordic-card p-6 space-y-2">
                        <h3 class="font-serif-nordic font-bold text-xl text-slate-900">Dedikasi Batch Kecil</h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-sans">
                            Kami memanggang dalam batch kecil guna memastikan kesegaran puncak dan konsistensi kualitas di setiap cangkir yang disajikan.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Facilities & Comfort Section --}}
        @if(isset($facilities) && $facilities->isNotEmpty())
            <div class="pt-12 border-t border-slate-200 space-y-8">
                <div class="text-center max-w-xl mx-auto space-y-2" data-aos="fade-up" data-aos-duration="750">
                    <span class="text-xs font-extrabold tracking-widest text-amber-600 uppercase">RUANG &amp; KENYAMANAN</span>
                    <h2 class="font-serif-nordic font-bold text-3xl sm:text-4xl text-slate-900">Fasilitas</h2>
                    <p class="font-script text-xl text-slate-600">
                        Ruang yang dirancang untuk produktivitas, santai, dan kebersamaan
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($facilities as $facility)
                        <div class="nordic-card p-6 space-y-3"
                             data-aos="fade-up"
                             data-aos-delay="{{ $loop->iteration * 100 }}"
                             data-aos-duration="700">
                            <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center font-bold">
                                <i data-lucide="{{ $facility->icon ?? 'sparkles' }}" class="w-6 h-6 text-amber-600"></i>
                            </div>
                            <h3 class="font-serif-nordic font-bold text-xl text-slate-900">{{ $facility->name }}</h3>
                            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed font-sans">{{ $facility->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</section>

@endsection
