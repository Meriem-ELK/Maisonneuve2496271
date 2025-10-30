@extends('layouts.app')
@section('title', trans('lang.page_name_upload_document'))
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10 col-xl-8">
        <div class="card shadow">

            <!-- Header -->
            <div class="card-header">
                <h3 class="mb-0">
                    <i class="bi bi-cloud-upload me-2"></i>{{ __('lang.upload_new_document') }}
                </h3>
            </div>

            <div class="card-body">
                <form action="{{ route('document.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Section Française -->
                    <div class="mb-4">
                        <h5 class="text-primary border-bottom pb-2 mb-3">
                            <i class="bi bi-flag-fill me-2"></i>{{ __('lang.french_version') }}
                        </h5>
                        
                        <div class="mb-3">
                            <label for="titre_fr" class="form-label">
                                {{ __('lang.titre_fr') }} *
                            </label>
                            <input type="text" class="form-control @error('titre_fr') is-invalid @enderror" id="titre_fr"  name="titre_fr" value="{{ old('titre_fr') }}"  placeholder="Entrez le titre du document en français">
                            @error('titre_fr')
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
                            <label for="titre_en" class="form-label">{{ __('lang.titre_en') }} * </label>
                            <input type="text" class="form-control @error('titre_en') is-invalid @enderror" id="titre_en" name="titre_en" value="{{ old('titre_en') }}" placeholder="Enter the document title in English">
                            @error('titre_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Section Fichier -->
                    <div class="mb-4">
                        <h5 class="text-info border-bottom pb-2 mb-3">
                            <i class="bi bi-file-earmark-arrow-up me-2"></i>{{ __('lang.file_section') }}
                        </h5>
                        
                        <div class="mb-3">
                            <label for="fichier" class="form-label">{{ __('lang.select_file') }} * </label>
                            <input type="file" class="form-control @error('fichier') is-invalid @enderror" id="fichier" name="fichier" accept=".pdf,.zip,.doc,.docx">
                            @error('fichier')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>
                                {{ __('lang.accepted_formats') }}: PDF, ZIP, DOC, DOCX ({{ __('lang.max') }}: 10MB)
                            </div>
                        </div>
                        
                    </div>

                    <!-- Boutons d'action -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('document.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>{{ __('lang.button_back') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-cloud-upload me-1"></i>{{ __('lang.button_upload') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection('content')