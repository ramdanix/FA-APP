<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use App\Models\Application;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function index()
    {
        $news = [
            [
                'id' => 1,
                'title' => 'Pengumuman Hasil Penerimaan Calon Asisten Praktikum Semester Ganjil 2026/2027',
                'snippet' => "Assalamu'alaikum Wr. Wb. Salam sejahtera bagi kita semua. Berdasarkan hasil seleksi administrasi dan wawancara untuk penerimaan anggota Forum Asisten...",
                'date' => 'Admin, 2 tahun yang lalu',
                'category' => 'Pengumuman',
                'image' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=400&h=200&auto=format&fit=crop'
            ],
            [
                'id' => 2,
                'title' => 'Jadwal Wawancara Calon Asisten Baru Tahap II',
                'snippet' => "Assalamu'alaikum Wr. Wb. Diinformasikan kepada seluruh calon Asisten Praktikum Semester Ganjil Tahun Akademik yang lolos tahap seleksi berkas...",
                'date' => 'Admin, 2 tahun yang lalu',
                'category' => 'Pengumuman',
                'image' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=400&h=200&auto=format&fit=crop'
            ],
            [
                'id' => 3,
                'title' => 'Workshop Web Development: Modern Frontend Tech',
                'snippet' => "Workshop eksklusif bersama para senior asisten membahas tuntas teknologi modern Laravel, PHP, dan Tailwind CSS...",
                'date' => 'Admin, 1 minggu yang lalu',
                'category' => 'Event',
                'image' => 'https://images.unsplash.com/photo-1587620962725-abab7fe55159?q=80&w=400&h=200&auto=format&fit=crop'
            ]
        ];

        return view('welcome', compact('news'));
    }

    public function assignments()
    {
        $assignments = Assignment::with('submissions')->latest()->get();
        return view('assignments.index', compact('assignments'));
    }

    public function submitAssignment(Request $request, $id)
    {
        $assignment = Assignment::findOrFail($id);

        $request->validate([
            'student_nim' => 'required|string',
            'student_name' => 'required|string',
            'file' => 'required|file|max:20480', // 20MB max
        ]);

        $path = $request->file('file')->store('submissions', 'public');

        Submission::create([
            'assignment_id' => $assignment->id,
            'student_nim' => $request->student_nim,
            'student_name' => $request->student_name,
            'course_name' => $assignment->course_name,
            'class_name' => $assignment->class_name,
            'file_path' => $path,
        ]);

        return back()->with('success', 'Tugas / Laprak berhasil dikumpulkan!');
    }

    public function registerForm()
    {
        return view('register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'nim' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'choice_division' => 'required|string',
            'motivation' => 'required|string',
        ]);

        Application::create($request->all());

        return back()->with('success', 'Pendaftaran calon asisten berhasil dikirim! Silakan pantau pengumuman selanjutnya.');
    }
}
