@extends('layouts.admin')

@section('title', 'Détails du livre')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Détails du livre</h2>

    <div class="mb-4">
        <strong>Titre :</strong> {{ $livre->titre }}
    </div>

    <div class="mb-4">
        <strong>Auteur :</strong> {{ $livre->auteur }}
    </div>

    <div class="mb-4">
        <strong>Sujet :</strong> {{ $livre->sujet }}
    </div>

    <div class="mb-4">
        <strong>Identifiant Unique :</strong> {{ $livre->identifiant_unique }}
    </div>

    <div class="mb-4">
        <strong>Stock :</strong> {{ $livre->stock }}
    </div>

    <div class="flex justify-end">
        <a href="{{ route('livres.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Retour</a>
    </div>
</div>
@endsection