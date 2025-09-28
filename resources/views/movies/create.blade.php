@extends('layouts.app')

@section('content')
<h1>Adicionar Filme</h1>

<form method="POST" action="{{ route('movies.store') }}">
    @csrf
    <input type="text" name="title" placeholder="Título" required>
    <input type="text" name="director" placeholder="Diretor">
    <input type="number" name="year" placeholder="Ano">
    <input type="number" name="rating" placeholder="Nota (0-10)">
    
    <!-- Novo campo descrição -->
    <textarea name="description" placeholder="Descrição do filme"></textarea>
    
    <label><input type="checkbox" name="watched"> Assistido</label>
    <button>Salvar</button>
</form>
@endsection

