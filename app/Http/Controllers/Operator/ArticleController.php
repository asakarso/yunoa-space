<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    // Tampilkan semua artikel
    public function index()
    {
        $operatorId = Auth::id();
        $articles = Article::where('operator_id', $operatorId)
                         ->latest('updated_at') 
                           ->get();

        return view('operator.index', compact('articles'));
    }

    // Tampilkan form tambah artikel
    public function create()
    {
        return view('operator.create');
    }

    // Simpan artikel baru
    public function store(Request $request)
    {
        $request->validate([
            'judul_artikel' => 'required|string|max:255',
            'tanggal_artikel' => 'required|date',
            'waktu_artikel' => 'required',
            'konten_artikel' => 'required',
            'gambar_cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $path = null;
        if ($request->hasFile('gambar_cover')) {
            $path = $request->file('gambar_cover')->store('artikel', 'public');
        }

        Article::create([
            'judul_artikel' => $request->judul_artikel,
            'tanggal_artikel' => $request->tanggal_artikel,
            'waktu_artikel' => $request->waktu_artikel,
            'operator_id' => Auth::id(),
            'konten_artikel' => $request->konten_artikel,
            'gambar_cover' => $path,
            'status' => $request->status,
        ]);

        return redirect()->route('operator.articles.index')->with('success', 'Article added successfully!');
    }

    //  Tampilkan form edit artikel
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        // Validasi kepemilikan
        if ($article->operator_id !== Auth::id()) {
            abort(403);
        }

        return view('operator.edit', compact('article'));
    }

    // Update artikel
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        if ($article->operator_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'judul_artikel' => 'required|string|max:255',
            'tanggal_artikel' => 'required|date',
            'waktu_artikel' => 'required',
            'konten_artikel' => 'required',
            'gambar_cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('gambar_cover')) {
            if ($article->gambar_cover) {
                Storage::disk('public')->delete($article->gambar_cover);
            }
            $article->gambar_cover = $request->file('gambar_cover')->store('artikel', 'public');
        }

        $article->update([
            'judul_artikel' => $request->judul_artikel,
            'tanggal_artikel' => $request->tanggal_artikel,
            'waktu_artikel' => $request->waktu_artikel,
            'konten_artikel' => $request->konten_artikel,
            'status' => $request->status,
            'gambar_cover' => $article->gambar_cover,
        ]);

        return redirect()->route('operator.articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    // 6. Hapus artikel
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ($article->operator_id !== Auth::id()) {
            abort(403);
        }

        if ($article->gambar_cover) {
            Storage::disk('public')->delete($article->gambar_cover);
        }

        $article->delete();

        return redirect()->route('operator.articles.index')->with('success', 'Article successfully deleted!');
    }
}
