@extends('layouts.app')
@section('title', trans('lang.page__name_student_details'))
@section('content')

<div class="row justify-content-center card-content">
    <div class="col-lg-10 col-xl-8">
        <div class="card shadow">
            <!-- Header  -->
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-person-fill me-2"></i>{{ $etudiant->nom }}
                </h3>
            </div>

            <!-- Grille d'informations -->
            <div class="student-details-body">
                <div class="info-grid">
                   
                    <!-- Date de naissance -->
                    <div class="info-item">
                        <div class="info-label">@lang('lang.birth_date')</div>
                        <p class="info-value">
                            {{ $etudiant->date_naissance->format('d/m/Y') }}
                            <span class="age-badge">{{ $etudiant->date_naissance->age }} ans</span>
                        </p>
                    </div>

                    <!-- Email -->
                    <div class="info-item"> 
                        <div class="info-label">@lang('lang.email')</div>
                        <p class="info-value">
                            <a href="mailto:{{ $etudiant->email }}">{{ $etudiant->email }}</a>
                        </p>
                    </div>

                    <!-- Téléphone -->
                    <div class="info-item">
                        <div class="info-label">@lang('lang.phone')</div>
                        <p class="info-value">
                            {{ $etudiant->telephone }}
                        </p>
                    </div>

                    <!-- Ville -->
                    <div class="info-item"> 
                        <div class="info-label">@lang('lang.city')</div>
                        <p class="info-value location-info">
                            <i class="bi bi-geo-alt-fill"></i>
                            {{ $etudiant->ville->nom }}
                        </p>
                    </div>

                </div>

                <!-- Adresse -->
                <div class="address-full">
                    <div class="info-label">@lang('lang.address')</div>
                    <p class="info-value">{{ $etudiant->adresse }}</p>
                </div>
            </div>
            
            <!-- Actions (boutons) -->
            <div class="btn-actions">
                <div class="action-group">
                    <a href="{{ route('etudiant.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>@lang('lang.button_back')
                    </a>
                </div>
                
                <div class="action-group">
                    <a href="{{ route('etudiant.edit', $etudiant) }}" class="btn btn-sm btn-outline-warning">
                        <i class="bi bi-pencil-fill me-1"></i>@lang('lang.button_edit')
                    </a>
                    
                    <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi bi-trash-fill me-1"></i>@lang('lang.button_delete')
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Supprimer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer <strong> {{ $etudiant->nom }}</strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <form method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Supprimer" class="btn btn-danger">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection('content')