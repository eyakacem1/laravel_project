<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Villes;


class VilleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $villes = Villes::all();
        return view('admin.ville', compact('villes'));
    }

    public function create()
    {
        return view('admin.createVille');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Villes::create($request->all());

        return redirect()->route('admin.ville')->with('success', 'Ville ajoutée avec succès.');
    }

    public function show($id)
    {
        $ville = Villes::findOrFail($id);
        return view('admin.villes.show', compact('ville'));
    }

    public function edit($id)
    {
        $ville = Villes::findOrFail($id);
        return view('admin.updateVille', compact('ville'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $ville = Villes::findOrFail($id);
        $ville->update($request->all());

        return redirect()->route('admin.ville')->with('success', 'Ville mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $ville = Villes::findOrFail($id);
        $ville->delete();

        return redirect()->route('admin.ville')->with('success', 'Ville supprimée avec succès.');
    }
}