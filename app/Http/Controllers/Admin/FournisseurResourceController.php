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
            'table_name' => 'required|string',
            'adresse' => 'required|string',
            'email' => 'required|email',
            'nom' => 'required|string',
            'ville' => 'required|string',
            'phone' => 'required|string',
            'type' => 'required|string|in:personne physique,personne morale',
            'matriculeFiscale' => $request->type == 'personne morale' ? 'required|string' : 'nullable|string',
            'raisonSociale' => $request->type == 'personne morale' ? 'required|string' : 'nullable|string',
'formeJuridique' => $request->type == 'personne morale' ? 'required|string|exists:forme_juridiques,forme' : 'nullable|string',
        ]);

        $tableName = $validatedData['table_name'];
        $code = GeneralController::generateCode($tableName);
        $fournisseur = new Fournisseur();
        $fournisseur->code = $code;
        $fournisseur->adresse = $validatedData['adresse'];
        $fournisseur->email = $validatedData['email'];
        $fournisseur->nom = $validatedData['nom'];
        $fournisseur->phone = $validatedData['phone'];
        $fournisseur->ville = $validatedData['ville'];
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
        $formeJuridiques = FormeJuridique::all();
        $type = $fournisseur->type;
        return view('admin.updateFournisseur', compact('type','fournisseur','formeJuridiques'));
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'matriculeFiscale' => 'required|string|max:255',
            'raisonSociale' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'adresse' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'formeJuridique' => 'required|string|in:SARL,SA,SASU',
            'type' => 'required|string|in:personne physique,personne morale',
        ]);
    
        // Find the fournisseur by ID
        $fournisseur = \App\Models\Fournisseur::findOrFail($id);
    
        // Update fournisseur attributes based on validated data
        $fournisseur->nom = $validatedData['nom'];
        $fournisseur->matriculeFiscale = $validatedData['matriculeFiscale'];
        $fournisseur->raisonSociale = $validatedData['raisonSociale'];
        $fournisseur->email = $validatedData['email'];
        $fournisseur->adresse = $validatedData['adresse'];
        $fournisseur->phone = $validatedData['phone'];
        $fournisseur->formeJuridique = $validatedData['formeJuridique'];
        $fournisseur->type = $validatedData['type'];
    
        // Save the updated fournisseur
        $fournisseur->save();
    
        // Redirect back to the fournisseur list or wherever appropriate
        return redirect()->route('admin.fournisseur');
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