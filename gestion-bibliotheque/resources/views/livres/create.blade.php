@extends('layouts.admin')

@section('title', 'Ajouter un livre')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <form action="{{ route('livres.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Titre</label>
            <input type="text" name="titre" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Auteur</label>
            <input type="text" name="auteur" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Sujet</label>
            <input type="text" name="sujet" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Identifiant Unique</label>
            <input type="text" name="identifiant_unique" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Stock</label>
            <input type="number" name="stock" class="w-full border rounded px-3 py-2" required min="0">
        </div>

        <div class="flex justify-end">
            <a href="{{ route('livres.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Annuler</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enregistrer</button>
        </div>
    </form>
</div>
@endsection