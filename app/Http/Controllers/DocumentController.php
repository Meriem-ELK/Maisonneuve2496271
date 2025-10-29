<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    // Afficher la liste des documents
    public function index()
    {
        $documents = Document::with('etudiant')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('documents.index', compact('documents'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('documents.create');
    }

    // Enregistrer un nouveau document
    public function store(Request $request)
    {
        $request->validate([
            'titre_fr' => 'required|min:3|max:255',
            'titre_en' => 'required|min:3|max:255',
            'fichier' => 'required|file|mimes:pdf,zip,doc,docx|max:10240',
        ]);

        $file = $request->file('fichier');
        $nomFichier = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/documents', $nomFichier);

        Document::create([
            'title' => [
                'fr' => $request->titre_fr,
                'en' => $request->titre_en
            ],
            'fichier' => $nomFichier,
            'fichier_original' => $file->getClientOriginalName(),
            'type_fichier' => $file->getClientOriginalExtension(),
            'taille' => $file->getSize(),
            'etudiant_id' => Auth::user()->etudiant->id
        ]);

        return redirect()->route('document.index')
            ->with('success', trans('lang.message_success_create_file'));
    }

    // Afficher le formulaire d'édition
    public function edit(Document $document)
    {
        return view('documents.edit', compact('document'));
    }

    // Mettre à jour un document
    public function update(Request $request, Document $document)
    {
        $request->validate([
            'titre_fr' => 'required|min:3|max:255',
            'titre_en' => 'required|min:3|max:255',
            'fichier' => 'nullable|file|mimes:pdf,zip,doc,docx|max:10240',
        ]);

        // Mettre à jour le titre
        $document->update([
            'title' => [
                'fr' => $request->titre_fr,
                'en' => $request->titre_en
            ]
        ]);

        // Si un nouveau fichier est uploadé
        if ($request->hasFile('fichier')) {
            // Supprimer l'ancien fichier
            Storage::delete('public/documents/' . $document->fichier);
            
            // Sauvegarder le nouveau fichier
            $file = $request->file('fichier');
            $nomFichier = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/documents', $nomFichier);
            
            // Mettre à jour toutes les infos du fichier
            $document->update([
                'fichier' => $nomFichier,
                'fichier_original' => $file->getClientOriginalName(),
                'type_fichier' => $file->getClientOriginalExtension(),
                'taille' => $file->getSize(),
            ]);
        }

        return redirect()->route('document.index')
            ->with('success', trans('lang.message_success_edit_file'));
    }

    // Télécharger un document
    public function download(Document $document)
    {
        $cheminFichier = 'public/documents/' . $document->fichier;
        
        if (!Storage::exists($cheminFichier)) {
            return redirect()->route('document.index')
                ->with('error', 'Fichier introuvable!');
        }

        return Storage::download($cheminFichier, $document->fichier_original);
    }

    // Supprimer un document
    public function destroy(Document $document)
    {
        Storage::delete('public/documents/' . $document->fichier);
        $document->delete();

        return redirect()->route('document.index')
            ->with('success', trans('lang.message_success_delete_file'));
    }
}