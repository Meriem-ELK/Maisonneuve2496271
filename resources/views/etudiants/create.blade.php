@extends('layouts.app')
@section('title', 'Nouvel Étudiant')
@section('content')

<div class="row justify-content-center card-content">
    <div class="col-lg-10 col-xl-8">
        <div class="card shadow">
            <!-- Header  -->
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-person-plus-fill me-2"></i>Nouvel Étudiant
                </h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('etudiant.store') }}">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nom" class="form-label">Nom complet *</label>
                            <input type="text" class="form-control"  id="nom" name="nom" value="{{ old('nom') }}">
                            @if($errors->has('nom'))
                                <div class="text-danger mt-2">
                                    {{$errors->first('nom')}}
                                </div>            
                            @endif
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">

                            @if($errors->has('email'))
                                <div class="text-danger mt-2">
                                    {{$errors->first('email')}}
                                </div>            
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telephone" class="form-label">Téléphone *</label>
                            <input type="text" class="form-control" 
                                   id="telephone" name="telephone" value="{{ old('telephone') }}">
                            
                            @if($errors->has('telephone'))
                                <div class="text-danger mt-2">
                                    {{$errors->first('telephone')}}
                                </div>            
                            @endif
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="date_naissance" class="form-label">Date de naissance *</label>
                            <input type="date" class="form-control" 
                                   id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}">
                           
                            @if($errors->has('date_naissance'))
                                <div class="text-danger mt-2">
                                    {{$errors->first('date_naissance')}}
                                </div>            
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse *</label>
                        <textarea class="form-control" 
                                  id="adresse" name="adresse" rows="3" >{{ old('adresse') }}</textarea>

                            @if($errors->has('adresse'))
                                <div class="text-danger mt-2">
                                    {{$errors->first('adresse')}}
                                </div>            
                            @endif
                    </div>

                    <div class="mb-3">
                        <label for="ville_id" class="form-label">Ville *</label>
                        <select class="form-select" 
                                id="ville_id" name="ville_id">
                            <option value="">Sélectionner une ville</option>
                            @foreach($villes as $ville)
                                <option value="{{ $ville->id }}" {{ old('ville_id') == $ville->id ? 'selected' : '' }}>
                                    {{ $ville->nom }}
                                </option>
                            @endforeach
                        </select>
                        @if($errors->has('ville_id'))
                                <div class="text-danger mt-2">
                                    {{$errors->first('ville_id')}}
                                </div>            
                        @endif
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('etudiant.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Retour
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection('content')