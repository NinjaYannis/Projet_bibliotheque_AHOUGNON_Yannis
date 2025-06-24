@extends('layouts.admin')

@section('title', 'Détails de l\'abonné')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="mb-4">
        <h2 class="text-xl font-semibold">Informations de l'abonné</h2>
    </div>

    <div class="mb-4">
        <strong>Nom :</strong> {{ $abonne->nom }}
    </div>

    <div class="mb-4">
        <strong>Prénom :</strong> {{ $abonne->prenom }}
    </div>

    <div class="mb-4">
        <strong>Classe :</strong> {{ $abonne->classe }}
    </div>

    <div class="mb-4">
        <strong>Email :</strong> {{ $abonne->email }}
    </div>

    <div class="mb-4">
        <strong>Début abonnement :</strong> {{ $abonne->date_debut_abonnement }}
    </div>

    <div class="mb-4">
        <strong>Fin abonnement :</strong> {{ $abonne->date_fin_abonnement }}
    </div>

    <div class="flex justify-end">
        <a href="{{ route('abonnes.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Retour à la liste</a>
    </div>
</div>
@endsection