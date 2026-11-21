@extends('layouts.app')

@section('title', 'Ulasan Pengunjung - RDC BEAR')

@section('content')

<div x-data="{ openReviewModal: false, rating: 5, hoverRating: 0 }">

    <!-- Community Reviews Header -->
    <x-page-header
        title="Cerita Dari "
        highlight="Pengunjung."
        subtitle="Cerita tulus dan pengalaman nyata dari para penikmat kopi spesialti dan pengunjung setia RDC BEAR."
    >
        <div class="pt-1 flex flex-wrap items-center gap-4">
            <div class="flex items-center gap-3 px-4 py-2 rounded-full bg-white/10 border border-white/15">
                <span class="text-xl font-black text-amber-400">4.9</span>
                <div>
                    <div class="flex items-center gap-0.5 text-amber-400">
                        @for($i=0; $i<5; $i++)
                            <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                        @endfor
                    </div>
                    <span class="text-[10px] text-slate-300 uppercase tracking-wider font-bold">Top Rated</span>
                </div>
            </div>
            <button @click="openReviewModal = true"
                    class="btn-nordic-primary">
                <i data-lucide="edit-3" class="w-4 h-4 text-slate-950"></i>
                <span>TULIS ULASAN</span>
            </button>
        </div>
    </x-page-header>

    <!-- Content Grid -->
    <section class="py-16 sm:py-24 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-6 sm:px-10 space-y-12">

            @if(isset($testimonials) && $testimonials->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @foreach($testimonials as $testimonial)
                        <div class="nordic-card p-8 flex flex-col justify-between space-y-6"
                             data-aos="fade-up"
                             data-aos-delay="{{ ($loop->iteration % 3) * 120 }}"
                             data-aos-duration="750">
                            <div class="space-y-4">
                                <!-- Star Rating -->
                                <div class="flex items-center gap-1 text-amber-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $testimonial->rating ? 'fill-amber-400 text-amber-400' : 'text-slate-200 fill-slate-200' }}" viewBox="0 0 24 24">
                                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                        </svg>
                                    @endfor
                                </div>

                                <!-- Review Text -->
                                <p class="font-sans text-sm sm:text-base text-slate-700 leading-relaxed">
                                    &ldquo;{{ $testimonial->review }}&rdquo;
                                </p>
                            </div>

                            <!-- Customer Info -->
                            <div class="pt-4 border-t border-slate-100">
                                <h4 class="font-bold text-xs sm:text-sm text-slate-900 tracking-wide">{{ $testimonial->name }}</h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="py-16 text-center text-slate-400 space-y-4 max-w-md mx-auto">
                    <div class="w-16 h-16 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center mx-auto">
                        <i data-lucide="message-square" class="w-8 h-8"></i>
                    </div>
                    <h3 class="font-serif-nordic font-bold text-2xl text-slate-900">Belum Ada Ulasan Publik</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Jadilah yang pertama untuk membagikan ulasan kunjungan Anda di RDC BEAR.
                    </p>
                    <button @click="openReviewModal = true" class="btn-nordic-dark">
                        <span>Tulis Ulasan Pertama</span>
                    </button>
                </div>
            @endif

        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════════ -->
    <!-- MODAL FORM : SUBMIT USER REVIEW                                  -->
    <!-- ════════════════════════════════════════════════════════════════ -->
    <div x-show="openReviewModal" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto bg-black/75 backdrop-blur-sm flex items-center justify-center p-4">

        <div @click.away="openReviewModal = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="bg-white max-w-md w-full rounded-3xl shadow-2xl overflow-hidden border border-slate-100 relative">

            <!-- Modal Header -->
            <div class="bg-slate-950 px-6 py-5 text-white flex items-center justify-between border-b border-slate-800">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-amber-400/20 flex items-center justify-center text-amber-400">
                        <i data-lucide="star" class="w-5 h-5 fill-current"></i>
                    </div>
                    <div>
                        <h3 class="font-serif-nordic font-bold text-xl text-white">Beri Ulasan RDC BEAR</h3>
                        <p class="text-[11px] text-slate-400">Ulasan Anda akan tampil setelah ditinjau admin</p>
                    </div>
                </div>
                <button @click="openReviewModal = false" class="text-slate-400 hover:text-white transition-colors p-1" aria-label="Tutup">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Form Body -->
            <form action="{{ route('reviews.store') }}" method="POST" class="p-6 space-y-5">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="review-name" class="block text-xs font-bold text-slate-800 uppercase tracking-wider mb-1.5">
                        Nama Lengkap <span class="text-amber-600">*</span>
                    </label>
                    <input type="text" id="review-name" name="name" required placeholder="Contoh: Budi Santoso"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                </div>

                <!-- Star Rating Picker -->
                <div>
                    <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider mb-2">
                        Bintang Rating <span class="text-amber-600">*</span>
                    </label>
                    <input type="hidden" name="rating" :value="rating">
                    <div class="flex items-center gap-2 bg-slate-50 p-3 rounded-2xl border border-slate-100 justify-between">
                        <div class="flex items-center gap-1">
                            <template x-for="star in 5" :key="star">
                                <button type="button"
                                        @click="rating = star"
                                        @mouseenter="hoverRating = star"
                                        @mouseleave="hoverRating = 0"
                                        class="p-1 text-slate-300 hover:scale-125 transition-transform focus:outline-none">
                                    <svg class="w-7 h-7"
                                         :class="(hoverRating ? star <= hoverRating : star <= rating) ? 'fill-amber-400 text-amber-400' : 'fill-slate-200 text-slate-200'"
                                         viewBox="0 0 24 24">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                    </svg>
                                </button>
                            </template>
                        </div>
                        <span class="text-xs font-bold text-amber-700 bg-amber-100 px-2.5 py-1 rounded-full" x-text="rating + ' / 5 Bintang'"></span>
                    </div>
                </div>

                <!-- Review Textarea -->
                <div>
                    <label for="review-text" class="block text-xs font-bold text-slate-800 uppercase tracking-wider mb-1.5">
                        Ulasan &amp; Kesan Anda <span class="text-amber-600">*</span>
                    </label>
                    <textarea id="review-text" name="review" rows="4" required placeholder="Tuliskan pengalaman Anda mengenai rasa kopi, suasana kafe, atau pelayanan kami..."
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400"></textarea>
                </div>

                <!-- Buttons -->
                <div class="pt-3 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" @click="openReviewModal = false"
                            class="px-4 py-2.5 rounded-full border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold text-xs transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="btn-nordic-primary">
                        <span>KIRIM ULASAN</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
