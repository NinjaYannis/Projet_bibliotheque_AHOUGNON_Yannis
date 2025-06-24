@extends('layouts.admin')

@section('title', 'Liste des pénalités')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-semibold mb-4">Liste des pénalités</h1>

    {{-- Formulaire de recherche --}}
    <form method="GET" action="{{ route('penalites.index') }}" class="mb-4 flex gap-4">
        <input type="text" name="abonne" value="{{ request('abonne') }}" placeholder="Nom de l'abonné" class="border rounded px-3 py-2">
        <input type="text" name="livre" value="{{ request('livre') }}" placeholder="Titre du livre" class="border rounded px-3 py-2">
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Rechercher</button>
    </form>

    <a href="{{ route('penalites.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Nouvelle pénalité</a>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="border px-4 py-2">Abonné</th>
                <th class="border px-4 py-2">Livre</th>
                <th class="border px-4 py-2">Montant</th>
                <th class="border px-4 py-2">Réglée</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penalites as $penalite)
            <tr>
                <td class="border px-4 py-2">
                    {{ $penalite->pret->abonne->nom }} {{ $penalite->pret->abonne->prenom }}
                </td>
                <td class="border px-4 py-2">{{ $penalite->pret->livre->titre }}</td>
                <td class="border px-4 py-2">{{ $penalite->montant }} FCFA</td>
                <td class="border px-4 py-2">{{ $penalite->reglee ? 'Oui' : 'Non' }}</td>
                <td class="border px-4 py-2 flex gap-2">
                    <a href="{{ route('penalites.show', $penalite) }}" class="bg-green-600 text-white px-3 py-1 rounded">Voir</a>
                    <a href="{{ route('penalites.edit', $penalite) }}" class="bg-purple-600 hover:bg-purple-500 text-black px-3 py-1 rounded shadow">Modifier</a>
                    <form action="{{ route('penalites.destroy', $penalite) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Supprimer</button>
                    </form>
                    @if (!$penalite->reglee)
                    <form action="{{ route('penalites.regler', $penalite) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded shadow">Régler</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection