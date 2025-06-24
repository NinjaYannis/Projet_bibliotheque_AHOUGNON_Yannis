@extends('layouts.admin')

@section('title', 'Détails de la pénalité')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-semibold mb-4">Détails de la pénalité</h1>

    <div class="mb-4">
        <strong>Abonné:</strong> {{ $penalite->pret->abonne->nom }} {{ $penalite->pret->abonne->prenom }}
    </div>

    <div class="mb-4">
        <strong>Livre:</strong> {{ $penalite->pret->livre->titre }}
    </div>

    <div class="mb-4">
        <strong>Montant:</strong> {{ $penalite->montant }} FCFA
    </div>

    <div class="mb-4">
        <strong>Réglée:</strong> {{ $penalite->reglee ? 'Oui' : 'Non' }}
    </div>

    <div class="flex justify-end">
        <a href="{{ route('penalites.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Retour à la liste</a>
    </div>
</div>
@endsection