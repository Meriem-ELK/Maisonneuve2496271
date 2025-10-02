@extends('layouts.app')
@section('title', 'Liste des Étudiants')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 card_header">
    <h2><i class="bi bi-people-fill me-2"></i>Liste des étudiants</h2>
    <a href="{{ route('etudiant.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus-fill me-1"></i>Nouvel étudiant
    </a>
</div>

<div class="row card-content">
    @forelse ($etudiants as $etudiant)
        <div class="col-lg-6 col-xl-4 mb-4">
            <div class="card h-100 card-hover shadow-sm">
                <div class="card-header bg-light">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-person-fill me-2"></i>{{ $etudiant->nom }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <small class="text-muted">
                            <i class="bi bi-geo-alt-fill me-3"></i>{{ $etudiant->ville->nom }}
                        </small>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">
                            <i class="bi bi-envelope-fill me-3"></i>{{ $etudiant->email }}
                        </small>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">
                            <i class="bi bi-telephone-fill me-3"></i>{{ $etudiant->telephone }}
                        </small>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('etudiant.show', $etudiant->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye-fill me-1"></i>Voir
                        </a>
                        <a href="{{ route('etudiant.edit', $etudiant->id) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil-fill me-1"></i>Modifier
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle-fill me-2"></i>
                Aucun étudiant n'est enregistré pour le moment.
            </div>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-4 pagination">
    {{ $etudiants->links() }}
</div>

@endsection('content')