@extends('layouts.admin')

@section('title', 'Gestion des abonnés')

@section('content')

<div class="bg-white p-6 rounded shadow">

    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-semibold">Liste des abonnés</h2>
        <a href="{{ route('abonnes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ajouter un abonné</a>
    </div>

    <!-- Formulaire de recherche -->
    <form method="GET" action="{{ route('abonnes.index') }}" class="mb-4 flex gap-4">
        <input type="text" name="search" placeholder="Rechercher par nom, prénom ou classe" value="{{ request('search') }}" class="border rounded px-3 py-2 w-1/3">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Rechercher</button>
        <a href="{{ route('abonnes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Réinitialiser</a>
    </form>

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nom</th>
                <th class="py-2 px-4 border-b">Prénom</th>
                <th class="py-2 px-4 border-b">Classe</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Début abonnement</th>
                <th class="py-2 px-4 border-b">Fin abonnement</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($abonnes as $abonne)
            <tr>
                <td class="py-2 px-4 border-b">{{ $abonne->nom }}</td>
                <td class="py-2 px-4 border-b">{{ $abonne->prenom }}</td>
                <td class="py-2 px-4 border-b">{{ $abonne->classe }}</td>
                <td class="py-2 px-4 border-b">{{ $abonne->email }}</td>
                <td class="py-2 px-4 border-b">{{ $abonne->date_debut_abonnement }}</td>
                <td class="py-2 px-4 border-b">{{ $abonne->date_fin_abonnement }}</td>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('abonnes.show', $abonne->id) }}" class="text-blue-600">Voir</a> |
                    <a href="{{ route('abonnes.edit', $abonne->id) }}" class="text-green-600">Modifier</a> |
                    <form action="{{ route('abonnes.destroy', $abonne->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600" onclick="return confirm('Supprimer cet abonné ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection