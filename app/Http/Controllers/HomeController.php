<?php

namespace App\Http\Controllers;

use App\Models\Promo;

use App\Services\MenuService;
use App\Services\GalleryService;
use App\Services\FacilityService;
use App\Services\TestimonialService;
use App\Services\ContactService;

class HomeController extends Controller
{
    protected $menuService;
    protected $galleryService;
    protected $facilityService;
    protected $testimonialService;
    protected $contactService;

    public function __construct(
        MenuService $menuService,
        GalleryService $galleryService,
        FacilityService $facilityService,
        TestimonialService $testimonialService,
        ContactService $contactService
    ) {
        $this->menuService = $menuService;
        $this->galleryService = $galleryService;
        $this->facilityService = $facilityService;
        $this->testimonialService = $testimonialService;
        $this->contactService = $contactService;
    }

    public function index()
    {
        $featuredMenus = $this->menuService->getFeaturedMenus();
        $contactSettings = $this->contactService->getContactSettings();
        $promos = \App\Models\Promo::active()->orderBy('sort_order')->take(2)->get();
        $testimonials = \App\Models\Testimonial::active()->orderByDesc('rating')->latest()->take(3)->get();

        return view('home', compact('featuredMenus', 'contactSettings', 'promos', 'testimonials'));
    }

    public function story()
    {
        $testimonials    = $this->testimonialService->getActiveTestimonials();
        $contactSettings = $this->contactService->getContactSettings();
        $facilities      = $this->facilityService->getAllFacilities();

        return view('story', compact('testimonials', 'contactSettings', 'facilities'));
    }

    public function menu()
    {
        $featuredMenus = $this->menuService->getFeaturedMenus();
        $categoriesWithMenus = $this->menuService->getCategoriesWithMenus();
        $contactSettings = $this->contactService->getContactSettings();

        return view('menu', compact('featuredMenus', 'categoriesWithMenus', 'contactSettings'));
    }

    public function gallery()
    {
        $galleries = $this->galleryService->getAllGalleries();
        $facilities = $this->facilityService->getAllFacilities();
        $contactSettings = $this->contactService->getContactSettings();

        return view('gallery', compact('galleries', 'facilities', 'contactSettings'));
    }

    public function promos()
    {
        $promos = Promo::active()->orderBy('sort_order', 'asc')->get();
        $contactSettings = $this->contactService->getContactSettings();

        return view('promos', compact('promos', 'contactSettings'));
    }

    public function reservation()
    {
        $contactSettings = $this->contactService->getContactSettings();

        return view('reservation', compact('contactSettings'));
    }

    public function reviews()
    {
        $testimonials = $this->testimonialService->getActiveTestimonials();
        $contactSettings = $this->contactService->getContactSettings();

        return view('reviews', compact('testimonials', 'contactSettings'));
    }

    public function contact()
    {
        $contactSettings = $this->contactService->getContactSettings();
        $facilities = $this->facilityService->getAllFacilities();

        return view('contact', compact('contactSettings', 'facilities'));
    }
}
