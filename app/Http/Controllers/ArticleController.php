<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Afficher la liste de tous les articles (Forum)
    */
    public function index()
    {   
        $articles = Article::articles();
        return view('articles.index', compact('articles'));
    }

    /**
     * Afficher le formulaire pour créer un nouvel article
    */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Enregistrer un nouvel article
    */
    public function store(Request $request)
    {   
        // Validation des données envoyées par le formulaire   
        $request->validate([
        'titre_en' => 'required|min:3|max:255',
        'contenu_en' => 'required',
        'titre_fr' => 'required_with:contenu_fr|nullable|min:3|max:255',
        'contenu_fr' => 'required_with:titre_fr',
        ],[], [
        'titre_en' => trans('lang.post_titre_english'),
        'contenu_en' => trans('lang.post_contenu_english'),
        'titre_fr' => trans('lang.post_titre_french'),
        'contenu_fr' => trans('lang.post_contenu_french')
        ]);

        // Préparer les données de titre et de contenu dans différentes langues (anglais et français)
        $title = array_filter([
            'en' => $request->titre_en,
            'fr' => $request->titre_fr
        ]);

        $content = array_filter([
            'en' => $request->contenu_en,
            'fr' => $request->contenu_fr
        ]);

        $etudiant_id = Auth::user()->etudiant->id;

        Article::create([
            'title' => $title,
            'content' => $content,
            'etudiant_id' => $etudiant_id
        ]);

        return redirect()->route('articles.index')->with('success', trans('lang.message_success_create_post'));
    }

    /**
     * Afficher un article spécifique
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Afficher le formulaire pour modifier un article
     */
    public function edit(Article $article)
    {
        // Vérifier si l'utilisateur connecté est l'auteur de l'article   
        if ($article->etudiant_id !== Auth::user()->etudiant->id) {
        return redirect()->route('articles.index')->with('error', trans('lang.message_unauthorized_edit'));
        }

        return view('articles.edit', ['article' => $article]);
        
    }

    /**
     * Mettre à jour un article
     */
    public function update(Request $request, Article $article)
    {
        // Validation des nouvelles données envoyées pour mettre à jour l'article
        $request->validate([
        'titre_en' => 'required|min:3|max:255',
        'contenu_en' => 'required',
        'titre_fr' => 'required_with:contenu_fr|nullable|min:3|max:255',
        'contenu_fr' => 'required_with:titre_fr',
    ], [], [
        'titre_en' => trans('lang.post_titre_english'),
        'contenu_en' => trans('lang.post_contenu_english'),
        'titre_fr' => trans('lang.post_titre_french'),
        'contenu_fr' => trans('lang.post_contenu_french')
    ]);

    // Mettre à jour l'article avec les nouvelles données de titre et de contenu
    $article->update([
        'title' => array_filter([
            'en' => $request->titre_en,
            'fr' => $request->titre_fr,
        ]),
        'content' => array_filter([
            'en' => $request->contenu_en,
            'fr' => $request->contenu_fr,
        ]),
    ]);

    return redirect()->route('articles.index')->with('success', trans('lang.message_success_post_updated'));
    }

    
    /**
     * Supprimer un article
     */
    public function destroy(Article $article)
    {
         if ($article->etudiant_id !== Auth::user()->etudiant->id) {
        return redirect()->route('articles.index')->with('error', trans('lang.message_unauthorized_delete'));
        }
        $article->delete();

        return redirect()->route('articles.index')->with('success', trans('lang.message_success_post_deleted'));
    }
}