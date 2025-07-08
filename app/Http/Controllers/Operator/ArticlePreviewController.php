<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class ArticlePreviewController extends Controller
{
    // Menampilkan semua artikel milik operator (boleh draft & published)
    public function index()
    {
        $operatorId = Auth::id();

        $articles = Article::where('operator_id', $operatorId)
                           ->orderBy('created_at', 'desc')
                           ->get();

        return view('operator.preview.index', compact('articles'));
    }

    // Menampilkan detail artikel (preview)
    public function show($id)
    {
        $operatorId = Auth::id();

        $article = Article::where('id_review', $id)
                          ->where('operator_id', $operatorId)
                          ->firstOrFail();

        return view('operator.preview.show', compact('article'));
    }
}
