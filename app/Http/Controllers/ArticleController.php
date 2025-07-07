<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $baseQuery = Article::query();

        // Logika untuk menangani pencarian
        if ($request->has('search') && $request->search != '') {
            $baseQuery->where('judul_artikel', 'like', '%' . $request->search . '%')
                  ->orWhere('konten_artikel', 'like', '%' . $request->search . '%');
        }

        // --- 1. Ambil Artikel Terpopuler (berdasarkan view_count) ---
        $popularQuery = clone $baseQuery; // Clone agar tidak mengganggu query selanjutnya
        $popularArticles = $popularQuery->orderBy('view_count', 'desc')->take(5)->get();

        // Ambil artikel pertama sebagai artikel utama, sisanya untuk daftar samping
        $mainArticle = $popularArticles->first(); // Ambil 1 artikel teratas
        $sideArticles = $popularArticles->slice(1, 4); // Ambil 4 artikel berikutnya untuk samping

        // Ambil ID dari artikel populer agar tidak muncul lagi di "Artikel Terbaru"
        $popularArticleIds = $popularArticles->pluck('id_review')->toArray();

        // --- 2. Ambil Artikel Terbaru (berdasarkan tanggal) ---
        $latestArticlesQuery = clone $baseQuery;
        $latestArticles = $latestArticlesQuery->whereNotIn('id_review', $popularArticleIds) // Jangan tampilkan yang sudah populer
                                            ->orderBy('tanggal_artikel', 'desc')      // Urutkan dari yang paling BARU
                                            ->take(6)                                 // Ambil 6 untuk mengisi grid
                                            ->get();

        return view('articles.index', compact('mainArticle', 'sideArticles', 'latestArticles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        $article->increment('view_count');

        // Ambil 5 artikel lain secara acak sebagai artikel terkait
        // Pastikan untuk tidak mengambil artikel yang sedang dibuka
        $relatedArticles = Article::where('id_review', '!=', $id)
                                ->inRandomOrder()
                                ->take(5)
                                ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }


    public function all(Request $request)
    {
        $query = Article::query();

        // LOGIKA Untuk Menangani kata kunci pencarian
        if ($request->has('search') && $request->search != '') {
        $query->where('judul_artikel', 'like', '%' . $request->search . '%')
              ->orWhere('konten_artikel', 'like', '%' . $request->search . '%');
        }

        // Logika ini membuat halaman "Lihat Semua" juga bisa difilter
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Mengurutkan berdasarkan tanggal terbaru dan membaginya per halaman (9 artikel per halaman)
        $articles = $query->orderBy('tanggal_artikel', 'desc')->paginate(9);

        return view('articles.all', compact('articles'));
    }
}