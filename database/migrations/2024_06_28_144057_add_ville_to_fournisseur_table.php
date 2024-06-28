<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fournisseur', function (Blueprint $table) {
            $table->string('ville')->nullable(); // Vous pouvez ajuster le type de colonne et les contraintes selon vos besoins
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fournisseur', function (Blueprint $table) {
            $table->dropColumn('ville');
        });
    }
   
};