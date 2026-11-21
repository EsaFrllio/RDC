@extends('layouts.app')

@section('title', 'Menu - RDC BEAR')

@section('content')

<!-- The Menu: Header -->
<x-page-header
    title="Pilihan Kopi &amp; "
    highlight="Sajian."
    subtitle="Setiap cangkir diseduh dari biji kopi spesialti pilihan (Grade 85+), disandingkan dengan aneka sajian hangat dan artisanal pastry yang disiapkan segar setiap hari."
/>

<!-- ================================================================= -->
<!-- 2. INTERACTIVE MENU CONTENT CONTAINER WITH LIVE SEARCH & FILTER   -->
<!-- ================================================================= -->
@php
    $allMenuItems = collect();
    if(isset($featuredMenus)) {
        foreach($featuredMenus as $fm) {
            $allMenuItems->push([
                'id' => $fm->id,
                'name' => $fm->name,
                'category_id' => $fm->category_id ?? 0,
                'category_name' => 'Signature',
                'description' => $fm->description,
                'price' => $fm->formatted_price,
                'image_url' => $fm->image_url,
                'is_featured' => true,
            ]);
        }
    }
    if(isset($categoriesWithMenus)) {
        foreach($categoriesWithMenus as $cat) {
            foreach($cat->menus as $m) {
                $allMenuItems->push([
                    'id' => $m->id,
                    'name' => $m->name,
                    'category_id' => $cat->id,
                    'category_name' => $cat->name,
                    'description' => $m->description,
                    'price' => $m->formatted_price,
                    'image_url' => $m->image_url,
                    'is_featured' => false,
                ]);
            }
        }
    }
@endphp

<section class="py-12 sm:py-16 bg-[#F8FAFC]"
         x-data="{
             search: '',
             selectedCategory: 'all',
             items: {{ Js::from($allMenuItems) }},
             filteredItems() {
                 return this.items.filter(item => {
                     const matchCategory = this.selectedCategory === 'all' || item.category_id == this.selectedCategory || (this.selectedCategory === 'featured' && item.is_featured);
                     const matchSearch = this.search === '' || 
                                         item.name.toLowerCase().includes(this.search.toLowerCase()) || 
                                         (item.description && item.description.toLowerCase().includes(this.search.toLowerCase()));
                     return matchCategory && matchSearch;
                 });
             }
         }">
    
    <div class="max-w-7xl mx-auto px-6 sm:px-10 space-y-10 sm:space-y-12">

        {{-- ── Search Bar & Category Filter Tabs ── --}}
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 pt-2"
             data-aos="fade-up" data-aos-duration="600">
            
            {{-- Category Filter Pills --}}
            <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto scrollbar-none pb-2 md:pb-0">
                <button type="button"
                        @click="selectedCategory = 'all'"
                        :class="selectedCategory === 'all' ? 'bg-slate-900 text-amber-400 shadow-md font-extrabold' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                        class="px-5 py-2 rounded-full font-bold text-xs uppercase tracking-wider transition-all shrink-0">
                    SEMUA
                </button>
                <button type="button"
                        @click="selectedCategory = 'featured'"
                        :class="selectedCategory === 'featured' ? 'bg-slate-900 text-amber-400 shadow-md font-extrabold' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                        class="px-5 py-2 rounded-full font-bold text-xs uppercase tracking-wider transition-all shrink-0">
                    ⭐ SIGNATURE
                </button>
                @if(isset($categoriesWithMenus))
                    @foreach($categoriesWithMenus as $cat)
                        <button type="button"
                                @click="selectedCategory = '{{ $cat->id }}'"
                                :class="selectedCategory === '{{ $cat->id }}' ? 'bg-slate-900 text-amber-400 shadow-md font-extrabold' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                                class="px-5 py-2 rounded-full font-bold text-xs uppercase tracking-wider transition-all shrink-0">
                            {{ strtoupper($cat->name) }}
                        </button>
                    @endforeach
                @endif
            </div>

            {{-- Live Search Input --}}
            <div class="relative w-full md:w-72">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                <input type="text"
                       x-model="search"
                       placeholder="Cari menu favorit..."
                       class="w-full pl-10 pr-4 py-2 rounded-full bg-white border border-slate-200 text-xs text-slate-900 placeholder-slate-400 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 shadow-xs">
            </div>

        </div>

        {{-- ── Curated Highlights (Bento Grid) ── --}}
        @if(isset($featuredMenus) && $featuredMenus->isNotEmpty())
            <div x-show="(selectedCategory === 'all' || selectedCategory === 'featured') && search === ''"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="space-y-6">
                
                @php
                    $heroItem = $featuredMenus->first();
                    $subFeatured = $featuredMenus->skip(1);
                @endphp

                <div class="flex items-center justify-between" data-aos="fade-up" data-aos-duration="600">
                    <div>
                        <span class="text-xs font-extrabold tracking-widest text-amber-600 uppercase">MENU HIGHLIGHTS</span>
                        <h2 class="font-serif-nordic font-bold text-3xl sm:text-4xl text-slate-900">Pilihan Favorit Kami</h2>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    {{-- Large Featured Hero Item --}}
                    <div class="lg:col-span-7 rounded-3xl overflow-hidden relative min-h-75 sm:min-h-100 flex flex-col justify-end p-6 sm:p-8 text-white group shadow-lg border border-slate-800"
                         data-aos="fade-right" data-aos-duration="750">
                        <img src="{{ $heroItem->image_url }}" 
                             alt="{{ $heroItem->name }}" 
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        
                        {{-- Dark Gradient Overlay --}}
                        <div class="absolute inset-0 bg-linear-to-t from-slate-950 via-slate-950/60 to-transparent"></div>

                        <div class="relative z-10 space-y-3">
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-amber-400 text-slate-950 font-bold text-[10px] uppercase tracking-wider shadow-sm">
                                <i data-lucide="award" class="w-3 h-3"></i> Top Signature
                            </span>
                            
                            <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between gap-2">
                                <h3 class="font-serif-nordic font-bold text-2xl sm:text-3xl text-white">{{ $heroItem->name }}</h3>
                                <span class="font-sans font-extrabold text-2xl text-amber-400 shrink-0">{{ $heroItem->formatted_price }}</span>
                            </div>
                            
                            <p class="text-xs text-slate-300 max-w-lg leading-relaxed line-clamp-2 font-normal">
                                {{ $heroItem->description }}
                            </p>
                        </div>
                    </div>

                    {{-- Sub-Featured Column --}}
                    @if($subFeatured->isNotEmpty())
                        <div class="lg:col-span-5 flex flex-col gap-4">
                            @foreach($subFeatured as $item)
                                <div class="nordic-card p-5 flex items-center justify-between gap-4 group">
                                    <div class="space-y-1.5 flex-1">
                                        <span class="text-[10px] font-bold text-amber-600 uppercase tracking-wider">Menu Spesial</span>
                                        <h3 class="font-serif-nordic font-bold text-lg text-slate-900 group-hover:text-amber-600 transition-colors">{{ $item->name }}</h3>
                                        <p class="text-xs text-slate-500 leading-snug line-clamp-2">
                                            {{ $item->description }}
                                        </p>
                                        <span class="inline-block font-sans font-extrabold text-sm text-slate-900 pt-1">{{ $item->formatted_price }}</span>
                                    </div>
                                    <div class="w-24 h-24 rounded-2xl overflow-hidden shrink-0 border border-slate-100 shadow-xs group-hover:scale-105 transition-transform duration-300">
                                        <img src="{{ $item->image_url }}" 
                                             alt="{{ $item->name }}" 
                                             class="w-full h-full object-cover">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- ── Main Dynamic Grid List ── --}}
        <div class="space-y-8">
            <div class="flex items-center justify-between border-b border-slate-200 pb-4">
                <div class="space-y-1">
                    <h2 class="font-serif-nordic font-bold text-2xl sm:text-3xl text-slate-900">
                        <span x-show="search !== ''" x-text="'Hasil Pencarian: \'' + search + '\''"></span>
                        <span x-show="search === '' && selectedCategory === 'all'">Full Collection</span>
                        <span x-show="search === '' && selectedCategory === 'featured'">Signatures</span>
                    </h2>
                    <p class="text-xs text-slate-500">
                        Menampilkan <span class="font-bold text-slate-800" x-text="filteredItems().length"></span> pilihan menu
                    </p>
                </div>
            </div>

            {{-- Grid of Items --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" x-show="filteredItems().length > 0">
                <template x-for="item in filteredItems()" :key="item.id">
                    <div class="nordic-card p-5 flex flex-col justify-between space-y-4 group">
                        
                        {{-- Image Container --}}
                        <div class="relative rounded-2xl overflow-hidden h-50 bg-slate-100">
                            <img :src="item.image_url" 
                                 :alt="item.name" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            {{-- Category Tag Badge --}}
                            <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-slate-950/85 backdrop-blur-md text-amber-300 text-[10px] font-bold uppercase tracking-wider border border-white/10"
                                  x-text="item.category_name"></span>
                        </div>

                        {{-- Info --}}
                        <div class="space-y-2 flex-1 flex flex-col justify-between">
                            <div class="space-y-1">
                                <div class="flex items-baseline justify-between gap-2">
                                    <h3 class="font-serif-nordic font-bold text-xl text-slate-900 group-hover:text-amber-600 transition-colors" x-text="item.name"></h3>
                                    <span class="font-sans font-extrabold text-sm text-amber-600 shrink-0" x-text="item.price"></span>
                                </div>
                                <p class="text-xs text-slate-500 leading-relaxed line-clamp-2" x-text="item.description"></p>
                            </div>

                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                                <span class="inline-flex items-center gap-1 font-medium text-xs">
                                    <i data-lucide="coffee" class="w-3.5 h-3.5 text-amber-500"></i> RDC Specialty
                                </span>
                                <span class="font-bold text-amber-600 group-hover:translate-x-1 transition-transform">
                                    Pesan &rarr;
                                </span>
                            </div>
                        </div>

                    </div>
                </template>
            </div>

            {{-- Empty State --}}
            <div x-show="filteredItems().length === 0" x-cloak
                 class="bg-white rounded-3xl p-12 text-center border border-slate-100 shadow-xs space-y-4 max-w-md mx-auto">
                <div class="w-16 h-16 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center mx-auto">
                    <i data-lucide="search-x" class="w-8 h-8"></i>
                </div>
                <h3 class="font-serif-nordic font-bold text-2xl text-slate-900">Menu Tidak Ditemukan</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Tidak ada menu yang cocok dengan kata kunci "<span class="font-bold text-slate-700" x-text="search"></span>".
                </p>
                <button type="button"
                        @click="search = ''; selectedCategory = 'all'"
                        class="btn-nordic-dark">
                    Reset Filter
                </button>
            </div>

        </div>

    </div>
</section>

@endsection
