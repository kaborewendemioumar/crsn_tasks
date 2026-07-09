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
    Schema::create('livrables', function (Blueprint $table) {
        $table->id();

        $table->foreignId('task_id')
              ->constrained('tasks')
              ->onDelete('cascade');

        $table->foreignId('user_id')
              ->constrained('users')
              ->onDelete('cascade');

        $table->string('fichier');
        $table->text('commentaire')->nullable();

        $table->enum('statut', [
            'Soumis',
            'Validé',
            'Rejeté'
        ])->default('Soumis');

        $table->dateTime('date_soumission');

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livrables');
    }
};
