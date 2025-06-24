@extends('layouts.admin')

@section('title', 'Détails du prêt')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-semibold mb-4">Détails du prêt</h1>

    <div class="mb-4">
        <strong>Abonné:</strong> {{ $pret->abonne->nom }} {{ $pret->abonne->prenom }}
    </div>

    <div class="mb-4">
        <strong>Livre:</strong> {{ $pret->livre->titre }}
    </div>

    <div class="mb-4">
        <strong>Date d'emprunt:</strong> {{ $pret->date_emprunt }}
    </div>

    <div class="mb-4">
        <strong>Date de retour prévue:</strong> {{ $pret->date_retour_prevue }}
    </div>

    <div class="mb-4">
        <strong>Date de retour effective:</strong> {{ $pret->date_retour_effective ?? 'Non retourné' }}
    </div>

    <div class="flex justify-end">
        <a href="{{ route('prets.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Retour à la liste</a>
    </div>
</div>
@endsection