<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login | RDC The Cafe Portal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50/50 text-slate-800 font-sans antialiased min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Glowing brand-coordinated elements -->
    <div class="absolute top-1/3 left-1/3 w-75 h-75 rounded-full bg-cyan-100/40 blur-[100px]"></div>
    <div class="absolute bottom-1/3 right-1/3 w-75 h-75 rounded-full bg-indigo-100/40 blur-[100px]"></div>

    <div class="max-w-md w-full bg-white border border-slate-100 rounded-3xl p-8 relative z-10 shadow-lg" data-aos="zoom-in" data-aos-duration="600">
        
        <!-- Logo Header -->
        <div class="flex flex-col items-center text-center mb-8">
            <x-logo :height="64" :showText="false" />
            <h2 class="font-heading font-black text-xl text-slate-800 mt-4 uppercase tracking-widest leading-none">
                Staff Authentication
            </h2>
            <p class="font-sans text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-1.5">
                Restricted Administration Lounge
            </p>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3.5 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700 text-xs flex items-center gap-2">
                <i data-lucide="check-circle" class="w-4 h-4 shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Email Field -->
            <div class="flex flex-col gap-2">
                <label for="email" class="text-[9px] font-bold text-slate-400 uppercase tracking-widest pl-1 font-sans">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </span>
                    <input type="email" name="email" id="email" required value="{{ old('email') }}" 
                           class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all font-sans"
                           placeholder="admin@rdcthecafe.com">
                </div>
                @error('email')
                    <span class="text-[10px] text-red-500 font-semibold mt-1 pl-1 font-sans">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="flex flex-col gap-2">
                <label for="password" class="text-[9px] font-bold text-slate-400 uppercase tracking-widest pl-1 font-sans">Secret Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                    </span>
                    <input type="password" name="password" id="password" required 
                           class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all font-sans"
                           placeholder="••••••••">
                </div>
                @error('password')
                    <span class="text-[10px] text-red-500 font-semibold mt-1 pl-1 font-sans">{{ $message }}</span>
                @enderror
            </div>

            <!-- Action Button -->
            <button type="submit" class="w-full mt-4 py-3.5 rounded-xl bg-linear-to-r from-indigo-500 via-amber-500 to-cyan-500 text-white font-heading text-xs font-black tracking-widest uppercase transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                Authenticate Entrance
            </button>
        </form>

        <!-- Back to main -->
        <div class="text-center mt-8">
            <a href="{{ route('home') }}" class="text-[10px] font-bold uppercase tracking-wider text-slate-400 hover:text-amber-500 transition-colors font-sans">
                &larr; Back to Lounge Front
            </a>
        </div>
    </div>

    <!-- Initialize Lucide -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
