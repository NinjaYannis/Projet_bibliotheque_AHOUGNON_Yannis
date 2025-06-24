@extends('layouts.admin')

@section('title', 'Historique des prêts')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-semibold mb-4">Historique des prêts</h1>

    <a href="{{ route('prets.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Retour à la liste des prêts actifs</a>

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="border px-4 py-2">Abonné</th>
                <th class="border px-4 py-2">Livre</th>
                <th class="border px-4 py-2">Date d'emprunt</th>
                <th class="border px-4 py-2">Retour prévu</th>
                <th class="border px-4 py-2">Retour effectif</th>
                <th class="border px-4 py-2">Pénalité</th>
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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection