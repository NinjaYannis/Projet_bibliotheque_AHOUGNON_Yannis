@extends('layouts.admin')

@section('title', 'Modifier un abonné')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <form action="{{ route('abonnes.update', $abonne->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Nom</label>
            <input type="text" name="nom" value="{{ $abonne->nom }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Prénom</label>
            <input type="text" name="prenom" value="{{ $abonne->prenom }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Classe</label>
            <input type="text" name="classe" value="{{ $abonne->classe }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ $abonne->email }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Date début abonnement</label>
            <input type="date" name="date_debut_abonnement" value="{{ $abonne->date_debut_abonnement }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Date fin abonnement</label>
            <input type="date" name="date_fin_abonnement" value="{{ $abonne->date_fin_abonnement }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('abonnes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Annuler</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection