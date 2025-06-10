<?php

namespace App\Http\Controllers\Api; // Pastikan namespace sudah benar

use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Untuk membuat slug
use Illuminate\Validation\Rule; // Untuk validasi unik saat update

class NewsArticleController extends Controller
{
    /**
     * Menampilkan daftar semua artikel berita.
     * GET /api/news-articles
     */
    public function index()
    {
        // Ambil artikel berita, diurutkan berdasarkan tanggal publikasi terbaru, dengan paginasi
        $newsArticles = NewsArticle::orderBy('publication_date', 'desc')->paginate(15); // 15 item per halaman
        return response()->json($newsArticles);
    }

    /**
     * Menyimpan artikel berita baru ke dalam database.
     * POST /api/news-articles
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        // Anda sangat disarankan menggunakan Form Request untuk validasi yang lebih kompleks dan bersih
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:news_articles,title', // Judul harus unik
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image_path' => 'nullable|string|max:2048', // Jika ini adalah path, atau validasi file jika mengunggah gambar
            'image_caption' => 'nullable|string|max:255',
            'author_name' => 'required|string|max:255',
            'publication_date' => 'required|date',
            'is_featured' => 'sometimes|boolean',
        ]);

        // Buat slug dari title
        $validatedData['slug'] = Str::slug($validatedData['title']);
        // Pastikan slug unik, tambahkan angka jika sudah ada (logika ini bisa diperkompleks)
        // Ini adalah pendekatan sederhana; untuk sistem produksi, pertimbangkan library slug yang lebih robust
        $originalSlug = $validatedData['slug'];
        $count = 1;
        while (NewsArticle::where('slug', $validatedData['slug'])->exists()) {
            $validatedData['slug'] = $originalSlug . '-' . $count++;
        }

        // Atur is_featured jika tidak ada dalam request (default ke false)
        $validatedData['is_featured'] = $request->input('is_featured', false);


        $newsArticle = NewsArticle::create($validatedData);

        return response()->json($newsArticle, 201); // 201 Created
    }

    /**
     * Menampilkan satu artikel berita spesifik.
     * GET /api/news-articles/{newsArticle}
     */
    public function show(NewsArticle $newsArticle) // Route Model Binding
    {
        // Anda bisa memuat relasi di sini jika diperlukan, misalnya komentar
        // $newsArticle->load('comments');
        return response()->json($newsArticle);
    }

    /**
     * Memperbarui artikel berita yang ada di database.
     * PUT/PATCH /api/news-articles/{newsArticle}
     */
    public function update(Request $request, NewsArticle $newsArticle) // Route Model Binding
    {
        $validatedData = $request->validate([
            // 'sometimes' berarti field ini hanya divalidasi jika ada dalam request
            'title' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('news_articles')->ignore($newsArticle->id), // Judul harus unik, kecuali untuk artikel ini sendiri
            ],
            'excerpt' => 'nullable|string',
            'content' => 'sometimes|required|string',
            'image_path' => 'nullable|string|max:2048',
            'image_caption' => 'nullable|string|max:255',
            'author_name' => 'sometimes|required|string|max:255',
            'publication_date' => 'sometimes|required|date',
            'is_featured' => 'sometimes|boolean',
        ]);

        // Jika title diupdate, update juga slug-nya
        if ($request->has('title') && $request->input('title') !== $newsArticle->title) {
            $validatedData['slug'] = Str::slug($validatedData['title']);
            $originalSlug = $validatedData['slug'];
            $count = 1;
            // Pastikan slug unik, kecuali untuk artikel ini sendiri
            while (NewsArticle::where('slug', $validatedData['slug'])->where('id', '!=', $newsArticle->id)->exists()) {
                $validatedData['slug'] = $originalSlug . '-' . $count++;
            }
        }

        // Atur is_featured jika ada dalam request, jika tidak, jangan ubah
        if ($request->has('is_featured')) {
            $validatedData['is_featured'] = $request->input('is_featured');
        }


        $newsArticle->update($validatedData);

        return response()->json($newsArticle);
    }

    /**
     * Menghapus artikel berita dari database.
     * DELETE /api/news-articles/{newsArticle}
     */
    public function destroy(NewsArticle $newsArticle) // Route Model Binding
    {
        // Pertimbangkan apa yang terjadi pada komentar terkait jika onDelete('cascade') tidak diatur di migrasi
        // $newsArticle->comments()->delete(); // Contoh menghapus komentar secara manual

        $newsArticle->delete();

        return response()->json(null, 204); // 204 No Content, menandakan berhasil dihapus
    }
}
