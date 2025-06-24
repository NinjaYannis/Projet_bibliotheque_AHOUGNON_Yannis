<?php

namespace App\Http\Controllers;

use App\Models\Pret;
use App\Models\Abonne;
use App\Models\Livre;
use App\Models\Penalite;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PretController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = \App\Models\Pret::where(function($query) {
            $query->whereNull('date_retour_effective')
                ->orWhereHas('penalite', function($q) {
                    $q->where('reglee', false);
                });
        });

        // Recherche sur nom ou prénom de l'abonné
        if ($request->filled('abonne')) {
            $query->whereHas('abonne', function ($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->abonne . '%')
                ->orWhere('prenom', 'like', '%' . $request->abonne . '%');
            });
        }

        // Recherche sur le titre du livre
        if ($request->filled('livre')) {
            $query->whereHas('livre', function ($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->livre . '%');
            });
        }

        $prets = $query->get();

        return view('prets.index', compact('prets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $abonnes = Abonne::all();
        $livres = Livre::all();
        return view('prets.create', compact('abonnes', 'livres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'abonne_id' => 'required|exists:abonnes,id',
            'livre_id' => 'required|exists:livres,id',
            'date_emprunt' => 'required|date',
            'date_retour_prevue' => 'required|date|after_or_equal:date_emprunt',
        ]);

        // Vérifier si l'abonné a déjà 3 prêts actifs
        $pretsActifs = Pret::where('abonne_id', $request->abonne_id)
                            ->whereNull('date_retour_effective')
                            ->count();

        if ($pretsActifs >= 3) {
            return redirect()->back()->withErrors(['abonne_id' => 'Cet abonné a déjà atteint la limite de 3 prêts actifs.']);
        }

        // Vérifier si le même livre est déjà emprunté par cet abonné sans retour
        $pretExistant = Pret::where('abonne_id', $request->abonne_id)
                            ->where('livre_id', $request->livre_id)
                            ->whereNull('date_retour_effective')
                                ->exists();

        if ($pretExistant) {
            return redirect()->back()->withErrors(['livre_id' => 'Cet abonné a déjà un exemplaire de ce livre en cours de prêt.']);
        }

        // Vérifier la disponibilité du stock
        $livre = \App\Models\Livre::findOrFail($request->livre_id);

        $pretEnCours = Pret::where('livre_id', $livre->id)
                            ->whereNull('date_retour_effective')
                            ->count();

        $exemplairesDisponibles = $livre->stock - $pretEnCours;

        if ($exemplairesDisponibles <= 0) {
            return redirect()->back()->withErrors(['livre_id' => 'Aucun exemplaire disponible actuellement pour ce livre.']);
        }

        // Tout est bon, on peut créer le prêt
        Pret::create($request->all());

        return redirect()->route('prets.index')->with('success', 'Prêt ajouté avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Pret $pret)
    {
        return view('prets.show', compact('pret'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pret $pret)
    {
        $abonnes = Abonne::all();
        $livres = Livre::all();
        return view('prets.edit', compact('pret', 'abonnes', 'livres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pret $pret)
    {
        $request->validate([
            'abonne_id' => 'required|exists:abonnes,id',
            'livre_id' => 'required|exists:livres,id',
            'date_emprunt' => 'required|date',
            'date_retour_prevue' => 'required|date|after_or_equal:date_emprunt',
        ]);

        $pret->update([
            'abonne_id' => $request->abonne_id,
            'livre_id' => $request->livre_id,
            'date_emprunt' => $request->date_emprunt,
            'date_retour_prevue' => $request->date_retour_prevue,
        ]);

        return redirect()->route('prets.index')->with('success', 'Prêt modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pret $pret)
    {
        $pret->delete();
        return redirect()->route('prets.index')->with('success', 'Prêt supprimé avec succès.');
    }

    /**
     * Gérer le retour d'un livre.
     */
   public function retour(Request $request, Pret $pret)
    {
        $pret->date_retour_effective = Carbon::now()->toDateString();
        $pret->save();

        // On formate bien les dates sans l'heure
        $datePrevue = Carbon::parse($pret->date_retour_prevue)->startOfDay();
        $dateEffective = Carbon::parse($pret->date_retour_effective)->startOfDay();

        if ($dateEffective->greaterThan($datePrevue)) {
            $retard = $dateEffective->diffInDays($datePrevue);
            $montant = $retard * 100;

            Penalite::create([
                'pret_id' => $pret->id,
                'montant' => $montant,
                'reglee' => false,
            ]);
        }

        return redirect()->route('prets.index')->with('success', 'Retour traité avec succès.');
    }

   // public function historique()
    //{
  //      $prets = Pret::all();
//     return view('prets.historique', compact('prets'));
   // }

    public function historique()
    {
        // On va chercher tous les prêts qui sont soit retournés, soit pénalité réglée
        $prets = Pret::whereNotNull('date_retour_effective')
                    ->orWhereHas('penalite', function($query) {
                        $query->where('reglee', true);
                    })->get();

        return view('prets.historique', compact('prets'));
    }
}