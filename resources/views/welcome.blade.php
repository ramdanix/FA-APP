<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Asisten - Universitas Amikom Purwokerto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased selection:bg-pink-500 selection:text-white">

    <!-- TOP NAVIGATION -->
    <nav class="sticky top-0 z-50 bg-white/85 backdrop-blur-md border-b border-slate-200/80 transition-all duration-300">
        <div class="max-w-6xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-tr from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center text-white font-black shadow-lg shadow-blue-500/30">
                    FA
                </div>
                <div>
                    <span class="font-black text-base tracking-tight block">FORUM ASISTEN</span>
                    <span class="text-[10px] text-slate-500 uppercase tracking-widest block font-bold">Amikom Purwokerto</span>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-8 text-xs font-bold uppercase tracking-wider text-slate-600">
                <a href="/" class="hover:text-blue-600 transition">Home</a>
                <a href="#about" class="hover:text-blue-600 transition">Tentang FA</a>
                <a href="/assignments" class="text-pink-600 hover:text-pink-700 transition">Pengumpulan Laprak</a>
                <a href="/register" class="hover:text-blue-600 transition">Daftar Asisten</a>
                <!-- Super Admin link removed from public view as requested -->
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <header class="relative overflow-hidden py-24 px-6 text-center bg-gradient-to-b from-white via-slate-50 to-blue-50/30">
        <div class="max-w-3xl mx-auto space-y-6 animate-fade-in">
            <span class="px-4 py-1.5 rounded-full text-xs font-bold bg-blue-100 text-blue-700 uppercase tracking-widest shadow-sm inline-block">
                Official Academic Portal
            </span>
            <h1 class="text-5xl md:text-6xl font-black text-slate-900 tracking-tight leading-tight">
                Welcome to <br/><span class="bg-gradient-to-r from-blue-600 via-indigo-600 to-pink-600 bg-clip-text text-transparent">Forum Asisten</span>
            </h1>
            <p class="text-sm md:text-base text-slate-600 max-w-xl mx-auto leading-relaxed">
                Wadah pengembangan diri, praktikum, riset teknologi, dan inovasi digital mahasiswa Universitas Amikom Purwokerto.
            </p>

            <div class="flex justify-center gap-4 pt-4">
                <a href="/assignments" class="px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-blue-600/30 transition transform hover:-translate-y-0.5">
                    Kumpul Tugas Laprak
                </a>
                <a href="/register" class="px-6 py-3.5 bg-white hover:bg-slate-100 border border-slate-300 text-slate-800 font-bold text-xs uppercase tracking-wider rounded-xl shadow-sm transition transform hover:-translate-y-0.5">
                    Daftar Asisten Baru
                </a>
            </div>

            <!-- App Banner -->
            <div class="mt-12 p-4 bg-white/80 backdrop-blur border border-slate-200 rounded-2xl max-w-lg mx-auto shadow-sm flex items-center justify-between gap-4 text-left">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 font-bold">📱</div>
                    <div>
                        <p class="text-xs font-bold text-slate-900">FA Access Mobile App</p>
                        <p class="text-[11px] text-slate-500">Akses jadwal & informasi lebih fleksibel.</p>
                    </div>
                </div>
                <a href="https://play.google.com/store/apps/details?id=fa.faccess.web" target="_blank" class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-[11px] font-bold tracking-wider transition">
                    Download
                </a>
            </div>
        </div>
    </header>

    <!-- MAIN CONTAINER -->
    <main class="max-w-5xl mx-auto px-6 py-16 space-y-24">
        
        <!-- FA NEWS -->
        <section class="space-y-8">
            <div class="flex justify-between items-end border-b border-slate-200 pb-4">
                <div>
                    <h2 class="text-2xl font-black uppercase tracking-tight text-slate-900">FA NEWS</h2>
                    <p class="text-xs text-slate-500 mt-1">Informasi dan pengumuman terbaru seputar kegiatan praktikum.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($news as $item)
                <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="relative overflow-hidden h-48 bg-slate-100">
                            <img src="{{ $item['image'] }}" class="w-full h-full object-cover transform hover:scale-105 transition duration-500" />
                            <span class="absolute top-3 left-3 px-3 py-1 bg-slate-900/80 backdrop-blur text-white text-[10px] font-bold uppercase tracking-wider rounded-full">
                                {{ $item['category'] }}
                            </span>
                        </div>
                        <div class="p-6 space-y-3">
                            <h3 class="font-bold text-slate-900 text-base leading-snug hover:text-blue-600 transition cursor-pointer">{{ $item['title'] }}</h3>
                            <p class="text-xs text-slate-600 leading-relaxed line-clamp-3">{{ $item['snippet'] }}</p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-0 flex justify-between items-center text-[11px] text-slate-400 border-t border-slate-100 mt-4">
                        <span>{{ $item['date'] }}</span>
                        <span class="font-bold text-blue-600 hover:underline cursor-pointer">Baca Selengkapnya →</span>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- STUDY WITH US -->
        <section id="about" class="space-y-8">
            <div class="border-b border-slate-200 pb-4">
                <h2 class="text-2xl font-black uppercase tracking-tight text-slate-900">STUDY WITH US</h2>
                <p class="text-xs text-slate-500 mt-1">Kenali lebih dalam divisi keahlian di Forum Asisten.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 bg-white border border-slate-200/80 rounded-2xl shadow-sm hover:border-blue-500 transition duration-300 space-y-4">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center font-black text-xl">💻</div>
                    <h3 class="font-bold text-lg text-slate-900">Divisi Pemrograman</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Wadah pengembangan software engineering, web & mobile development, serta kompetisi algoritma tingkat lanjut.</p>
                </div>
                <div class="p-8 bg-white border border-slate-200/80 rounded-2xl shadow-sm hover:border-pink-500 transition duration-300 space-y-4">
                    <div class="w-12 h-12 bg-pink-50 text-pink-600 rounded-xl flex items-center justify-center font-black text-xl">🎨</div>
                    <h3 class="font-bold text-lg text-slate-900">Divisi Multimedia</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Pusat kreativitas desain grafis, UI/UX interface design, video editing, motion graphics, dan produksi konten visual.</p>
                </div>
                <div class="p-8 bg-white border border-slate-200/80 rounded-2xl shadow-sm hover:border-indigo-500 transition duration-300 space-y-4">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center font-black text-xl">⚡</div>
                    <h3 class="font-bold text-lg text-slate-900">Divisi Jaringan & Sistem Cerdas</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Fokus pada infrastruktur server, cloud computing, keamanan siber, serta kecerdasan buatan (AI) & Internet of Things (IoT).</p>
                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="bg-slate-900 text-slate-400 py-16 border-t border-slate-800 text-xs">
        <div class="max-w-5xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10 mb-12">
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-pink-600 rounded-lg flex items-center justify-center text-white font-bold">FA</div>
                    <span class="font-black text-white text-sm tracking-tight">FORUM ASISTEN</span>
                </div>
                <p class="text-xs text-slate-400 leading-relaxed">Universitas Amikom Purwokerto. Pusat keunggulan akademik dan pengembangan teknologi informasi mahasiswa.</p>
            </div>
            <div>
                <h4 class="font-bold text-white text-xs uppercase tracking-widest mb-4">Navigasi Cepat</h4>
                <ul class="space-y-2 text-slate-400">
                    <li><a href="/" class="hover:text-white transition">Home Portal</a></li>
                    <li><a href="/assignments" class="hover:text-white transition">Pengumpulan Tugas Laprak</a></li>
                    <li><a href="/register" class="hover:text-white transition">Pendaftaran Anggota Baru</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-white text-xs uppercase tracking-widest mb-4">Media Sosial</h4>
                <div class="flex gap-4 text-sm">
                    <a href="https://www.instagram.com/forum_asisten/" target="_blank" class="w-10 h-10 bg-slate-800 hover:bg-pink-600 hover:text-white rounded-xl flex items-center justify-center transition">IG</a>
                    <a href="https://www.youtube.com/channel/UCNLpEZi6eNNoFMGlE6K_XbA" target="_blank" class="w-10 h-10 bg-slate-800 hover:bg-red-600 hover:text-white rounded-xl flex items-center justify-center transition">YT</a>
                </div>
            </div>
        </div>
        <div class="max-w-5xl mx-auto px-6 pt-8 border-t border-slate-800/80 text-center text-[11px] text-slate-500">
            &copy; 2026 Forum Asisten • Universitas Amikom Purwokerto. All rights reserved. Support by Divisi Pemrograman.
        </div>
    </footer>
</body>
</html>
