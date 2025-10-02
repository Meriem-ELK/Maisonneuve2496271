<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'adresse',
        'telephone',
        'email',
        'date_naissance',
        'ville_id'
    ];

    // Définition des types de certains champs
    protected $casts = [
        'date_naissance' => 'date'
    ];

    // Relation: Un étudiant appartient à une ville
    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
}