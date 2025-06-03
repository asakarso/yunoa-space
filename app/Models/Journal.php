<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $table = 'journals';
    protected $primaryKey = 'id_jurnal';
    public $timestamps = false; // karena kamu tidak pakai created_at & updated_at

    protected $fillable = [
        'judul_jurnal',
        'tanggal_jurnal',
        'waktu_jurnal',
        'id_user',
        'konten_jurnal',
        'gambar_cover',
    ];

    // Relasi dengan User (jika kamu punya model User dan foreign key id_user)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}


// namespace App\Http\Controllers;

// use App\Models\Journal;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class JournalController extends Controller
// {
//     public function index()
//     {
//         $journals = Journal::where('id_user', Auth::user()->id_user)
//             ->orderByDesc('tanggal_jurnal')
//             ->get();

//         return view('journalsindex', compact('journals'));
//     }

//     public function create()
//     {
//         return view('journalscreate');
//     }

//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'judul_jurnal' => 'required|max:255',
//             'tanggal_jurnal' => 'required|date',
//             'waktu_jurnal' => 'required',
//             'konten_jurnal' => 'required',
//             'gambar_cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
//         ]);

//         if ($request->hasFile('gambar_cover')) {
//             $path = $request->file('gambar_cover')->store('journal_covers', 'public');
//             $validated['gambar_cover'] = $path;
//         }

//         $validated['id_user'] = Auth::user()->id_user;

//         Journal::create($validated);

//         return redirect()->route('journals.index')->with('success', 'Jurnal berhasil ditambahkan.');
//     }

//     public function show($id_jurnal)
//     {
//         $journal = Journal::where('id_jurnal', $id_jurnal)
//             ->where('id_user', Auth::user()->id_user)
//             ->firstOrFail();

//         return view('journalsshow', compact('journal'));
//     }

//     public function edit($id_jurnal)
//     {
//         $journal = Journal::where('id_jurnal', $id_jurnal)
//             ->where('id_user', Auth::user()->id_user)
//             ->firstOrFail();

//         return view('journalsedit', compact('journal'));
//     }

//     public function update(Request $request, $id_jurnal)
//     {
//         $journal = Journal::where('id_jurnal', $id_jurnal)
//             ->where('id_user', Auth::user()->id_user)
//             ->firstOrFail();

//         $validated = $request->validate([
//             'judul_jurnal' => 'required|max:255',
//             'tanggal_jurnal' => 'required|date',
//             'waktu_jurnal' => 'required',
//             'konten_jurnal' => 'required',
//             'gambar_cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
//         ]);

//         if ($request->hasFile('gambar_cover')) {
//             $path = $request->file('gambar_cover')->store('journal_covers', 'public');
//             $validated['gambar_cover'] = $path;
//         }

//         $journal->update($validated);

//         return redirect()->route('journals.index')->with('success', 'Jurnal berhasil diperbarui.');
//     }

//     public function destroy($id_jurnal)
//     {
//         $journal = Journal::where('id_jurnal', $id_jurnal)
//             ->where('id_user', Auth::user()->id_user)
//             ->firstOrFail();

//         $journal->delete();

//         return redirect()->route('journals.index')->with('success', 'Jurnal berhasil dihapus.');
//     }
// }
