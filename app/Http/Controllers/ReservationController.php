<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone'            => 'required|string|max:50',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required|string|max:20',
            'guest_count'      => 'required|integer|min:1|max:50',
            'message'          => 'nullable|string|max:1000',
        ]);

        // Simpan ke database agar tetap tercatat di Admin Panel
        Reservation::create($validated);

        // ─── Bangun pesan WhatsApp ──────────────────────────────────────
        $date  = !empty($validated['reservation_date'])
            ? \Carbon\Carbon::parse($validated['reservation_date'])->translatedFormat('d F Y')
            : '-';

        $time  = $validated['reservation_time'] ?? '-';
        $guest = $validated['guest_count'] ?? '-';
        $note  = !empty($validated['message']) ? $validated['message'] : '-';

        $text = implode("\n", [
            'Halo RDC BEAR! Saya ingin melakukan reservasi meja 🐻',
            '',
            '📌 *Nama:* ' . $validated['name'],
            '📧 *Email:* ' . $validated['email'],
            '📞 *Telepon:* ' . ($validated['phone'] ?? '-'),
            '📅 *Tanggal:* ' . $date,
            '🕐 *Waktu:* ' . $time,
            '👥 *Jumlah Tamu:* ' . $guest . ' orang',
            '💬 *Catatan:* ' . $note,
        ]);

        // ─── Ambil nomor WA dari Contact Settings ──────────────────────
        $contact   = Contact::first();
        $waNumber  = $contact?->whatsapp ?? $contact?->phone ?? '';

        // Normalkan nomor: hilangkan karakter non-angka, ganti awalan 0 → 62
        $waNumber = preg_replace('/[^0-9]/', '', $waNumber ?? '');
        if (str_starts_with($waNumber, '0')) {
            $waNumber = '62' . substr($waNumber, 1);
        }

        $waUrl = 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($text);

        // ─── Response ──────────────────────────────────────────────────
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'wa_url'  => $waUrl,
            ], 201);
        }

        // Redirect ke halaman reservasi dengan flash message + wa_url untuk tombol WA
        return redirect()->route('reservation')
            ->with('success', 'Reservasi berhasil dikirim! Klik tombol di bawah untuk konfirmasi via WhatsApp.')
            ->with('wa_url', $waUrl);
    }
}
