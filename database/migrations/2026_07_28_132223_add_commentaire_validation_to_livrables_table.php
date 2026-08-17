<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('livrables', function (Blueprint $table) {
            $table->text('commentaire_validation')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('livrables', function (Blueprint $table) {
            $table->dropColumn('commentaire_validation');
        });
    }
};