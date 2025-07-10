<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::latest()->paginate(10);
        return view('films.index', compact('films'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'durasi' => 'required|integer',
            'sinopsis' => 'required|string'
        ]);

        Film::create($validated);

        return redirect()->route('films.index')
            ->with('success', 'Film berhasil ditambahkan!');
    }

    public function update(Request $request, Film $film)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'durasi' => 'required|integer',
            'sinopsis' => 'required|string'
        ]);

        $film->update($validated);

        return redirect()->route('films.index')
            ->with('success', 'Film berhasil diperbarui!');
    }

    public function destroy(Film $film)
    {
        $film->delete();

        return redirect()->route('films.index')
            ->with('success', 'Film berhasil dihapus!');
    }
}