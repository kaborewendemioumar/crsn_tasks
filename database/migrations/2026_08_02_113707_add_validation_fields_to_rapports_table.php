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
    Schema::table('rapports', function (Blueprint $table) {

        $table->enum('statut', [
            'Soumis',
            'Validé',
            'Rejeté'
        ])
        ->default('Soumis');


        $table->text('commentaire_validation')
              ->nullable();

    });
}

    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::table('rapports', function (Blueprint $table) {

        $table->dropColumn([
            'statut',
            'commentaire_validation'
        ]);

    });
}
};
