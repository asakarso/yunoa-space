<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Menampilkan halaman utama artikel (terpopuler, terbaru, dll.)
     */
    public function index(Request $request)
    {
        //  Mulai query hanya untuk artikel yang sudah 'published'
        $baseQuery = Article::where('status', 'published');

        if ($request->has('search') && $request->search != '') {
            $baseQuery->where(function ($query) use ($request) {
                $query->where('judul_artikel', 'like', '%' . $request->search . '%')
                      ->orWhere('konten_artikel', 'like', '%' . $request->search . '%');
            });
        }

        // --- Ambil Artikel Terpopuler ---
        $popularQuery = clone $baseQuery; 
        $popularArticles = $popularQuery->orderBy('view_count', 'desc')->take(5)->get();
        $mainArticle = $popularArticles->first();
        $sideArticles = $popularArticles->slice(1, 4); 
        $popularArticleIds = $popularArticles->pluck('id_review')->toArray();

        // --- Ambil Artikel Terbaru ---
        $latestArticlesQuery = clone $baseQuery;
        $latestArticles = $latestArticlesQuery->whereNotIn('id_review', $popularArticleIds)
                                            ->latest('tanggal_artikel')
                                            ->take(6)
                                            ->get();

        return view('articles.index', compact('mainArticle', 'sideArticles', 'latestArticles'));
    }

    /**
     * Menampilkan detail satu artikel
     */
    public function show($id)
    {
        // Cari artikel HANYA jika statusnya 'published'
        $article = Article::where('status', 'published')->findOrFail($id);
        
        // Naikkan view count setelah artikel ditemukan
        $article->increment('view_count');

        //  Ambil artikel terkait yang statusnya juga 'published'
        $relatedArticles = Article::where('status', 'published')
                                ->where('id_review', '!=', $id)
                                ->inRandomOrder()
                                ->take(5)
                                ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    /**
     * Menampilkan halaman "Lihat Semua" artikel dengan paginasi
     */
    public function all(Request $request)
    {
        // Mulai query hanya untuk artikel yang sudah 'published'
        $query = Article::where('status', 'published');

        // LOGIKA Untuk Menangani kata kunci pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('judul_artikel', 'like', '%' . $request->search . '%')
                  ->orWhere('konten_artikel', 'like', '%' . $request->search . '%');
            });
        }

        // Logika untuk filter kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        $articles = $query->latest('tanggal_artikel')->paginate(9);

        return view('articles.all', compact('articles'));
    }
}