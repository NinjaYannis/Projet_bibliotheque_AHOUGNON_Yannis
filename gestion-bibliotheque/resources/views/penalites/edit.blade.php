@extends('layouts.admin')

@section('title', 'Modifier la pénalité')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-semibold mb-4">Modifier la pénalité</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penalites.update', $penalite) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Prêt concerné</label>
            <select name="pret_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Sélectionner un prêt</option>
                @foreach ($prets as $pret)
                    <option value="{{ $pret->id }}" {{ $pret->id == $penalite->pret_id ? 'selected' : '' }}>
                        {{ $pret->abonne->nom }} {{ $pret->abonne->prenom }} - {{ $pret->livre->titre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Montant</label>
            <input type="number" name="montant" class="w-full border rounded px-3 py-2" value="{{ $penalite->montant }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Réglée</label>
            <select name="reglee" class="w-full border rounded px-3 py-2" required>
                <option value="0" {{ !$penalite->reglee ? 'selected' : '' }}>Non</option>
                <option value="1" {{ $penalite->reglee ? 'selected' : '' }}>Oui</option>
            </select>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('penalites.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Annuler</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection