<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormeJuridique extends Model
{

    protected $table = 'forme_juridiques'; // Specify the correct table name
    protected $fillable = [
       'adresse',
       

    ];
    use HasFactory;
}
