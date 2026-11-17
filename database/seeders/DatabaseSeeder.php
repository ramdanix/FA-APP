<?php

namespace Database\Seeders;

use App\Models\Assignment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Assignment::create([
            'title' => 'Laporan Praktikum Pemrograman Web - Modul 1: Laravel Routing & Blade',
            'description' => 'Kumpulkan laporan praktikum lengkap dengan source code project dan screenshot hasil uji coba dalam bentuk PDF atau ZIP.',
            'course_name' => 'Pemrograman Web',
            'class_name' => '01, 02, 03',
            'allowed_extensions' => 'pdf,docx,zip,rar',
            'deadline' => Carbon::now()->addDays(7),
        ]);

        Assignment::create([
            'title' => 'Laporan Praktikum Jaringan Komputer - Modul 2: Subnetting & Routing',
            'description' => 'Buat laporan analisis topologi jaringan menggunakan Cisco Packet Tracer dan dokumentasikan dalam format PDF.',
            'course_name' => 'Jaringan Komputer',
            'class_name' => 'Semua Kelas',
            'allowed_extensions' => 'pdf,docx',
            'deadline' => Carbon::now()->addDays(5),
        ]);
    }
}
