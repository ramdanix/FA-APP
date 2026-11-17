<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Calon Asisten - Forum Asisten</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased min-h-screen flex flex-col justify-between">

    <div>
        <!-- Top Bar -->
        <div class="bg-slate-900 text-white py-2 px-6 text-[11px] font-semibold flex justify-between items-center">
            <span>Pendaftaran Anggota Baru</span>
            <a href="/" class="hover:text-pink-400 transition">← Kembali ke Beranda</a>
        </div>

        <!-- Header -->
        <header class="max-w-xl mx-auto px-6 py-16 text-center space-y-4">
            <span class="px-4 py-1 rounded-full text-xs font-bold bg-pink-100 text-pink-700 uppercase tracking-widest inline-block shadow-sm">
                Open Recruitment
            </span>
            <h1 class="text-4xl font-black tracking-tight text-slate-900">Pendaftaran Calon Asisten</h1>
            <p class="text-xs md:text-sm text-slate-600 max-w-md mx-auto">
                Bergabunglah bersama keluarga besar Forum Asisten Universitas Amikom Purwokerto dan kembangkan potensi terbaikmu.
            </p>
        </header>

        @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Pendaftaran Terkirim!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#2563eb',
                    customClass: { popup: 'rounded-2xl' }
                });
            });
        </script>
        @endif

        <!-- Form Container -->
        <main class="max-w-xl mx-auto px-6 pb-20">
            <div class="bg-white border border-slate-200/80 rounded-2xl p-8 shadow-sm">
                <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2">NIM Mahasiswa</label>
                        <input type="text" name="nim" placeholder="22.11.4567" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:bg-white focus:border-blue-600 outline-none transition" required />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2">Nama Lengkap & Gelar</label>
                        <input type="text" name="name" placeholder="Nama Lengkap" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:bg-white focus:border-blue-600 outline-none transition" required />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2">Email Mahasiswa</label>
                        <input type="email" name="email" placeholder="email@students.amikompurwokerto.ac.id" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:bg-white focus:border-blue-600 outline-none transition" required />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2">Nomor WhatsApp / HP</label>
                        <input type="text" name="phone" placeholder="081234567890" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:bg-white focus:border-blue-600 outline-none transition" required />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2">Pilihan Divisi Keahlian</label>
                        <select name="choice_division" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:bg-white focus:border-blue-600 outline-none transition" required>
                            <option value="Pemrograman">Divisi Pemrograman</option>
                            <option value="Multimedia">Divisi Multimedia</option>
                            <option value="Jaringan & Sistem Cerdas">Divisi Jaringan & Sistem Cerdas</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2">Motivasi Bergabung</label>
                        <textarea name="motivation" rows="4" placeholder="Tuliskan alasan dan motivasi Anda bergabung dengan Forum Asisten..." class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:bg-white focus:border-blue-600 outline-none transition" required></textarea>
                    </div>
                    <div class="pt-2">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider transition shadow-lg shadow-blue-600/30">
                            Kirim Pendaftaran Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-8 text-center text-xs text-slate-500">
        &copy; 2026 Forum Asisten • Universitas Amikom Purwokerto
    </footer>
</body>
</html>
