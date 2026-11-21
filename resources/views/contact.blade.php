@extends('layouts.app')

@section('title', 'Hubungi Kami - RDC BEAR Specialty Coffee')

@section('content')

<!-- ================================================================= -->
<!-- CONTACT US PAGE (NORDIC HAVEN CLEAN CENTERED LAYOUT)              -->
<!-- ================================================================= -->
<main class="bg-[#F8F8F8] min-h-screen overflow-hidden">
    <div class="max-w-275 mx-auto px-5 py-10 sm:py-14">

        <!-- Centered Title -->
        <div data-aos="fade-up" data-aos-duration="750">
            <h1 class="text-center font-serif-nordic font-bold text-3xl sm:text-4xl text-slate-900 mb-2">
                Hubungi Kami
            </h1>
            <p class="text-center text-slate-500 text-sm sm:text-[15px] mb-10">
                Ada pertanyaan, saran, atau masukan? Langsung kirim pesan ke kami ya!
            </p>
        </div>

        <!-- 2-Column Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10">

            <!-- LEFT CARD: Info + Map + Opening Hours -->
            <div data-aos="fade-right" data-aos-duration="800" class="bg-white rounded-2xl shadow-[0_8px_20px_rgba(0,0,0,0.06)] p-6 sm:p-8 space-y-6">

                <p class="text-slate-600 text-sm leading-relaxed">
                    Kalau ada pertanyaan atau hal yang ingin ditanyakan, kamu bisa hubungi kami lewat form kontak,
                    telepon, atau datang langsung ke lokasi kami:
                </p>

                <!-- Address -->
                <div class="flex items-start gap-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0 mt-0.5">
                        <i data-lucide="map-pin" class="w-4.5 h-4.5"></i>
                    </div>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        {{ $contactSettings->address ?? 'Jl. Jenderal Ahmad Yani III No.30, Bago, Tamanan, Tulungagung' }}
                    </p>
                </div>

                <!-- Email -->
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                        <i data-lucide="mail" class="w-4.5 h-4.5"></i>
                    </div>
                    <p class="text-sm text-slate-600">
                        {{ $contactSettings->email ?? 'hello@rdcbear.com' }}
                    </p>
                </div>

                <!-- Phone / WhatsApp -->
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                        <i data-lucide="phone" class="w-4.5 h-4.5"></i>
                    </div>
                    <p class="text-sm text-slate-600">
                        {{ $contactSettings->phone ?? '+62 812 3456 789' }}
                    </p>
                </div>

                <!-- Google Map -->
                <div class="rounded-xl overflow-hidden border border-slate-200 h-52 sm:h-60">
                    <iframe class="w-full h-full border-0"
                            src="{{ $contactSettings->google_maps_link ?? 'https://maps.google.com/maps?q=-6.2238125,106.819778&z=14&ie=UTF8&iwloc=&output=embed' }}"
                            allowfullscreen=""
                            loading="lazy">
                    </iframe>
                </div>

                <!-- Opening Hours Banner -->
                <div class="flex items-center justify-center flex-wrap gap-1.5 py-3 px-4 bg-amber-50 border-l-4 border-amber-500 rounded-xl text-sm font-semibold text-amber-900">
                    <span class="font-bold uppercase tracking-wider text-xs">JAM BUKA</span>
                    <span class="text-amber-600 mx-1">|</span>
                    <span class="font-bold">{{ $contactSettings->business_hours ?? '07.00 - 23.00' }}</span>
                </div>

            </div>

            <!-- RIGHT CARD: Contact Form -->
            <div data-aos="fade-left" data-aos-duration="800" class="bg-white rounded-2xl shadow-[0_8px_20px_rgba(0,0,0,0.06)] p-6 sm:p-8">

                @if(session('contact_success'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium flex items-center gap-2">
                        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 shrink-0"></i>
                        {{ session('contact_success') }}
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Nama -->
                    <div class="space-y-1.5">
                        <label for="contact_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Nama</label>
                        <input type="text"
                               id="contact_name"
                               name="name"
                               placeholder="Nama lengkap"
                               value="{{ old('name') }}"
                               required
                               class="contact-input">
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No. Telepon -->
                    <div class="space-y-1.5">
                        <label for="contact_phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">No. Telepon</label>
                        <input type="text"
                               id="contact_phone"
                               name="phone"
                               placeholder="08xxxxxxxxxx"
                               value="{{ old('phone') }}"
                               class="contact-input">
                        @error('phone')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-1.5">
                        <label for="contact_email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Email</label>
                        <input type="email"
                               id="contact_email"
                               name="email"
                               placeholder="email@email.com"
                               value="{{ old('email') }}"
                               required
                               class="contact-input">
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pesan -->
                    <div class="space-y-1.5">
                        <label for="contact_message" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Pesan</label>
                        <textarea id="contact_message"
                                  name="message"
                                  rows="5"
                                  placeholder="Yuk, sampaikan pesan kamu di sini..."
                                  required
                                  class="contact-input resize-none">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full py-3.5 rounded-full bg-amber-500 hover:bg-amber-600 text-white font-bold text-sm tracking-wider uppercase transition-all duration-300 shadow-md hover:shadow-lg hover:shadow-amber-500/25 cursor-pointer">
                        Kirim Pesan
                    </button>
                </form>

            </div>

        </div>

    </div>
</main>

@endsection
