<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SATRIA TULUNGAGUNG | Sistem Administrasi Terpadu & Terintegrasi Ansor</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">


    <!-- Icon -->
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .text-gradient {
            background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .bg-gradient-mesh {
            background-color: #f8fafc;
            background-image:
                radial-gradient(at 0% 0%, hsla(158, 82%, 90%, 1) 0px, transparent 50%),
                radial-gradient(at 50% 100%, hsla(160, 84%, 85%, 1) 0px, transparent 50%),
                radial-gradient(at 100% 0%, hsla(155, 80%, 95%, 1) 0px, transparent 50%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body class="antialiased bg-slate-50 relative overflow-x-hidden">

    <!-- Background Decoration -->
    <div class="fixed inset-0 bg-gradient-mesh -z-10"></div>
    <div class="fixed top-[-10%] right-[-10%] w-[40rem] h-[40rem] bg-emerald-300/20 rounded-full blur-[100px] -z-10 animate-pulse"></div>
    <div class="fixed bottom-[-10%] left-[-10%] w-[35rem] h-[35rem] bg-teal-300/20 rounded-full blur-[80px] -z-10"></div>

    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300 px-6 py-4">
        <div class="max-w-7xl mx-auto glass-card rounded-full px-6 py-3 flex justify-between items-center shadow-lg shadow-emerald-900/5">
            <div class="flex items-center gap-3">
                <img src="{{ asset('img/logo.png') }}" class="h-10 w-auto" alt="Logo">
                <div class="leading-none">
                    <h1 class="font-black text-xl tracking-tight text-slate-800">SATRIA</h1>
                    <p class="text-[0.6rem] font-bold text-emerald-600 tracking-widest uppercase">Tulungagung</p>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-8">
                <a href="#filosofi" class="text-sm font-bold text-slate-500 hover:text-emerald-600 transition-colors">Filosofi</a>
                <a href="#fungsi" class="text-sm font-bold text-slate-500 hover:text-emerald-600 transition-colors">Fungsi</a>
                <a href="#kontak" class="text-sm font-bold text-slate-500 hover:text-emerald-600 transition-colors">Kontak</a>
            </div>

            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                @auth
                <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-slate-900 text-white rounded-full text-xs font-bold uppercase tracking-wider hover:bg-slate-800 transition shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="text-sm font-bold text-slate-800 hover:text-emerald-600 transition px-4">Masuk</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-full text-xs font-bold uppercase tracking-wider hover:shadow-lg hover:shadow-emerald-500/30 transition hover:-translate-y-0.5 transform">Daftar</a>
                @endif
                @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="min-h-screen flex flex-col justify-center items-center pt-32 pb-20 px-4 relative">
        <div class="max-w-5xl mx-auto text-center z-10 space-y-8">
            <div class="inline-block animate-fade-in-up">
                <span class="px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase tracking-[0.3em] border border-emerald-200 shadow-sm">
                    Revolusi Digital Organisasi
                </span>
            </div>

            <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-slate-900 leading-tight tracking-tight">
                SATRIA <br>
                <span class="text-gradient">TULUNGAGUNG</span>
            </h1>

            <p class="text-lg md:text-xl text-slate-600 max-w-2xl mx-auto font-medium leading-relaxed">
                <strong class="text-slate-800">Sistem Administrasi Terpadu & Terintegrasi Ansor</strong>.
                Langkah nyata transformasi digital GP Ansor Tulungagung menuju organisasi yang modern, mandiri, dan akuntabel.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center pt-6">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-slate-900 text-white rounded-2xl text-sm font-black uppercase tracking-widest shadow-xl hover:shadow-2xl hover:bg-black transition transform hover:-translate-y-1">
                    Gabung Sekarang
                </a>
                <a href="#filosofi" class="px-8 py-4 bg-white text-slate-800 border border-slate-200 rounded-2xl text-sm font-black uppercase tracking-widest shadow-lg hover:shadow-xl hover:border-emerald-200 transition transform hover:-translate-y-1">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>

        <!-- Float Elements -->
        <div class="absolute top-1/4 left-10 hidden lg:block animate-bounce-slow">
            <div class="glass-card p-4 rounded-2xl shadow-lg transform -rotate-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Data Tervalidasi</p>
                        <p class="text-[10px] text-slate-500">Real-time update</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-1/4 right-10 hidden lg:block animate-bounce-slow delay-700">
            <div class="glass-card p-4 rounded-2xl shadow-lg transform rotate-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Manajemen Unit</p>
                        <p class="text-[10px] text-slate-500">PC, PAC & Ranting</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filosofi & Makna -->
    <section id="filosofi" class="py-24 px-4 relative">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <span class="text-emerald-600 font-black tracking-widest text-sm uppercase">Identitas & Semangat</span>
                    <h2 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight">
                        Mengapa <span class="text-emerald-600">SATRIA?</span>
                    </h2>
                    <p class="text-slate-600 text-lg leading-relaxed">
                        Nama <strong>SATRIA</strong> bukan sekadar singkatan, melainkan representasi dari jiwa kader Ansor.
                    </p>

                    <div class="space-y-6">
                        <div class="glass-card p-6 rounded-3xl border-l-4 border-emerald-500 hover:shadow-lg transition-all">
                            <h3 class="font-bold text-xl text-slate-800 mb-2">Filosofi Nama</h3>
                            <p class="text-slate-600">
                                <strong>SATRIA</strong> adalah akronim dari <em>Sistem Administrasi Terpadu & Terintegrasi Ansor</em>.
                                Sebuah sistem yang dirancang untuk menyatukan gerak langkah organisasi dalam satu komando data.
                            </p>
                        </div>

                        <div class="glass-card p-6 rounded-3xl border-l-4 border-yellow-400 hover:shadow-lg transition-all">
                            <h3 class="font-bold text-xl text-slate-800 mb-2">Makna Simbolis</h3>
                            <p class="text-slate-600">
                                "Satria" melambangkan karakter kader Ansor yang <strong>gagah berani, tangguh, dan setia</strong>.
                                Selalu siap di garis terdepan menjaga Ulama, Habaib, dan keutuhan NKRI.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-emerald-500 to-teal-400 rounded-[3rem] rotate-6 opacity-20 blur-2xl"></div>
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Teamwork" class="relative rounded-[3rem] shadow-2xl grayscale hover:grayscale-0 transition-all duration-700 object-cover h-[500px] w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Fungsi Utama -->
    <section id="fungsi" class="py-24 bg-slate-900 text-white rounded-t-[4rem] relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>

        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20 animate-on-scroll">
                <span class="text-emerald-400 font-bold tracking-[0.2em] text-xs uppercase mb-4 block">Core Features</span>
                <h2 class="text-3xl md:text-5xl font-black mb-6">4 Pilar Fungsi Utama</h2>
                <p class="text-slate-400 text-lg">SATRIA TULUNGAGUNG hadir dengan empat pilar utama untuk memperkuat fondasi organisasi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-slate-800/50 backdrop-blur-sm p-8 rounded-[2rem] border border-slate-700 hover:border-emerald-500/50 hover:bg-slate-800 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-emerald-500/20 rounded-2xl flex items-center justify-center text-emerald-400 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 group-hover:text-emerald-400 transition-colors">Administrasi Terpadu</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Mengintegrasikan data anggota, struktur unit, dan surat-menyurat dalam satu ekosistem digital yang terpusat.</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-slate-800/50 backdrop-blur-sm p-8 rounded-[2rem] border border-slate-700 hover:border-emerald-500/50 hover:bg-slate-800 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-blue-500/20 rounded-2xl flex items-center justify-center text-blue-400 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 group-hover:text-blue-400 transition-colors">Efisiensi & Akurasi</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Memangkas birokrasi, mempercepat proses administratif, dan menjamin validitas data setiap kader.</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-slate-800/50 backdrop-blur-sm p-8 rounded-[2rem] border border-slate-700 hover:border-emerald-500/50 hover:bg-slate-800 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-purple-500/20 rounded-2xl flex items-center justify-center text-purple-400 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 group-hover:text-purple-400 transition-colors">Digitalisasi Gerakan</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Menjawab tantangan zaman dengan transformasi digital. Menjadikan Ansor organisasi yang modern dan adaptif.</p>
                </div>

                <!-- Card 4 -->
                <div class="bg-slate-800/50 backdrop-blur-sm p-8 rounded-[2rem] border border-slate-700 hover:border-emerald-500/50 hover:bg-slate-800 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-yellow-500/20 rounded-2xl flex items-center justify-center text-yellow-400 mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 group-hover:text-yellow-400 transition-colors">Kemandirian Organisasi</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Memperkuat basis data potensi kader untuk pengembangan kemandirian ekonomi dan organisasi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="kontak" class="bg-white pt-20 pb-10 px-4 mt-[-4rem] rounded-t-[4rem] relative z-20">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6 pb-10 border-b border-gray-100">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('img/logo.png') }}" class="h-16 w-auto grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition-all" alt="Logo">
                    <div>
                        <h4 class="font-black text-slate-800 text-lg uppercase">PC GP Ansor</h4>
                        <p class="text-slate-500 text-sm">Kabupaten Tulungagung</p>
                    </div>
                </div>
                <div class="flex gap-6">
                    <a href="#" class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-500 hover:bg-emerald-600 hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-500 hover:bg-rose-600 hover:text-white transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="text-center pt-8">
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">
                    &copy; {{ date('Y') }} SATRIA TULUNGAGUNG. All Rights Reserved.
                </p>
            </div>
        </div>
    </footer>

    <style>
        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(-5%) rotate(6deg);
            }

            50% {
                transform: translateY(5%) rotate(6deg);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 6s infinite ease-in-out;
        }
    </style>

</body>

</html>