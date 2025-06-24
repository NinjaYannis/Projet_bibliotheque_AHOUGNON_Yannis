@extends('layouts.admin')

@section('title', 'Liste des prêts')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-semibold mb-4">Liste des prêts</h1>

    <div class="flex justify-between mb-4">
        <a href="{{ route('prets.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Nouveau prêt</a>
        <a href="{{ route('prets.historique') }}" class="bg-purple-600 text-white px-4 py-2 rounded">Voir l'historique</a>
    </div>

    {{-- Formulaire de recherche --}}
    <form method="GET" action="{{ route('prets.index') }}" class="mb-4 flex gap-4">
        <input type="text" name="abonne" value="{{ request('abonne') }}" placeholder="Nom de l'abonné" class="border rounded px-3 py-2">
        <input type="text" name="livre" value="{{ request('livre') }}" placeholder="Titre du livre" class="border rounded px-3 py-2">
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Rechercher</button>
    </form>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="border px-4 py-2">Abonné</th>
                <th class="border px-4 py-2">Livre</th>
                <th class="border px-4 py-2">Date d'emprunt</th>
                <th class="border px-4 py-2">Retour prévu</th>
                <th class="border px-4 py-2">Retour effectif</th>
                <th class="border px-4 py-2">Pénalité</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prets as $pret)
            <tr>
                <td class="border px-4 py-2">{{ $pret->abonne->nom }} {{ $pret->abonne->prenom }}</td>
                <td class="border px-4 py-2">{{ $pret->livre->titre }}</td>
                <td class="border px-4 py-2">{{ $pret->date_emprunt }}</td>
                <td class="border px-4 py-2">{{ $pret->date_retour_prevue }}</td>
                <td class="border px-4 py-2">{{ $pret->date_retour_effective ?? 'Non retourné' }}</td>
                <td class="border px-4 py-2">
                    @php
                        $penalite = $pret->penalite ?? null;
                    @endphp

                    @if($penalite)
                        {{ $penalite->montant }} F CFA 
                        @if($penalite->reglee)
                            (Réglée)
                        @else
                            (Non réglée)
                        @endif
                    @else
                        Aucune
                    @endif
                </td>
                <td class="border px-4 py-2 flex gap-2">
                    <a href="{{ route('prets.show', $pret) }}" class="bg-green-600 text-white px-3 py-1 rounded">Voir</a>
                    <a href="{{ route('prets.edit', $pret) }}" class="bg-purple-600 text-white px-3 py-1 rounded">Modifier</a>
                    <form action="{{ route('prets.destroy', $pret) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Supprimer</button>
                    </form>

                    @if(is_null($pret->date_retour_effective))
                        <form action="{{ route('prets.retour', $pret) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-700 text-white px-3 py-1 rounded">Retour</button>
                        </form>
                    @elseif($penalite && !$penalite->reglee)
                        <form action="{{ route('penalites.regler', $penalite) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-purple-600 text-white px-3 py-1 rounded">Régler</button>
                        </form>
                    @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection