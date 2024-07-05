<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use App\Models\Villes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Parametre;
use App\Models\FormeJuridique;



class FournisseurResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fournisseur = Fournisseur::all();
        
        return view('admin.fournisseur', compact('fournisseur'));

        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { $formeJuridiques = FormeJuridique::all();
        $villes = Villes::all();
        return view('admin.createFournisseur', compact('villes','formeJuridiques'));
        //return view('admin.createFournisseur');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string',
            'adresse' => 'required|string',
            'email' => 'required|email',
            'ville' => 'nullable|string|max:255', 
            'phone' => 'required|string|max:255',            
            'type' => 'required|string|in:personne physique,personne morale',
            'matriculeFiscale' => $request->type == 'personne morale' ? 'required|string' : 'nullable|string',
            'raisonSociale' => $request->type == 'personne morale' ? 'required|string' : 'nullable|string',
'formeJuridique' => $request->type == 'personne morale' ? 'required|string|exists:forme_juridiques,forme' : 'nullable|string',
        ]);
        $ville = Villes::findOrFail($validatedData['ville']);    
        

        $code = GeneralController::generateCode('fournisseur');
        $fournisseur = new Fournisseur();
        $fournisseur->code = $code;
        $fournisseur->adresse = $validatedData['adresse'];
        $fournisseur->email = $validatedData['email'];
        $fournisseur->nom = $validatedData['nom'];
        $fournisseur->phone = $validatedData['phone'];
        $fournisseur->ville = $validatedData['ville'];; // Assign the resolved ville ID
        $fournisseur->type = $validatedData['type'];

        if ($request->type == 'personne morale') {
            $fournisseur->matriculeFiscale = $validatedData['matriculeFiscale'];
            $fournisseur->raisonSociale = $validatedData['raisonSociale'];
            $fournisseur->formeJuridique = $validatedData['formeJuridique'];
        }
        
        
        
        
        
        $fournisseur->save();

        return redirect()->route('admin.fournisseur.create')->with('success', 'Fournisseur ajouté avec succès.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.fournisseur', compact('fournisseur'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    
    {  $fournisseur = Fournisseur::findOrFail($id);
        $villes = Villes::all();
        $formeJuridiques = FormeJuridique::all();
        $type = $fournisseur->type;
        return view('admin.updateFournisseur', compact('villes','type','fournisseur','formeJuridiques'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'adresse' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'ville' => 'nullable|exists:villes,id', // Ensure nullable and exists rule
            'type' => 'required|string|in:personne physique,personne morale',
            'matriculeFiscale' => $request->type == 'personne morale' ? 'required|string|max:255' : 'nullable|string|max:255',
            'raisonSociale' => $request->type == 'personne morale' ? 'required|string|max:255' : 'nullable|string|max:255',
            'formeJuridique' => $request->type == 'personne morale' ? 'required|string|exists:forme_juridiques,forme' : 'nullable|string|max:255',
        ]);
    
        // Find the Fournisseur object by ID
        $fournisseur = Fournisseur::findOrFail($id);
    
        // Update the Fournisseur object with validated data
        $fournisseur->nom = $validatedData['nom'];
        $fournisseur->email = $validatedData['email'];
        $fournisseur->adresse = $validatedData['adresse'];
        $fournisseur->phone = $validatedData['phone'];
    
        // Update the ville field based on the validated data
        if (isset($validatedData['ville'])) {
            $fournisseur->ville = $validatedData['ville'];
        } else {
            $fournisseur->ville = null; // Set to null if no new ville is provided
        }
    
        // Update type-specific fields
        $fournisseur->type = $validatedData['type'];
    
        if ($request->type == 'personne morale') {
            $fournisseur->matriculeFiscale = $validatedData['matriculeFiscale'];
            $fournisseur->raisonSociale = $validatedData['raisonSociale'];
            $fournisseur->formeJuridique = $validatedData['formeJuridique'];
        } else {
            // Clear these fields if the type is 'personne physique'
            $fournisseur->matriculeFiscale = null;
            $fournisseur->raisonSociale = null;
            $fournisseur->formeJuridique = null;
        }
    
        // Save the updated Fournisseur object
        $fournisseur->save();
    
        // Redirect back to the fournisseur list or wherever appropriate
        return redirect()->route('admin.fournisseur')->with('success', 'Fournisseur mis à jour avec succès.');
    }
    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->delete();

        return redirect()->route('admin.fournisseur');
        //
    }
    public function fournisseurDynamicFields($id, $type)
{
    $fournisseur = Fournisseur::find($id);
    $formeJuridiques = FormeJuridique::all();

    return view('admin.fournisseurDynamicFields', compact('type', 'fournisseur', 'formeJuridiques'))->render();
}

   
}