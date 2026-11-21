<?php

namespace App\Http\Controllers;

use App\Services\TestimonialService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $testimonialService;

    public function __construct(TestimonialService $testimonialService)
    {
        $this->testimonialService = $testimonialService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        // Customer submitted reviews default to is_active = false (pending admin approval)
        $validated['is_active'] = false;
        $validated['role']      = 'Verified Customer';

        $this->testimonialService->createTestimonial($validated);

        return redirect()->back()->with('success', 'Terima kasih! Ulasan Anda berhasil dikirim dan akan tampil setelah disetujui oleh admin.');
    }
}
