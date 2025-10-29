<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Afficher le formulaire de création d'un utilisateur.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Enregistrer un nouvel utilisateur dans la base de données.
     */
    public function store(Request $request)
    {
        // Validation des données envoyées par le formulaire
        $request->validate([
            'name' => 'required|string||min:2|max:255',
            'email' => 'required|email|exists:etudiants,email|unique:users,email',
            'password' => 'required|min:2|max:20|string|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/',
            'confirm_password' =>  'required|min:2|max:20|string|same:password'
            ],[], [
            'name' => trans('lang.name'),
            'email' => trans('lang.email'),
            'password' => trans('lang.password'),
            'confirm_password' => trans('lang.confirm_password')
        ]);

        // Créer un nouvel utilisateur avec les données validées   
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),   // Le mot de passe est haché avant d'être stocké
        ]);

        // Trouver l'étudiant correspondant à l'email de l'utilisateur
        $etudiant = etudiant::where('email', $request->email)->first();

        // Si un étudiant avec cet email existe, lier l'étudiant à l'utilisateur créé
        if ($etudiant) {
            $etudiant->user_id = $user->id;
            $etudiant->save();
        }

        return redirect()->route('etudiant.index')->with('success', trans('lang.message_success_create_user'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
