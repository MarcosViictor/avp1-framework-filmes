<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{

    public function index(Request $request)
{
    $query = Auth::user()->movies()->orderByDesc('created_at');

    $search = trim($request->get('search', ''));
    if ($search !== '') {
        // Buscar em múltiplos campos
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%$search%")
              ->orWhere('director', 'like', "%$search%")
              ->orWhere('description', 'like', "%$search%")
              ->orWhere('year', 'like', "%$search%");
        });
    }

    $movies = $query->get();

    return view('movies.index', [
        'movies' => $movies,
        'search' => $search,
    ]);
}

public function create()
{
    return view('movies.create');
}

public function store(Request $request)
{
  $request->validate([
    'title' => 'required|string|max:255',
    'director' => 'nullable|string|max:255',
    'year' => 'nullable|integer|min:1900|max:' . date('Y'),
    'rating' => 'nullable|integer|min:0|max:10',
    'description' => 'nullable|string',
]);

    Auth::user()->movies()->create($request->all());

    return redirect()->route('movies.index')->with('success', 'Filme adicionado!');
}

public function edit(Movie $movie)
{
    if ($movie->user_id !== Auth::id()) {
        abort(403);
    }
    return view('movies.edit', compact('movie'));
}

public function update(Request $request, Movie $movie)
{
    if ($movie->user_id !== Auth::id()) {
        abort(403);
    }

    // Se estiver apenas alterando o status de assistido
    if ($request->has('watched') && count($request->all()) <= 3) { // _token, _method, watched
        $movie->update($request->only('watched'));
        return redirect()->route('movies.index')->with('success', 'Status atualizado!');
    }

    // Caso contrário, validar todos os campos
    $request->validate([
        'title' => 'required|string|max:255',
        'director' => 'nullable|string|max:255',
        'year' => 'nullable|integer|min:1900|max:' . date('Y'),
        'rating' => 'nullable|integer|min:0|max:10',
        'description' => 'nullable|string',
    ]);

    $movie->update($request->only(['title', 'director', 'year', 'rating', 'description', 'watched']));

    return redirect()->route('movies.index')->with('success', 'Filme atualizado!');
}

public function destroy(Movie $movie)
{
    if ($movie->user_id !== Auth::id()) {
        abort(403);
    }
    $movie->delete();

    return redirect()->route('movies.index')->with('success', 'Filme removido!');
}

}
