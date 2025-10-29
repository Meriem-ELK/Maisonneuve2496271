<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Http\Resources\ArticleResource;


class Article extends Model
{
    use HasFactory;

    protected $fillable = [
    'title', 
    'content',
    'etudiant_id'
    ];

    // Définir la relation avec le modèle 'Etudiant'
    public function etudiant()
    {
        return $this->belongsTo(etudiant::class);
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            // Lors de la récupération de la valeur de 'title', on décode le JSON en tableau PHP.
            get: fn($value) => json_decode($value, true),
             // Avant de sauvegarder la valeur de 'title', on encode le tableau PHP en JSON.
            set: fn($value) => json_encode($value)
        );
    }

    protected function content(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value)
        );
    }

    // Méthode pour récupérer les articles et les trier.
    static public function articles(){
        $article = ArticleResource::collection(self::orderBy('created_at', 'desc')->get())->resolve();
        $sorted = collect($article)->sortBy('article')->values();
        return $sorted->all();
    }
}
