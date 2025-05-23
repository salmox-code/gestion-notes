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
        Schema::table('convocations', function (Blueprint $table) {
            $table->string('niveau')->nullable(); // CP1, DATA1, etc.
            $table->date('date')->nullable();
            $table->time('heure')->nullable();
            $table->foreignId('surveillant_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('convocations', function (Blueprint $table) {
            $table->dropColumn(['niveau', 'date', 'heure']);
            $table->dropForeign(['surveillant_id']);
            $table->dropColumn('surveillant_id');
        });
    }
};

