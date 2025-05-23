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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
        $table->string('prenom');
        $table->string('email')->unique();
    
        $table->string('cne')->unique();
        $table->string('niveau'); // Ex: CP1, CP2, Cycle Ingénieur
$table->string('filiere')->nullable(); // Ex: TDIA, DATA (nullable pour CP1, CP2)
$table->foreignId('classe_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etudiants');
    }
};
