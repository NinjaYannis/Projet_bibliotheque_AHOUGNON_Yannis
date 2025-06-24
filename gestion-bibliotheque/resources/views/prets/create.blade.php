@extends('layouts.admin')

@section('title', 'Nouveau prêt')

@section('content')

<div class="bg-white p-6 rounded shadow">  
    <h1 class="text-2xl font-semibold mb-4">Créer un nouveau prêt</h1>  @if ($errors->any())  
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">  
        <ul>  
            @foreach ($errors->all() as $error)  
                <li>{{ $error }}</li>  
            @endforeach  
        </ul>  
    </div>  
@endif  

<form action="{{ route('prets.store') }}" method="POST">  
    @csrf  

    <div class="mb-4">  
        <label class="block text-gray-700">Abonné</label>  
        <select name="abonne_id" class="w-full border rounded px-3 py-2" required>  
            <option value="">Sélectionner un abonné</option>  
            @foreach ($abonnes as $abonne)  
                <option value="{{ $abonne->id }}">{{ $abonne->nom }} {{ $abonne->prenom }}</option>  
            @endforeach  
        </select>  
    </div>  

    <div class="mb-4">  
        <label class="block text-gray-700">Livre</label>  
        <select name="livre_id" class="w-full border rounded px-3 py-2" required>  
            <option value="">Sélectionner un livre</option>  
            @foreach ($livres as $livre)  
                @php  
                    $pretEnCours = $livre->prets()->whereNull('date_retour_effective')->count();  
                    $disponible = $livre->stock - $pretEnCours;  
                @endphp  
                <option value="{{ $livre->id }}">  
                    {{ $livre->titre }} ({{ $disponible }} dispo sur {{ $livre->stock }})  
                </option>  
            @endforeach  
        </select>  
    </div>  

    <div class="mb-4">  
        <label class="block text-gray-700">Date d'emprunt</label>  
        <input type="date" name="date_emprunt" class="w-full border rounded px-3 py-2" required>  
    </div>  

    <div class="mb-4">  
        <label class="block text-gray-700">Date de retour prévue</label>  
        <input type="date" name="date_retour_prevue" class="w-full border rounded px-3 py-2" required>  
    </div>  

    <div class="flex justify-end">  
        <a href="{{ route('prets.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Annuler</a>  
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enregistrer</button>  
    </div>  
</form>

</div>  
@endsection