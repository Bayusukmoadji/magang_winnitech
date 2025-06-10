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
        Schema::create('news_articles', function (Blueprint $table) {
            $table->id(); // Kolom ID primary key auto-increment
            $table->string('title'); // Judul artikel
            $table->string('slug')->unique(); // Slug untuk URL, harus unik
            $table->text('excerpt')->nullable(); // Ringkasan singkat artikel
            $table->longText('content'); // Isi lengkap artikel
            $table->string('image_path')->nullable(); // Path ke gambar unggulan
            $table->string('image_caption')->nullable(); // Keterangan untuk gambar unggulan
            $table->string('author_name')->default('Admin Winntech'); // Nama penulis
            $table->timestamp('publication_date')->nullable(); // Tanggal publikasi
            $table->boolean('is_featured')->default(false); // Untuk menandai berita unggulan
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_articles');
    }
};
