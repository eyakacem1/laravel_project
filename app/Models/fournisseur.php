<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $table = 'fournisseur'; // Specify the correct table name
    protected $fillable = [
       'adresse',
       'email',
       'formeJuridique',
       'code',
       'matriculeFiscale',
       'nom',
       'phone',
       'raisonSociale',
       'type'

    ];
    public function parametre()
    {
        return $this->belongsTo(Parametre::class);
    }

   
    use HasFactory;
}
