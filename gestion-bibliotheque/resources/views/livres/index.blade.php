@extends('layouts.admin')

@section('title', 'Gestion des livres')

@section('content')
<div class="bg-white p-6 rounded shadow">

    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-semibold">Liste des livres</h2>
        <a href="{{ route('livres.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ajouter un livre</a>
    </div>

    {{-- Formulaire de recherche --}}
    <form action="{{ route('livres.index') }}" method="GET" class="mb-6">
        <div class="flex gap-4">
            <input type="text" name="titre" placeholder="Titre" value="{{ request('titre') }}" class="border px-4 py-2 rounded w-1/3">
            <input type="text" name="auteur" placeholder="Auteur" value="{{ request('auteur') }}" class="border px-4 py-2 rounded w-1/3">
            <input type="text" name="sujet" placeholder="Sujet" value="{{ request('sujet') }}" class="border px-4 py-2 rounded w-1/3">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Rechercher</button>
        </div>
    </form>

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Titre</th>
                <th class="py-2 px-4 border-b">Auteur</th>
                <th class="py-2 px-4 border-b">Sujet</th>
                <th class="py-2 px-4 border-b">Identifiant</th>
                <th class="py-2 px-4 border-b">Stock</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($livres as $livre)
            <tr>
                <td class="py-2 px-4 border-b">{{ $livre->titre }}</td>
                <td class="py-2 px-4 border-b">{{ $livre->auteur }}</td>
                <td class="py-2 px-4 border-b">{{ $livre->sujet }}</td>
                <td class="py-2 px-4 border-b">{{ $livre->identifiant_unique }}</td>
                <td class="py-2 px-4 border-b">{{ $livre->stock }}</td>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('livres.show', $livre->id) }}" class="text-blue-600">Voir</a> |
                    <a href="{{ route('livres.edit', $livre->id) }}" class="text-green-600">Modifier</a> |
                    <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600" onclick="return confirm('Supprimer ce livre ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection