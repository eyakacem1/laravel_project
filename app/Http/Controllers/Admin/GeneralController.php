<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parametre;

class GeneralController extends Controller
{
    public static function generateCode($tableName)
    {
        $parametre = Parametre::where('table', $tableName)->first();

        if (!$parametre) {
            // Handle case where parametre for table doesn't exist
            return null;
        }

        // Generate a unique ID using prefixe and compteur
        $code = $parametre->prefixe . $parametre->separateur . str_pad($parametre->compteur, $parametre->taille, '0', STR_PAD_LEFT);

        // Increment compteur for the next use, assuming it's a sequential counter
        $parametre->compteur++;
    
        // Save the updated parametre
        $parametre->save();
    
        return $code;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
