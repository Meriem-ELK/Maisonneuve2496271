<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    // Définir les attributs
        protected $fillable = [
        'title',
        'fichier',
        'fichier_original',
        'type_fichier',
        'taille',
        'etudiant_id'
    ];

    // Définir les types de données pour certains champs   
    protected $casts = [
        'title' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Relation: Un document appartient à un étudiant
     */
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

     /**
     * Obtenir le titre dans la langue actuelle
     */
    public function getTitreAttribute()
    {
        $locale = app()->getLocale();
        return $this->title[$locale] ?? $this->title['en'] ?? $this->title['fr'] ?? '';
    }

}
