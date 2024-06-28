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
        // Validate the form inputs and store the validated data in $validatedData
        $validatedData = $request->validate([
            'table_name' => 'required|string',
            'adresse' => 'required|string',
            'email' => 'required|email',
            'formeJuridique' => $request->type == 'personne morale' ? 'required|string' : '',            'nom' => 'required|string',
            'ville' => 'required|string',
            'phone' => 'required|string',
            'type' => 'required|string|in:personne physique,personne morale',
            'matriculeFiscale' => $request->type == 'personne morale' ? 'required|string' : '',
            'raisonSociale' => $request->type == 'personne morale' ? 'required|string' : '',
        ]);
    // Fetch the table name from the validated data
    $tableName = $validatedData['table_name'];
    // Generate the code based on the table name
    $code = $this->generate_code($tableName);

    // Create a new Fournisseur instance and fill it with the validated data
    $fournisseur = new Fournisseur();
    $fournisseur->code = $code;
    $fournisseur->adresse = $validatedData['adresse'];
    $fournisseur->email = $validatedData['email'];
    $fournisseur->formeJuridique = $validatedData['formeJuridique'];
    $fournisseur->matriculeFiscale = $validatedData['matriculeFiscale'];
    $fournisseur->nom = $validatedData['nom'];
    $fournisseur->phone = $validatedData['phone'];
    $fournisseur->raisonSociale = $validatedData['raisonSociale'];
    $fournisseur->type = $validatedData['type'];
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
        return view('admin.updateFournisseur', compact('fournisseur'));
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
    private function generate_code($tableName)
    {
        $parametre = Parametre::where('table', $tableName)->first();
        // Generate a unique ID using prefixe and compteur
        $code = $parametre->prefixe . $parametre->separateur . str_pad($parametre->compteur, $parametre->taille, '0', STR_PAD_LEFT);    
        // Increment compteur for the next use, assuming it's a sequential counter
        $parametre->compteur++;
    
        // Save the updated parametre
        $parametre->save();
    
        return $code;
    }
}