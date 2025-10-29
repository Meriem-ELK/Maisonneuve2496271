<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   
    /**
     * Afficher le formulaire de connexion.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Authentifier l'utilisateur et enregistrer la session.
     */
    public function store(Request $request)
    {
        // Validation des données envoyées par le formulaire de connexion
        $request->validate([
        'email' => 'required|email|exists:users',
        'password' => 'required|min:2|max:20'
    ]);

        // Récupérer uniquement les informations d'email et de mot de passe soumises
        $credentials = $request->only('email', 'password');

        // Vérifier si les informations d'identification sont valides
        if(!Auth::validate($credentials)):
            return redirect(route('login'))->withErrors(trans('auth.failed'))->withInput();
        endif;

        // Si l'authentification est réussie, récupérer l'utilisateur basé sur les informations d'identification
        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        // Authentifier l'utilisateur et démarrer une session
        Auth::login($user);

        return redirect()->intended(route('articles.index'))->withSuccess(trans('lang.message_success_connected'));
    }

    /**
     * Déconnecter l'utilisateur.
     */
    public function destroy()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
