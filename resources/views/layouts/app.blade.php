<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'RDC BEAR - Specialty Coffee')</title>
    <meta name="description" content="@yield('meta_description', 'RDC BEAR Specialty Coffee. Cultivating warmth in every cup. Modern architectural minimalism and organic warmth of specialty coffee.')">

    <!-- Fonts (Nordic Haven Style) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Montserrat:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @yield('styles')
</head>
<body class="bg-white text-slate-900 font-sans antialiased selection:bg-amber-200 selection:text-amber-950 overflow-x-hidden">

    <!-- Shared Fixed Navbar Component -->
    <x-layout.navbar />

    <!-- Main Content (with top padding to account for fixed navbar) -->
    <main class="pt-14.5 sm:pt-16">
        @yield('content')
    </main>

    <!-- Shared Obsidian Dark Footer Component -->
    <x-layout.footer :contact="$contactSettings ?? null" />

    <!-- ================================================================= -->
    <!-- GLOBAL FLOATING BUTTONS                                            -->
    <!-- ================================================================= -->

    @php
        $rawPhone = $contactSettings->phone ?? '';
        $waPhone  = preg_replace('/[^0-9]/', '', $rawPhone);
        if ($waPhone && str_starts_with($waPhone, '0')) {
            $waPhone = '62' . substr($waPhone, 1);
        }
        $waLink = $waPhone ? 'https://wa.me/' . $waPhone : 'https://wa.me/';
    @endphp

    <!-- Floating WhatsApp Button — right bottom (above sticky CTA on mobile < 640px) -->
    <a href="{{ $waLink }}"
       target="_blank"
       rel="noopener noreferrer"
       title="Chat with us on WhatsApp"
       class="wa-pulse fixed bottom-18 sm:bottom-6 right-4 sm:right-5 z-40 w-12 h-12 sm:w-13 sm:h-13 rounded-full bg-green-500 hover:bg-green-600 text-white flex items-center justify-center shadow-lg hover:scale-110 active:scale-95 transition-all duration-200"
       aria-label="Chat on WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

    <!-- Scroll-to-Top Button — left bottom (starts hidden, shown via JS after scroll 400px) -->
    <button id="scroll-to-top"
            onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
            title="Back to top"
            class="opacity-0 pointer-events-none translate-y-3 fixed bottom-18 sm:bottom-6 left-4 sm:left-5 z-40 w-11 h-11 rounded-full bg-slate-900 hover:bg-slate-800 text-white flex items-center justify-center shadow-lg hover:scale-110 active:scale-95 transition-all duration-200"
            aria-label="Scroll to top">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-white">
            <path d="m18 15-6-6-6 6"/>
        </svg>
    </button>

    <!-- ================================================================= -->
    <!-- GLOBAL TOAST NOTIFICATION (Session Flash)                          -->
    <!-- ================================================================= -->
    @if(session('success') || session('error'))
    <div x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 4500)"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-2 scale-95"
         class="fixed top-6 right-5 z-60 max-w-sm w-full bg-slate-900 text-white border border-amber-400/60 px-5 py-4 rounded-2xl shadow-2xl flex items-center gap-4"
         role="alert"
         aria-live="polite">
        <!-- Icon -->
        <div class="w-8 h-8 rounded-full shrink-0 flex items-center justify-center
                    {{ session('success') ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
            <i data-lucide="{{ session('success') ? 'check' : 'alert-circle' }}" class="w-4 h-4"></i>
        </div>
        <!-- Message -->
        <p class="text-xs font-semibold flex-1 leading-relaxed">
            {{ session('success') ?? session('error') }}
        </p>
        <!-- Dismiss -->
        <button @click="show = false"
                class="text-slate-400 hover:text-white shrink-0 transition-colors"
                aria-label="Dismiss notification">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>
    @endif

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
