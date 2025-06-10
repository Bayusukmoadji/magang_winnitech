<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('launch_products', function (Blueprint $table) {
            $table->id(); // Kolom ID primary key auto-increment
            $table->string('title'); // Nama produk peluncuran
            $table->string('slug')->unique(); // Slug untuk URL, harus unik
            $table->string('company_name'); // Nama perusahaan
            $table->date('launch_date'); // Tanggal peluncuran
            $table->string('image_path')->nullable(); // Path ke gambar utama produk
            $table->text('short_description')->nullable(); // Deskripsi singkat untuk kartu di halaman daftar
            $table->longText('long_description')->nullable(); // Deskripsi lengkap untuk halaman detail
            $table->json('key_features')->nullable(); // Untuk menyimpan daftar fitur utama (sebagai JSON array)
            $table->json('technical_specifications')->nullable(); // Untuk menyimpan spesifikasi teknis (sebagai JSON array objek)
            $table->string('official_site_url')->nullable(); // URL ke situs resmi produk
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('launch_products');
    }
};
