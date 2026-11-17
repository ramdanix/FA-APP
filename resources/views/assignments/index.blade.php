<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Pengumpulan Tugas & Laprak - Forum Asisten</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased selection:bg-blue-600 selection:text-white min-h-screen flex flex-col justify-between">

    <div>
        <!-- Top Bar -->
        <div class="bg-slate-900 text-white py-2.5 px-6 text-xs font-semibold flex justify-between items-center shadow-inner">
            <span class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span> Portal Akademik Mahasiswa</span>
            <a href="/" class="hover:text-pink-400 transition">← Kembali ke Beranda</a>
        </div>

        <!-- Header -->
        <header class="max-w-3xl mx-auto px-6 py-12 text-center space-y-3">
            <span class="px-4 py-1.5 rounded-full text-xs font-bold bg-blue-100 text-blue-700 uppercase tracking-widest inline-block shadow-sm">
                E-Learning & Laprak
            </span>
            <h1 class="text-3xl md:text-4xl font-black tracking-tight text-slate-900">Form Pengumpulan Tugas Praktikum</h1>
            <p class="text-xs text-slate-600 max-w-md mx-auto">
                Masukkan NIM Anda untuk deteksi otomatis, lengkapi data, pilih mata kuliah, dan unggah laporan.
            </p>
        </header>

        @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Dikirim!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#2563eb',
                    customClass: { popup: 'rounded-2xl' }
                });
            });
        </script>
        @endif

        @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    text: "{{ $errors->first() }}",
                    confirmButtonColor: '#dc2626',
                    customClass: { popup: 'rounded-2xl' }
                });
            });
        </script>
        @endif

        <!-- Main Unified Form Container -->
        <main class="max-w-3xl mx-auto px-6 pb-24">
            <div class="bg-white border border-slate-200/90 rounded-3xl p-8 md:p-12 shadow-xl shadow-slate-200/50 space-y-8">
                @if($assignments->isEmpty())
                <div class="text-center text-slate-400 text-xs py-16">
                    Belum ada tugas praktikum aktif saat ini.
                </div>
                @else
                <form id="submissionForm" action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <!-- 1. NIM & Nama with Auto-Detect -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2">NIM Mahasiswa <span class="text-pink-600">*</span></label>
                            <input type="text" id="nimInput" name="student_nim" placeholder="Contoh: 22.11.4567 atau 22SA11001" class="w-full p-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:bg-white focus:border-blue-600 outline-none transition font-mono" required oninput="detectNimInfo(this.value)" />
                            <!-- Detection Badge -->
                            <div id="nimBadge" class="hidden mt-2 p-2.5 bg-blue-50 border border-blue-200 rounded-xl text-[11px] text-blue-800 font-medium flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                <span id="nimBadgeText">Terdeteksi: Angkatan 2022 • S1 Informatika</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2">Nama Lengkap & Gelar <span class="text-pink-600">*</span></label>
                            <input type="text" name="student_name" placeholder="Nama Mahasiswa" class="w-full p-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs focus:bg-white focus:border-blue-600 outline-none transition" required />
                        </div>
                    </div>

                    <!-- 2. Kelas Dropdown -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2">Kelas Praktikum <span class="text-pink-600">*</span></label>
                        <select name="class_name" class="w-full p-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold text-slate-800 focus:bg-white focus:border-blue-600 outline-none transition" required>
                            <option value="">-- Pilih Kelas Praktikum --</option>
                            @foreach(['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', 'A', 'B', 'C', 'D', 'E', 'F'] as $cls)
                            <option value="{{ $cls }}">Kelas {{ $cls }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- 3. Mata Kuliah & Pertemuan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2">Mata Kuliah <span class="text-pink-600">*</span></label>
                            <select id="assignmentSelect" name="assignment_id" class="w-full p-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold text-slate-800 focus:bg-white focus:border-blue-600 outline-none transition" required onchange="updateAssignmentDetails(this)">
                                <option value="">-- Pilih Mata Kuliah --</option>
                                @foreach($assignments as $item)
                                <option value="{{ $item->id }}" data-course="{{ $item->course_name }}" data-ext="{{ $item->allowed_extensions }}" data-desc="{{ $item->description }}" data-deadline="{{ \Carbon\Carbon::parse($item->deadline)->format('d M Y, H:i') }}">
                                    {{ $item->course_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2">Pertemuan Ke- <span class="text-pink-600">*</span></label>
                            <select name="meeting_session" class="w-full p-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-bold text-slate-800 focus:bg-white focus:border-blue-600 outline-none transition" required>
                                <option value="">-- Pilih Pertemuan --</option>
                                @for($i=1; $i<=14; $i++)
                                <option value="Pertemuan {{ $i }}">Pertemuan {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <!-- 4. Modern Box Upload File (Drag & Drop UI) -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-2">Upload File Laporan (<span id="labelExt" class="uppercase text-pink-600">PDF/DOCX/ZIP</span>) <span class="text-pink-600">*</span></label>
                        <div class="relative border-2 border-dashed border-slate-300 hover:border-blue-600 rounded-2xl p-8 text-center bg-slate-50/50 hover:bg-blue-50/30 transition cursor-pointer" onclick="document.getElementById('fileInput').click()">
                            <div class="space-y-2 pointer-events-none">
                                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl mx-auto flex items-center justify-center font-bold text-xl shadow-sm">📁</div>
                                <p class="text-xs font-bold text-slate-700" id="fileNameDisplay">Klik atau seret file Anda ke sini</p>
                                <p class="text-[10px] text-slate-400">Format diizinkan sesuai instruksi • Maksimal ukuran 20MB</p>
                            </div>
                            <input type="file" id="fileInput" name="file" class="hidden" required onchange="displayFileName(this)" />
                        </div>
                    </div>

                    <!-- 5. Detail Deskripsi Tugas di Bawah -->
                    <div id="assignmentInfo" class="hidden p-5 bg-slate-100 border border-slate-200 rounded-2xl text-xs text-slate-700 space-y-2">
                        <p class="font-bold text-slate-900 border-b border-slate-200 pb-1 flex items-center gap-2"><span>📌</span> Detail & Instruksi Tugas:</p>
                        <p><strong class="font-bold">Deskripsi:</strong> <span id="infoDesc"></span></p>
                        <p><strong class="font-bold">Format Diizinkan:</strong> <span id="infoExt" class="uppercase font-mono text-pink-600 font-bold"></span></p>
                        <p><strong class="font-bold">Deadline:</strong> <span id="infoDeadline" class="font-bold text-red-600"></span></p>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-bold text-xs uppercase tracking-wider transition shadow-lg shadow-blue-600/30 transform hover:-translate-y-0.5">
                            Kirim Tugas Laprak Sekarang
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </main>
    </div>

    <!-- Script to dynamically update form action and info & auto-detect NIM -->
    <script>
        function detectNimInfo(nim) {
            const badge = document.getElementById('nimBadge');
            const badgeText = document.getElementById('nimBadgeText');
            
            if (nim.length >= 2) {
                const yearCode = nim.substring(0, 2);
                const year = '20' + yearCode;
                
                let prodi = "Mahasiswa Amikom";
                if (nim.includes('11') || nim.toUpperCase().includes('SI')) {
                    prodi = "S1 Sistem Informasi";
                } else if (nim.includes('12') || nim.toUpperCase().includes('TI')) {
                    prodi = "S1 Informatika";
                } else if (nim.includes('31') || nim.toUpperCase().includes('TE')) {
                    prodi = "S1 Teknologi Informasi";
                } else if (nim.includes('51') || nim.toUpperCase().includes('MI')) {
                    prodi = "D3 Manajemen Informatika";
                }

                badgeText.innerText = `Terdeteksi: Angkatan ${year} • ${prodi}`;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        }

        function updateAssignmentDetails(select) {
            const opt = select.options[select.selectedIndex];
            const infoBox = document.getElementById('assignmentInfo');
            const form = document.getElementById('submissionForm');
            
            if (select.value) {
                form.action = `/assignments/${select.value}/submit`;
                document.getElementById('infoDesc').innerText = opt.getAttribute('data-desc');
                document.getElementById('infoExt').innerText = opt.getAttribute('data-ext');
                document.getElementById('infoDeadline').innerText = opt.getAttribute('data-deadline');
                document.getElementById('labelExt').innerText = opt.getAttribute('data-ext');
                document.getElementById('fileInput').accept = '.' + opt.getAttribute('data-ext').split(',').join(',.');
                infoBox.classList.remove('hidden');
            } else {
                form.action = '';
                infoBox.classList.add('hidden');
            }
        }

        function displayFileName(input) {
            const display = document.getElementById('fileNameDisplay');
            if (input.files && input.files[0]) {
                display.innerText = "File terpilih: " + input.files[0].name;
                display.classList.add('text-blue-600', 'font-extrabold');
            }
        }
    </script>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-8 text-center text-xs text-slate-500">
        &copy; 2026 Forum Asisten • Universitas Amikom Purwokerto
    </footer>
</body>
</html>
