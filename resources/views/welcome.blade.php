<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Satu Ansor') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png?v=1') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo.png?v=1') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo.png?v=1') }}">
    <link rel="shortcut icon" href="{{ asset('img/logo.png?v=1') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            emerald: {
                                50: '#ecfdf5',
                                100: '#d1fae5',
                                200: '#a7f3d0',
                                300: '#6ee7b7',
                                400: '#34d399',
                                500: '#10b981',
                                600: '#059669',
                                700: '#047857',
                                800: '#065f46',
                                900: '#064e3b',
                                950: '#022c22',
                            },
                        },
                        fontFamily: {
                            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        }
                    }
                }
            }
        </script>
    @endif

    <style>
        /* Pattern Batik Kawung (Halus) */
        .bg-batik {
            background-color: #ecfdf5; /* Emerald-50 */
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23059669' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        /* Efek Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-batik text-emerald-950 min-h-screen flex flex-col antialiased selection:bg-emerald-200 selection:text-emerald-900 overflow-x-hidden">

    <nav class="w-full fixed top-0 z-50 glass transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <a href="/" class="flex items-center gap-3 group">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo GP Ansor" class="h-10 w-auto object-contain group-hover:scale-105 transition-transform duration-300 drop-shadow-sm">
                    <div class="font-extrabold text-lg tracking-tight text-emerald-900 group-hover:text-emerald-700 transition-colors leading-tight">
                        ANSOR<br><span class="text-emerald-600 font-bold text-sm tracking-widest">TULUNGAGUNG</span>
                    </div>
                </a>
            </div>

            <div class="hidden md:flex items-center gap-8 text-[14px] font-bold text-emerald-800 tracking-wide">
                <a href="#" class="relative hover:text-emerald-600 transition-colors after:content-[''] after:absolute after:w-full after:scale-x-0 after:h-0.5 after:bottom-[-4px] after:left-0 after:bg-emerald-500 after:origin-bottom-right after:transition-transform after:duration-300 hover:after:scale-x-100 hover:after:origin-bottom-left">HOME</a>
                <a href="#" class="relative hover:text-emerald-600 transition-colors after:content-[''] after:absolute after:w-full after:scale-x-0 after:h-0.5 after:bottom-[-4px] after:left-0 after:bg-emerald-500 after:origin-bottom-right after:transition-transform after:duration-300 hover:after:scale-x-100 hover:after:origin-bottom-left">BERITA</a>
                <a href="#" class="relative hover:text-emerald-600 transition-colors after:content-[''] after:absolute after:w-full after:scale-x-0 after:h-0.5 after:bottom-[-4px] after:left-0 after:bg-emerald-500 after:origin-bottom-right after:transition-transform after:duration-300 hover:after:scale-x-100 hover:after:origin-bottom-left">AGENDA</a>
                <a href="#" class="relative hover:text-emerald-600 transition-colors after:content-[''] after:absolute after:w-full after:scale-x-0 after:h-0.5 after:bottom-[-4px] after:left-0 after:bg-emerald-500 after:origin-bottom-right after:transition-transform after:duration-300 hover:after:scale-x-100 hover:after:origin-bottom-left">GALERI</a>
            </div>

            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 rounded-full bg-emerald-600 text-white text-sm font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-600/30 hover:-translate-y-0.5">
                            Dashboard
                        </a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('login') }}" class="group relative px-6 py-2.5 rounded-full bg-gradient-to-r from-emerald-600 to-emerald-500 text-white text-sm font-bold hover:from-emerald-700 hover:to-emerald-600 transition-all shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-0.5 overflow-hidden">
                                <span class="relative z-10">Portal Internal</span>
                                <div class="absolute inset-0 h-full w-full scale-0 rounded-full transition-all duration-300 group-hover:scale-100 group-hover:bg-emerald-700/20"></div>
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center px-6 relative pt-24 pb-12">
        
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
            <div class="absolute top-[10%] left-[-10%] w-[600px] h-[600px] bg-emerald-200/40 rounded-full blur-[120px] mix-blend-multiply animate-pulse" style="animation-duration: 8s;"></div>
            <div class="absolute bottom-[10%] right-[-10%] w-[500px] h-[500px] bg-emerald-300/30 rounded-full blur-[100px] mix-blend-multiply animate-pulse" style="animation-duration: 10s;"></div>
        </div>

        <div class="w-full max-w-5xl mx-auto text-center relative z-10 py-12 md:py-20">
            
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/60 border border-emerald-200/50 text-emerald-700 text-[10px] font-bold tracking-[0.2em] uppercase mb-8 shadow-sm backdrop-blur-sm hover:bg-white/80 transition-colors cursor-default">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping absolute opacity-75"></span>
                <span class="w-2 h-2 rounded-full bg-emerald-500 relative"></span>
                Official Digital Platform
            </div>

            <div class="mb-8 space-y-1">
                <h1 class="text-6xl md:text-8xl font-black tracking-tighter text-emerald-950 leading-[0.9] drop-shadow-sm">
                    Traffic Ansor
                </h1>
                <h1 class="text-6xl md:text-8xl font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 via-emerald-600 to-emerald-800 italic pr-2">
                    Masa Depan
                </h1>
            </div>

            <p class="max-w-2xl mx-auto text-lg md:text-xl text-emerald-800/70 mb-10 leading-relaxed font-medium">
                Sahabat Tulungagung Applications (SATU Aplikasi) adalah Platform Digital yang Mengintegrasikan Pelayanan Program GP Ansor Tulungagung.
            </p>

            <div class="flex flex-wrap justify-center gap-4 md:gap-6 text-xs font-bold text-emerald-600 mb-12 uppercase tracking-widest">
                <span class="px-3 py-1 bg-emerald-100/50 rounded-lg">#ansortulungagung</span>
                <span class="px-3 py-1 bg-emerald-100/50 rounded-lg">#trafficansormasadepan</span>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="#" class="group w-full sm:w-auto px-8 py-4 bg-white text-emerald-900 font-bold rounded-2xl shadow-[0_4px_20px_rgb(0,0,0,0.05)] border border-emerald-100/50 hover:border-emerald-300 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3">
                    <span>Eksplorasi Berita</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-emerald-500 group-hover:translate-x-1 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="#" class="w-full sm:w-auto px-8 py-4 bg-emerald-700 text-white font-bold rounded-2xl shadow-xl shadow-emerald-700/30 hover:bg-emerald-800 hover:shadow-emerald-700/50 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                    Lihat Agenda
                </a>
            </div>
        </div>
    </main>

    <footer class="w-full text-center py-8 relative z-10">
        <div class="border-t border-emerald-100 max-w-xs mx-auto mb-6"></div>
        <p class="text-emerald-800/40 text-[10px] font-bold tracking-[0.2em] uppercase hover:text-emerald-600 transition-colors cursor-default">
            &copy; {{ date('Y') }} GP Ansor Tulungagung
        </p>
    </footer>

</body>
</html>