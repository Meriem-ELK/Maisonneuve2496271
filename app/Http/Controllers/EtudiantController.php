<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Ville;
use Illuminate\Http\Request;
use Carbon\Carbon;  //bibliothèque qui facilite la gestion et la manipulation des dates et des heures en PHP

class EtudiantController extends Controller
{
    /**
     * Affiche la liste de tous les étudiants.
     * On récupère tous les étudiants, en les triant par nom.
    */
    public function index()
    {
        $etudiants = Etudiant::with('ville')->orderBy('nom')->paginate(9);
        return view('etudiants.index', ['etudiants' => $etudiants]);
    }

    /**
     * On affiche le formulaire pour créer un nouvel étudiant.
    */
    public function create()
    {
        $villes = Ville::orderBy('nom')->get();
        return view('etudiants.create', compact('villes'));
    }

    /**
     *  On enregistre un nouvel étudiant dans la base de données.
     */
    public function store(Request $request)
    {

    // Calculer la date limite (16 ans avant aujourd'hui)
    $dateLimite = Carbon::today()->subYears(16)->toDateString();

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email',
            'date_naissance' => "required|date|before_or_equal:$dateLimite",
            'ville_id' => 'required|exists:villes,id'
        ]);

        Etudiant::create($validated);

        return redirect()->route('etudiant.index')->with('success', trans('lang.message_success_create_student'));
    }

    /**
     * On affiche un étudiant spécifique.
     */
    public function show(Etudiant $etudiant)
    {
        $etudiant->load('ville');
        return view('etudiants.show', ['etudiant' => $etudiant]);
    }

    /**
     * On affiche le formulaire pour modifier un étudiant existant.
     */
    public function edit(Etudiant $etudiant)
    {
        $villes = Ville::orderBy('nom')->get();
        return view('etudiants.edit', compact('etudiant', 'villes'));
    }

    /**
     * On met à jour les informations d'un étudiant dans la base de données.
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email,' . $etudiant->id,
            'date_naissance' => 'required|date|before:today',
            'ville_id' => 'required|exists:villes,id'
        ]);

        $etudiant->update($validated);

        return redirect()->route('etudiant.show', $etudiant)->with('success', trans('lang.message_success_updated_student'));
    }

    /**
     * On supprime un étudiant de la base de données.
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        return redirect()->route('etudiant.index')->with('success', trans('lang.message_success_deleted_student'));
    }
}
