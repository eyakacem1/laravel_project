<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
        {
            Schema::table('parametre', function (Blueprint $table) {
                $table->string('suffixe')->nullable()->after('separateur');
            });
        }
    
        public function down()
        {
            Schema::table('parametre', function (Blueprint $table) {
                $table->dropColumn('suffixe');
            });
        }
};
