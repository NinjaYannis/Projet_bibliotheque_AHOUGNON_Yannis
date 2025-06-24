<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('abonnes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('classe');
            $table->string('email')->unique();
            $table->date('date_debut_abonnement');
            $table->date('date_fin_abonnement');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abonnes');
    }
};