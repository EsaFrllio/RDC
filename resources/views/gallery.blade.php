@extends('layouts.app')

@section('title', 'Galeri & Suasana - RDC BEAR')

@section('content')

<section class="py-12 sm:py-16 bg-[#F8FAFC]">
    <div class="max-w-7xl mx-auto px-6 sm:px-10 space-y-10 sm:space-y-12">

        <!-- Centered Gallery Page Title -->
        <div class="text-center max-w-2xl mx-auto space-y-2 pt-2 sm:pt-4" data-aos="fade-up" data-aos-duration="750">
            <h1 class="font-serif-nordic text-4xl sm:text-5xl lg:text-[52px] text-slate-900 font-normal tracking-tight leading-tight">
                Galeri RDC BEAR
            </h1>
            <p class="font-sans text-xs sm:text-sm text-slate-500 font-normal tracking-wider">
                Momen &amp; Cerita di RDC BEAR
            </p>
        </div>

        @php
            $categories = $galleries->pluck('category')->unique()->values();
            $galleryItems = $galleries->values()->map(fn($g) => [
                'src'      => $g->image_url,
                'caption'  => $g->caption,
                'category' => $g->category,
            ])->toArray();
        @endphp

        <!-- ============================================================= -->
        <!-- GALLERY: Category Filter + Lightbox                           -->
        <!-- ============================================================= -->
        @if($galleries->isNotEmpty())
        <div x-data="{
                activeCategory: 'all',
                lightbox: false,
                lbSrc: '',
                lbCaption: '',
                lbCategory: '',
                lbIndex: 0,
                items: {{ Js::from($galleryItems) }},

                open(index) {
                    this.lbIndex   = index;
                    this.lbSrc     = this.items[index].src;
                    this.lbCaption = this.items[index].caption;
                    this.lbCategory= this.items[index].category;
                    this.lightbox  = true;
                    document.body.classList.add('lightbox-open');
                },
                close() {
                    this.lightbox = false;
                    document.body.classList.remove('lightbox-open');
                },
                visibleItems() {
                    if (this.activeCategory === 'all') return this.items;
                    return this.items.filter(i => i.category === this.activeCategory);
                },
                prev() {
                    const vis = this.visibleItems();
                    const curr = vis.findIndex(i => i.src === this.lbSrc);
                    const p = (curr - 1 + vis.length) % vis.length;
                    this.lbSrc = vis[p].src; this.lbCaption = vis[p].caption; this.lbCategory = vis[p].category;
                    this.lbIndex = this.items.findIndex(i => i.src === vis[p].src);
                },
                next() {
                    const vis = this.visibleItems();
                    const curr = vis.findIndex(i => i.src === this.lbSrc);
                    const n = (curr + 1) % vis.length;
                    this.lbSrc = vis[n].src; this.lbCaption = vis[n].caption; this.lbCategory = vis[n].category;
                    this.lbIndex = this.items.findIndex(i => i.src === vis[n].src);
                }
            }"
             @keydown.escape.window="close()"
             @keydown.arrow-left.window="lightbox && prev()"
             @keydown.arrow-right.window="lightbox && next()">

            <!-- Category Filter Tabs -->
            <div class="flex flex-wrap items-center gap-2 mb-8" data-aos="fade-up" data-aos-delay="150" data-aos-duration="700">
                <button @click="activeCategory = 'all'"
                        :class="activeCategory === 'all'
                            ? 'bg-slate-900 text-amber-400 shadow-md font-extrabold'
                            : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                        class="px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all">
                    SEMUA
                </button>
                @foreach($categories as $cat)
                <button @click="activeCategory = '{{ $cat }}'"
                        :class="activeCategory === '{{ $cat }}'
                            ? 'bg-slate-900 text-amber-400 shadow-md font-extrabold'
                            : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                        class="px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all">
                    {{ strtoupper($cat) }}
                </button>
                @endforeach
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($galleries as $index => $item)
                <div x-show="activeCategory === 'all' || activeCategory === '{{ $item->category }}'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     @click="open({{ $index }})"
                     data-aos="fade-up"
                     data-aos-delay="{{ ($index % 3) * 120 }}"
                     data-aos-duration="700"
                     class="nordic-card overflow-hidden h-60 sm:h-70 group relative cursor-pointer">
                    <img src="{{ $item->image_url }}"
                         alt="{{ $item->caption }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-linear-to-t from-slate-950/90 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6 text-white">
                        <p class="font-serif-nordic font-bold text-lg leading-snug">{{ $item->caption }}</p>
                        <span class="text-amber-400 text-[10px] uppercase tracking-wider font-bold">{{ $item->category }}</span>
                        <span class="mt-2 inline-flex items-center gap-1 text-slate-300 text-[10px] font-semibold">
                            <i data-lucide="zoom-in" class="w-3 h-3 text-amber-400"></i> Klik untuk memperbesar
                        </span>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Empty state -->
            <p x-show="visibleItems().length === 0" class="text-center text-slate-400 text-sm py-12">
                Tidak ada foto di kategori ini.
            </p>

            <!-- Lightbox Overlay -->
            <div x-show="lightbox"
                 x-transition:enter="transition ease-out duration-250"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click.self="close()"
                 class="fixed inset-0 z-999 bg-black/90 backdrop-blur-sm flex items-center justify-center p-4"
                 role="dialog" aria-modal="true">

                <div class="relative max-w-4xl w-full max-h-[90vh] flex flex-col items-center gap-4">
                    <button @click="close()"
                            class="absolute -top-2 -right-2 z-10 w-9 h-9 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors border border-white/20"
                            aria-label="Tutup">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>

                    <div class="rounded-2xl overflow-hidden w-full max-h-[75vh] bg-black shadow-2xl">
                        <img :src="lbSrc"
                             :alt="lbCaption"
                             class="w-full max-h-[75vh] object-contain">
                    </div>

                    <div class="flex items-center justify-between w-full gap-4">
                        <button @click="prev()"
                                class="w-10 h-10 rounded-full bg-white/10 hover:bg-amber-400 text-white hover:text-slate-950 flex items-center justify-center transition-colors shrink-0">
                            <i data-lucide="chevron-left" class="w-5 h-5"></i>
                        </button>

                        <div class="text-center">
                            <p class="text-white font-serif-nordic font-bold text-lg" x-text="lbCaption"></p>
                            <span class="text-amber-400 text-[11px] uppercase tracking-wider font-bold" x-text="lbCategory"></span>
                        </div>

                        <button @click="next()"
                                class="w-10 h-10 rounded-full bg-white/10 hover:bg-amber-400 text-white hover:text-slate-950 flex items-center justify-center transition-colors shrink-0">
                            <i data-lucide="chevron-right" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-20 text-slate-400 text-sm">Belum ada foto di galeri.</div>
        @endif

        <!-- Find Us / Flagship Location Section -->
        <div id="locations" class="space-y-8 pt-8 border-t border-slate-200 overflow-hidden">
            <div class="max-w-xl space-y-2" data-aos="fade-up" data-aos-duration="750">
                <span class="text-xs font-extrabold tracking-widest text-amber-600 uppercase">KUNJUNGI KAMI</span>
                <h2 class="font-serif-nordic font-bold text-3xl sm:text-4xl text-slate-900">Lokasi Kami</h2>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Kunjungi kafe kami untuk menikmati kehangatan kopi spesialti dan suasana yang menenangkan.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                <!-- Location Details Card -->
                <div class="lg:col-span-4 bg-white border border-slate-200/80 rounded-3xl p-8 flex flex-col justify-between gap-6 shadow-sm"
                     data-aos="fade-right" data-aos-duration="800">
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center shrink-0 mt-0.5">
                                <i data-lucide="map-pin" class="w-5 h-5"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="font-bold text-xs uppercase tracking-wider text-slate-900">Alamat Flagship</h3>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    {{ $contactSettings->address ?? 'Jl. Jenderal Ahmad Yani III No.30, Bago, Tamanan, Tulungagung' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center shrink-0 mt-0.5">
                                <i data-lucide="clock" class="w-5 h-5"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="font-bold text-xs uppercase tracking-wider text-slate-900">Jam Buka</h3>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    {!! nl2br(e($contactSettings->business_hours ?? "Setiap Hari: 07.00 - 23.00 WIB")) !!}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center shrink-0 mt-0.5">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="font-bold text-xs uppercase tracking-wider text-slate-900">Kontak Langsung</h3>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Email: {{ $contactSettings->email ?? 'hello@rdcbear.com' }}<br>
                                    WhatsApp: {{ $contactSettings->phone ?? '+62 812 3456 789' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('reservation') }}" class="btn-nordic-primary text-center">
                        <i data-lucide="calendar-check" class="w-4 h-4 text-slate-950"></i>
                        <span>RESERVASI SEAT</span>
                    </a>
                </div>

                <!-- Interactive Google Map -->
                <div class="lg:col-span-8 rounded-3xl overflow-hidden relative min-h-85 border border-slate-200/80 shadow-sm bg-slate-100"
                     data-aos="fade-left" data-aos-duration="800">
                    <iframe class="w-full h-full min-h-85 border-0" 
                            src="{{ $contactSettings->google_maps_link ?? 'https://maps.google.com/maps?q=-6.2238125,106.819778&z=14&ie=UTF8&iwloc=&output=embed' }}" 
                            allowfullscreen="" 
                            loading="lazy">
                    </iframe>

                    <div class="absolute top-4 right-4 z-10">
                        <a href="https://maps.google.com/?q=-6.2238125,106.819778" target="_blank" class="px-4 py-2 rounded-full bg-slate-900 hover:bg-slate-950 text-white font-bold text-xs flex items-center gap-2 shadow-lg transition-transform hover:scale-105">
                            <i data-lucide="navigation" class="w-3.5 h-3.5 text-amber-400"></i> Petunjuk Arah
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
