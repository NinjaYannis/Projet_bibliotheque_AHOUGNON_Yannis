<?php  
  
namespace App\Http\Controllers;  
  
use App\Models\Livre;  
use Illuminate\Http\Request;  
  
class LivreController extends Controller  
{  
    /**  
     * Display a listing of the resource.  
     */  
    public function index(Request $request)  
    {  
        // Récupération des critères de recherche  
        $query = Livre::query();  
  
        if ($request->filled('titre')) {  
            $query->where('titre', 'like', '%' . $request->titre . '%');  
        }  
  
        if ($request->filled('auteur')) {  
            $query->where('auteur', 'like', '%' . $request->auteur . '%');  
        }  
  
        if ($request->filled('sujet')) {  
            $query->where('sujet', 'like', '%' . $request->sujet . '%');  
        }  
  
        $livres = $query->get();  
  
        return view('livres.index', compact('livres'));  
    }  
  
    /**  
     * Show the form for creating a new resource.  
     */  
    public function create()  
    {  
        return view('livres.create');  
    }  
  
    /**  
     * Store a newly created resource in storage.  
     */  
    public function store(Request $request)  
    {  
        $request->validate([  
            'titre' => 'required|string|max:255',  
            'auteur' => 'required|string|max:255',  
            'sujet' => 'required|string|max:255',  
            'identifiant_unique' => 'required|string|max:255|unique:livres,identifiant_unique',  
            'stock' => 'required|integer|min:0',  
        ]);  
  
        Livre::create($request->all());  
  
        return redirect()->route('livres.index')->with('success', 'Livre ajouté avec succès.');  
    }  
  
    /**  
     * Display the specified resource.  
     */  
    public function show(Livre $livre)  
    {  
        return view('livres.show', compact('livre'));  
    }  
  
    /**  
     * Show the form for editing the specified resource.  
     */  
    public function edit(Livre $livre)  
    {  
        return view('livres.edit', compact('livre'));  
    }  
  
    /**  
     * Update the specified resource in storage.  
     */  
    public function update(Request $request, Livre $livre)  
    {  
        $request->validate([  
            'titre' => 'required|string|max:255',  
            'auteur' => 'required|string|max:255',  
            'sujet' => 'required|string|max:255',  
            'identifiant_unique' => 'required|string|max:255|unique:livres,identifiant_unique,' . $livre->id,  
            'stock' => 'required|integer|min:0',  
        ]);  
  
        $livre->update($request->all());  
  
        return redirect()->route('livres.index')->with('success', 'Livre modifié avec succès.');  
    }  
  
    /**  
     * Remove the specified resource from storage.  
     */  
    public function destroy(Livre $livre)  
    {  
        $livre->delete();  
  
        return redirect()->route('livres.index')->with('success', 'Livre supprimé avec succès.');  
    }  
}