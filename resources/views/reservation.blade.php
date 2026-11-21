@extends('layouts.app')

@section('title', 'Reservasi Meja - RDC BEAR')

@section('content')

<!-- Reservation Body -->
<section class="py-12 sm:py-16 bg-[#F8FAFC]">
    <div class="max-w-4xl mx-auto px-6 sm:px-10 space-y-12">
        
        <div class="bg-white border border-slate-200/80 rounded-3xl p-8 sm:p-12 shadow-sm space-y-8"
             data-aos="fade-up" data-aos-duration="800">

            {{-- WhatsApp Confirmation Banner (shown after successful submission) --}}
            @if(session('wa_url'))
            <div class="bg-green-50 border border-green-200 rounded-2xl p-5 flex flex-col sm:flex-row items-start sm:items-center gap-4"
                 data-aos="zoom-in" data-aos-duration="600">
                <div class="w-10 h-10 rounded-xl bg-green-500/15 flex items-center justify-center shrink-0">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                </div>
                <div class="flex-1 space-y-1">
                    <p class="text-sm font-bold text-green-800">Reservasi berhasil disimpan!</p>
                    <p class="text-xs text-green-700 leading-relaxed">Klik tombol di samping untuk melanjutkan konfirmasi via WhatsApp agar tim kami dapat memproses reservasi Anda.</p>
                </div>
                <a href="{{ session('wa_url') }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-green-500 hover:bg-green-600 text-white font-bold text-xs tracking-wide transition-all shadow-sm shrink-0">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    Konfirmasi via WhatsApp
                </a>
            </div>
            @endif

            <div class="border-b border-slate-100 pb-6 space-y-2">
                <span class="text-xs font-extrabold tracking-widest text-amber-600 uppercase">FORMULIR RESERVASI</span>
                <h2 class="font-serif-nordic font-bold text-3xl text-slate-900">Reservasi Meja Anda</h2>
                <p class="text-xs text-slate-500">Silakan lengkapi data reservasi di bawah ini. Bidang bertanda * wajib diisi.</p>
            </div>

            <form action="{{ route('reservations.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-800 mb-2">Nama Lengkap *</label>
                        <input type="text" name="name" required placeholder="Contoh: Budi Santoso" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-800 mb-2">Alamat Email *</label>
                        <input type="email" name="email" required placeholder="budi@example.com" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-800 mb-2">No. WhatsApp *</label>
                        <input type="text" name="phone" required placeholder="08123456789" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-800 mb-2">Tanggal Reservasi *</label>
                        <input type="date" name="reservation_date" required min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-800 mb-2">Jam Reservasi *</label>
                        <select name="reservation_time" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                            <option value="">-- Pilih Jam --</option>
                            <option value="07.00">07.00</option>
                            <option value="08.00">08.00</option>
                            <option value="09.00">09.00</option>
                            <option value="10.00">10.00</option>
                            <option value="11.00">11.00</option>
                            <option value="12.00">12.00</option>
                            <option value="13.00">13.00</option>
                            <option value="14.00">14.00</option>
                            <option value="15.00">15.00</option>
                            <option value="16.00">16.00</option>
                            <option value="17.00">17.00</option>
                            <option value="18.00">18.00</option>
                            <option value="19.00">19.00</option>
                            <option value="20.00">20.00</option>
                            <option value="21.00">21.00</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-800 mb-2">Jumlah Tamu *</label>
                        <select name="guest_count" required class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                            <option value="1">1 Orang (Solo Focus)</option>
                            <option value="2" selected>2 Orang (Duo / Meeting)</option>
                            <option value="4">3 - 4 Orang (Small Group)</option>
                            <option value="6">5 - 6 Orang (Family / Team)</option>
                            <option value="10">Lebih dari 6 Orang (Community)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-800 mb-2">Pilihan Area Meja</label>
                        <select name="table_area" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                            <option value="indoor_main">Indoor Main Area (AC &amp; Co-work)</option>
                            <option value="indoor_lounge">Indoor Cozy Lounge (Sofa)</option>
                            <option value="outdoor_garden">Semi-Outdoor Garden (Smoking Friendly)</option>
                            <option value="private_room">Private Meeting Room</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-800 mb-2">Catatan Khusus (Opsional)</label>
                    <textarea name="special_requests" rows="3" placeholder="Contoh: Butuh colokan listrik dekat meja, setup meeting, atau perayaan ulang tahun..." class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400"></textarea>
                </div>

                <div class="pt-4 flex items-center justify-between border-t border-slate-100">
                    <span class="text-xs text-slate-500">Konfirmasi instan via WhatsApp</span>
                    <button type="submit" class="btn-nordic-primary">
                        <i data-lucide="check" class="w-4 h-4 text-slate-950"></i>
                        <span>KIRIM RESERVASI MEJA</span>
                    </button>
                </div>

            </form>

        </div>

    </div>
</section>

@endsection
