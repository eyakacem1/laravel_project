<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villes extends Model
{
    protected $table = 'villes'; // Specify the correct table name

    protected $fillable = [
       'nom'
       
 
     ];
    use HasFactory;
}
