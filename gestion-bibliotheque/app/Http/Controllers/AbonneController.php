<?php  
  
namespace App\Http\Controllers;  
  
use Illuminate\Http\Request;  
use App\Models\Abonne;  
  
class AbonneController extends Controller  
{  
    // Liste des abonnés  
    public function index(Request $request)  
    {  
        $query = Abonne::query();  
  
        if ($request->filled('search')) {  
            $search = $request->search;  
            $query->where(function ($q) use ($search) {  
                $q->where('nom', 'like', "%{$search}%")  
                ->orWhere('prenom', 'like', "%{$search}%")  
                ->orWhere('classe', 'like', "%{$search}%");  
            });  
        }  
  
        $abonnes = $query->get();  
  
        return view('abonnes.index', compact('abonnes'));  
    }  
  
    // Affichage du formulaire de création  
    public function create()  
    {  
        return view('abonnes.create');  
    }  
  
    // Enregistrement d’un nouvel abonné  
    public function store(Request $request)  
    {  
        $validatedData = $request->validate([  
            'nom' => 'required|string|max:255',  
            'prenom' => 'required|string|max:255',  
            'classe' => 'required|string|max:255',  
            'email' => 'required|email|unique:abonnes,email',  
            'date_debut_abonnement' => 'required|date',  
            'date_fin_abonnement' => 'required|date|after_or_equal:date_debut_abonnement',  
        ]);  
  
        Abonne::create($validatedData);  
        return redirect()->route('abonnes.index')->with('success', 'Abonné ajouté avec succès.');  
    }  
  
    // Détails d’un abonné  
    public function show($id)  
    {  
        $abonne = Abonne::findOrFail($id);  
        return view('abonnes.show', compact('abonne'));  
    }  
  
    // Formulaire d’édition  
    public function edit($id)  
    {  
        $abonne = Abonne::findOrFail($id);  
        return view('abonnes.edit', compact('abonne'));  
    }  
  
    // Mise à jour d’un abonné  
    public function update(Request $request, $id)  
    {  
        $abonne = Abonne::findOrFail($id);  
  
        $validatedData = $request->validate([  
            'nom' => 'required|string|max:255',  
            'prenom' => 'required|string|max:255',  
            'classe' => 'required|string|max:255',  
            'email' => 'required|email|unique:abonnes,email,'.$abonne->id,  
            'date_debut_abonnement' => 'required|date',  
            'date_fin_abonnement' => 'required|date|after_or_equal:date_debut_abonnement',  
        ]);  
  
        $abonne->update($validatedData);  
        return redirect()->route('abonnes.index')->with('success', 'Abonné mis à jour avec succès.');  
    }  
  
    // Suppression d’un abonné  
    public function destroy($id)  
    {  
        $abonne = Abonne::findOrFail($id);  
        $abonne->delete();  
        return redirect()->route('abonnes.index')->with('success', 'Abonné supprimé avec succès.');  
    }  
}