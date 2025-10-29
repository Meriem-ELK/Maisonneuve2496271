<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titre' => isset($this->title[app()->getLocale()]) ? $this->title[app()->getLocale()] : $this->title['en'],
            'contenu' => isset($this->content[app()->getLocale()]) ? $this->content[app()->getLocale()] : $this->content['en'],
            'created_at' => $this->created_at->format('Y-m-d H:i'),
            'etudiant_nom' => $this->etudiant->nom,
            'etudiant_id' => $this->etudiant_id,
        ];
    }
}
