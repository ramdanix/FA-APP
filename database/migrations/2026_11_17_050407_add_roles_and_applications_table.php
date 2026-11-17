<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('mahasiswa'); // mahasiswa, asisten, sdm, bendahara, sekretaris, ketua, super_admin, pendaftar
            }
            if (!Schema::hasColumn('users', 'nim')) {
                $table->string('nim')->nullable();
            }
            if (!Schema::hasColumn('users', 'class_name')) {
                $table->string('class_name')->nullable();
            }
        });

        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('choice_division'); // Pemrograman, Multimedia, Jaringan & Sistem Cerdas
            $table->text('motivation');
            $table->string('status')->default('pending'); // pending, accepted, rejected
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'nim', 'class_name']);
        });
    }
};
