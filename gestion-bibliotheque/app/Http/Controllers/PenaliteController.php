<?php

namespace App\Http\Controllers;

use App\Models\Penalite;
use App\Models\Pret;
use Illuminate\Http\Request;

class PenaliteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Penalite::query();

        // Recherche sur l'abonné
        if ($request->filled('abonne')) {
            $query->whereHas('pret.abonne', function ($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->abonne . '%')
                ->orWhere('prenom', 'like', '%' . $request->abonne . '%');
            });
        }

        // Recherche sur le livre
        if ($request->filled('livre')) {
            $query->whereHas('pret.livre', function ($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->livre . '%');
            });
        }

        // On charge les relations pour l'affichage
        $penalites = $query->with('pret.abonne', 'pret.livre')->get();

        return view('penalites.index', compact('penalites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prets = Pret::with('abonne', 'livre')->get();
        return view('penalites.create', compact('prets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pret_id' => 'required|exists:prets,id',
            'montant' => 'required|numeric|min:0',
            'reglee' => 'required|boolean',
        ]);

        Penalite::create($request->all());

        return redirect()->route('penalites.index')->with('success', 'Pénalité créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penalite $penalite)
    {
        return view('penalites.show', compact('penalite'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penalite $penalite)
    {
        $prets = Pret::with('abonne', 'livre')->get();
        return view('penalites.edit', compact('penalite', 'prets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penalite $penalite)
    {
        $request->validate([
            'pret_id' => 'required|exists:prets,id',
            'montant' => 'required|numeric|min:0',
            'reglee' => 'required|boolean',
        ]);

        $penalite->update($request->all());

        return redirect()->route('penalites.index')->with('success', 'Pénalité mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penalite $penalite)
    {
        $penalite->delete();

        return redirect()->route('penalites.index')->with('success', 'Pénalité supprimée avec succès.');
    }

    public function regler(Penalite $penalite)
    {
        $penalite->update([
            'reglee' => true,
        ]);

        return redirect()->route('penalites.index')->with('success', 'Pénalité réglée avec succès.');
    }
}