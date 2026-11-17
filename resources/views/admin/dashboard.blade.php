<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Hub - Forum Asisten</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-slate-100 text-slate-800 font-sans text-sm flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-72 bg-slate-900 text-white p-6 flex flex-col justify-between shadow-xl">
        <div>
            <div class="flex items-center gap-3 mb-8 pb-4 border-b border-slate-800">
                <div class="w-10 h-10 bg-pink-600 rounded flex items-center justify-center font-bold text-lg">FA</div>
                <div>
                    <h1 class="font-bold text-base tracking-tight">Super Admin Hub</h1>
                    <p class="text-xs text-slate-400">FA Portal Control Panel</p>
                </div>
            </div>
            <nav class="space-y-1.5">
                <a href="/admin" class="w-full text-left py-2.5 px-3.5 rounded-lg text-xs font-semibold bg-pink-600 text-white shadow flex items-center gap-3">
                    <span>📚</span> Kelola Tugas & Laprak
                </a>
                <a href="#applicants" class="w-full text-left py-2.5 px-3.5 rounded-lg text-xs font-semibold hover:bg-white/5 text-slate-300 flex items-center gap-3">
                    <span>👥</span> Pendaftar Asisten
                </a>
            </nav>
        </div>

        <div class="pt-4 border-t border-slate-800">
            <a href="/" class="block mb-3 text-xs text-slate-400 hover:text-white transition">← Lihat Portal Publik</a>
            <a href="/assignments" class="block text-xs text-pink-400 hover:text-pink-300 transition">Portal Mahasiswa →</a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10 overflow-y-auto space-y-12">
        <header class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Super Admin Dashboard</h2>
                <p class="text-slate-500 text-xs mt-1">Buat tugas, pantau pengumpulan laprak, dan kelola pendaftar asisten.</p>
            </div>
        </header>

        @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#2563eb'
                });
            });
        </script>
        @endif

        <!-- Form Buat Tugas Baru -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
            <h3 class="font-bold text-sm text-slate-800 mb-4 uppercase tracking-wider">Buat Tugas / Laprak Baru</h3>
            <form action="{{ route('admin.assignments.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Judul Tugas / Laprak</label>
                    <input type="text" name="title" placeholder="Contoh: Laporan Praktikum Modul 1" class="w-full p-2.5 border border-slate-300 rounded-lg text-xs" required />
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Mata Kuliah</label>
                    <input type="text" name="course_name" placeholder="Contoh: Pemrograman Web" class="w-full p-2.5 border border-slate-300 rounded-lg text-xs" required />
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Kelas</label>
                    <input type="text" name="class_name" placeholder="Contoh: 01, 02, Semua Kelas" class="w-full p-2.5 border border-slate-300 rounded-lg text-xs" required />
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Format File Diizinkan (pdf,docx,zip,rar)</label>
                    <input type="text" name="allowed_extensions" value="pdf,docx,zip,rar" class="w-full p-2.5 border border-slate-300 rounded-lg text-xs" required />
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Deadline Waktu Pengumpulan</label>
                    <input type="datetime-local" name="deadline" class="w-full p-2.5 border border-slate-300 rounded-lg text-xs" required />
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold text-slate-600 mb-1">Deskripsi / Instruksi Tugas</label>
                    <textarea name="description" rows="3" placeholder="Instruksi pengerjaan..." class="w-full p-2.5 border border-slate-300 rounded-lg text-xs" required></textarea>
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white py-2.5 rounded-lg font-bold text-xs transition shadow">
                        Publikasikan Tugas Laprak
                    </button>
                </div>
            </form>
        </div>

        <!-- Pendaftar Asisten -->
        <div id="applicants" class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
            <h3 class="font-bold text-lg text-slate-900 mb-4">Daftar Pendaftar Calon Asisten Praktikum</h3>
            @if(isset($applications) && $applications->isEmpty())
            <div class="text-slate-400 text-xs py-4 text-center">
                Belum ada pendaftar calon asisten saat ini.
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-600 border-b border-slate-200">
                            <th class="p-3 font-bold">NIM</th>
                            <th class="p-3 font-bold">Nama</th>
                            <th class="p-3 font-bold">Kontak</th>
                            <th class="p-3 font-bold">Pilihan Divisi</th>
                            <th class="p-3 font-bold">Motivasi</th>
                            <th class="p-3 font-bold text-right">Waktu Daftar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($applications as $app)
                        <tr class="hover:bg-slate-50">
                            <td class="p-3 font-mono font-bold text-slate-700">{{ $app->nim }}</td>
                            <td class="p-3 font-bold text-slate-900">{{ $app->name }}<br/><span class="text-[10px] text-slate-400 font-normal">{{ $app->email }}</span></td>
                            <td class="p-3 text-slate-600">{{ $app->phone }}</td>
                            <td class="p-3 font-bold text-blue-600">{{ $app->choice_division }}</td>
                            <td class="p-3 text-slate-600 max-w-xs truncate">{{ $app->motivation }}</td>
                            <td class="p-3 text-right text-slate-500">{{ $app->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>

        <!-- Daftar Pengumpulan Mahasiswa -->
        <div class="space-y-6">
            <h3 class="font-bold text-lg text-slate-900 mb-4">Rekapitulasi Pengumpulan Tugas Mahasiswa</h3>

            @foreach($assignments as $item)
            <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
                <div class="flex justify-between items-start mb-4 pb-3 border-b border-slate-100">
                    <div>
                        <span class="text-[10px] font-bold bg-blue-100 text-blue-800 px-2 py-0.5 rounded mr-2">{{ $item->course_name }}</span>
                        <span class="text-[10px] font-bold bg-purple-100 text-purple-800 px-2 py-0.5 rounded">Kelas: {{ $item->class_name }}</span>
                        <h4 class="font-bold text-lg text-slate-900 mt-2">{{ $item->title }}</h4>
                    </div>
                    <span class="text-xs font-semibold text-slate-500">{{ $item->submissions->count() }} Pengumpulan</span>
                </div>

                @if($item->submissions->isEmpty())
                <div class="text-slate-400 text-xs py-4 text-center">
                    Belum ada mahasiswa yang mengumpulkan tugas ini.
                </div>
                @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="bg-slate-50 text-slate-600 border-b border-slate-200">
                                <th class="p-3 font-bold">NIM</th>
                                <th class="p-3 font-bold">Nama Mahasiswa</th>
                                <th class="p-3 font-bold">Mata Kuliah / Kelas</th>
                                <th class="p-3 font-bold">Waktu Upload</th>
                                <th class="p-3 font-bold text-right">File Laprak</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($item->submissions as $sub)
                            <tr class="hover:bg-slate-50">
                                <td class="p-3 font-mono font-bold text-slate-700">{{ $sub->student_nim }}</td>
                                <td class="p-3 font-bold text-slate-900">{{ $sub->student_name }}</td>
                                <td class="p-3 text-slate-600">{{ $sub->course_name }} ({{ $sub->class_name }})</td>
                                <td class="p-3 text-slate-500">{{ $sub->created_at->format('d M Y, H:i') }}</td>
                                <td class="p-3 text-right">
                                    <a href="{{ Storage::url($sub->file_path) }}" target="_blank" class="font-mono text-[11px] text-blue-600 bg-blue-50 px-2.5 py-1 rounded border border-blue-200 hover:underline">
                                        Download File
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </main>
</body>
</html>
