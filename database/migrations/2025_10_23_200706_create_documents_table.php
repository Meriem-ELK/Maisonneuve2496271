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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->json('title'); // Titre en français et anglais
            $table->string('fichier'); // Nom du fichier stocké
            $table->string('fichier_original'); // Nom original du fichier
            $table->string('type_fichier'); // Extension (pdf, zip, doc, docx)
            $table->integer('taille'); 
            $table->foreignId('etudiant_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
