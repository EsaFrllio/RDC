@extends('layouts.app')

@section('title', 'Promo & Acara - RDC BEAR')

@section('content')

<section class="py-12 sm:py-16 bg-[#F8FAFC]">
    <div class="max-w-7xl mx-auto px-6 sm:px-10 space-y-10 sm:space-y-12">
        
        <!-- Centered Events & Promos Title -->
        <div class="text-center max-w-2xl mx-auto space-y-2 pt-2 sm:pt-4" data-aos="fade-up" data-aos-duration="750">
            <h1 class="font-serif-nordic text-4xl sm:text-5xl lg:text-[52px] text-slate-900 font-normal tracking-tight leading-tight">
                Promo &amp; Acara Spesial
            </h1>
            <p class="font-sans text-xs sm:text-sm text-slate-500 font-normal tracking-wider">
                Nikmati penawaran spesial, diskon eksklusif, &amp; agenda event di RDC BEAR
            </p>
        </div>
        
        @if(isset($promos) && $promos->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($promos as $promo)
                    <div class="nordic-card overflow-hidden flex flex-col justify-between group"
                         data-aos="fade-up"
                         data-aos-delay="{{ $loop->iteration * 120 }}"
                         data-aos-duration="750">
                        <div class="space-y-4">
                            <div class="relative h-55 overflow-hidden bg-slate-100">
                                <img src="{{ $promo->image_url }}" 
                                     alt="{{ $promo->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                
                                @if($promo->start_date || $promo->end_date)
                                    <div class="absolute top-4 left-4 bg-slate-950/90 text-amber-300 px-3.5 py-1 rounded-full text-[10px] font-bold tracking-wider uppercase border border-white/20 shadow-md">
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

                            <div class="p-6 space-y-2">
                                <h3 class="font-serif-nordic font-bold text-2xl text-slate-900 group-hover:text-amber-600 transition-colors">{{ $promo->title }}</h3>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    {{ $promo->description }}
                                </p>
                            </div>
                        </div>

                        <div class="px-6 pb-6 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                            <span class="inline-flex items-center gap-1 text-amber-600 font-bold text-xs">
                                <i data-lucide="tag" class="w-3.5 h-3.5"></i> Penawaran Spesial
                            </span>
                            <a href="{{ route('reservation') }}" class="font-bold text-slate-900 hover:text-amber-600 transition-colors">
                                Reservasi Meja &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="py-20 text-center text-slate-400 space-y-4 max-w-md mx-auto">
                <div class="w-16 h-16 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center mx-auto">
                    <i data-lucide="sparkles" class="w-8 h-8"></i>
                </div>
                <h3 class="font-serif-nordic font-bold text-2xl text-slate-900">Belum Ada Promo Aktif</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Kami sedang menyiapkan sesi cupping kopi dan penawaran seasonal berikutnya. Kunjungi lagi segera!
                </p>
                <a href="{{ route('menu') }}" class="btn-nordic-dark">
                    <span>JELAJAHI MENU KAMI</span>
                </a>
            </div>
        @endif

    </div>
</section>

@endsection
