@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Meus Filmes</h1>

    <!-- Adicionar filme -->
    <a href="{{ route('movies.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4">
        + Adicionar Filme
    </a>

    <!-- Busca -->
    <form method="GET" action="{{ route('movies.index') }}" class="mb-6 flex gap-2">
        <input 
            type="text" 
            name="search" 
            placeholder="Buscar filme..." 
            value="{{ request('search') }}"
            class="border rounded px-2 py-1 flex-1"
        >
        <button class="bg-gray-700 text-white px-4 py-1 rounded hover:bg-gray-800">Buscar</button>
    </form>

    <!-- Lista de filmes -->
    <ul class="space-y-4">
    @php($busca = request('search'))
    @forelse($movies as $movie)
            <li class="border p-4 rounded shadow-sm flex flex-col md:flex-row md:justify-between md:items-center">
                <div class="flex-1">
                    <h2 class="text-xl font-semibold">{{ $movie->title }} ({{ $movie->year ?? '---' }})</h2>
                    <p class="text-gray-600">Diretor: {{ $movie->director ?? '---' }}</p>
                    <p class="mt-1">{{ $movie->description ?? 'Sem descrição' }}</p>
                    <p class="mt-1">{{ $movie->watched ? '✅ Assistido' : '❌ Não assistido' }}</p>
                    @if($movie->rating !== null)
                        <p>Nota: {{ $movie->rating }}/10</p>
                    @endif
                </div>

                <div class="flex flex-col md:flex-row md:items-center gap-2 mt-2 md:mt-0">
                    <!-- Marcar como assistido/não assistido -->
                    <form method="POST" action="{{ route('movies.update', $movie) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="watched" value="{{ $movie->watched ? 0 : 1 }}">
                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                            {{ $movie->watched ? '❌ Marcar não assistido' : '✅ Marcar assistido' }}
                        </button>
                    </form>

                    <!-- Editar -->
                    <a href="{{ route('movies.edit', $movie) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                        ✏️ Editar
                    </a>

                    <!-- Remover -->
                    <form method="POST" action="{{ route('movies.destroy', $movie) }}" onsubmit="return confirm('Tem certeza que deseja remover este filme?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">🗑️ Remover</button>
                    </form>
                </div>
            </li>
        @empty
            @if($busca)
                <li class="text-gray-500">Nenhum resultado para "{{ $busca }}".
                    <a href="{{ route('movies.index') }}" class="text-blue-600 underline ml-1">Limpar filtro</a>
                </li>
            @else
                <li class="text-gray-500">Nenhum filme cadastrado.</li>
            @endif
        @endforelse
    </ul>
</div>
@endsection
