@extends('layouts.admin')

@section('title', 'Modifier un livre')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <form action="{{ route('livres.update', $livre->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Titre</label>
            <input type="text" name="titre" class="w-full border rounded px-3 py-2" value="{{ $livre->titre }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Auteur</label>
            <input type="text" name="auteur" class="w-full border rounded px-3 py-2" value="{{ $livre->auteur }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Sujet</label>
            <input type="text" name="sujet" class="w-full border rounded px-3 py-2" value="{{ $livre->sujet }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Identifiant Unique</label>
            <input type="text" name="identifiant_unique" class="w-full border rounded px-3 py-2" value="{{ $livre->identifiant_unique }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Stock</label>
            <input type="number" name="stock" class="w-full border rounded px-3 py-2" value="{{ $livre->stock }}" required min="0">
        </div