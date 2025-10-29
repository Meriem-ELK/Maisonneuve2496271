@extends('layouts.app')
@section('title', trans('lang.page__name_edit_post'))
@section('content')

<div class="row justify-content-center card-content">
    <div class="col-lg-10 col-xl-8">
        <div class="card shadow">

            <!-- Header -->
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-pencil-square me-2"></i>{{ __('lang.edit_article') }}
                </h3>
            </div>
            
            <div class="card-body">
                <form method="post">
                    @csrf
                    @method('PUT')
                    
                    <!-- Section Française -->
                    <div class="mb-4">
                        <h5 class="text-primary border-bottom pb-2 mb-3">
                            <i class="bi bi-flag-fill me-2"></i>{{ __('lang.french_version') }}
                        </h5>
                        
                        <div class="mb-3">
                            <label for="titre_fr" class="form-label">{{ __('lang.titre_fr') }} *</label>
                            <input type="text" class="form-control @error('titre_fr') is-invalid @enderror" 
                                   id="titre_fr" name="titre_fr" 
                                   value="{{ old('titre_fr', $article->title['fr'] ?? '') }}">
                                   
                            @error('titre_fr')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contenu_fr" class="form-label">{{ __('lang.contenu_fr') }} *</label>
                            <textarea class="form-control @error('contenu_fr') is-invalid @enderror" 
                                      id="contenu_fr" name="contenu_fr" rows="6">{{ old('contenu_fr', $article->content['fr'] ?? '') }}</textarea>
                            @error('contenu_fr')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Section Anglaise -->
                    <div class="mb-4">
                        <h5 class="text-success border-bottom pb-2 mb-3">
                            <i class="bi bi-flag me-2"></i>{{ __('lang.english_version') }}
                        </h5>
                        
                        <div class="mb-3">
                            <label for="titre_en" class="form-label">{{ __('lang.titre_en') }} *</label>
                            <input type="text" class="form-control @error('titre_en') is-invalid @enderror" 
                                   id="titre_en" name="titre_en" 
                                   value="{{ old('titre_en', $article->title['en'] ?? '') }}">
                            @error('titre_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contenu_en" class="form-label">{{ __('lang.contenu_en') }} *</label>
                            <textarea class="form-control @error('contenu_en') is-invalid @enderror" 
                                      id="contenu_en" name="contenu_en" rows="6">{{ old('contenu_en', $article->content['en'] ?? '') }}</textarea>
                            @error('contenu_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Info de l'article -->
                    <div class="alert alert-info mb-4">
                        <small>
                            <strong>{{ __('lang.author') }}:</strong> {{ $article->etudiant->nom }}<br>
                            <strong>{{ __('lang.created_at') }}:</strong> {{ $article->created_at->format('d/m/Y H:i') }}
                        </small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('articles.index', $article) }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>{{ __('lang.button_back') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>{{ __('lang.button_update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection('content')