<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parametre extends Model
{
  protected $table = 'parametre'; // Specify the correct table name

    protected $fillable = [
       'compteur',
       'prefixe',
       'separateur',
       'table',
       'taille'
 
     ];
 
    use HasFactory;
}
