@extends('layouts.admin')

@section('title', 'Modifier le prêt')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-semibold mb-4">Modifier le prêt</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('prets.update', $pret) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Abonné</label>
            <select name="abonne_id" class="w-full border rounded px-3 py-2" required>
                @foreach ($abonnes as $abonne)
                    <option value="{{ $abonne->id }}" {{ $pret->abonne_id == $abonne->id ? 'selected' : '' }}>
                        {{ $abonne->nom }} {{ $abonne->prenom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Livre</label>
            <select name="livre_id" class="w-full border rounded px-3 py-2" required>
                @foreach ($livres as $livre)
                    <option value="{{ $livre->id }}" {{ $pret->livre_id == $livre->id ? 'selected' : '' }}>
                        {{ $livre->titre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Date d'emprunt</label>
            <input type="date" name="date_emprunt" value="{{ $pret->date_emprunt }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Date de retour prévue</label>
            <input type="date" name="date_retour_prevue" value="{{ $pret->date_retour_prevue }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('prets.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Annuler</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enregistrer</button>
        </div>
    </form>
</div>
@endsection