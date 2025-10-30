@extends('layouts.app')
@section('title', trans('lang.page_name_documents'))
@section('content')

<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow">
            <!-- Header -->
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">
                        <i class="bi bi-folder-fill me-2"></i>{{ __('lang.document_repository') }}
                    </h3>
                    <a href="{{ route('document.create') }}" class="btn btn-primary">
                        <i class="bi bi-cloud-upload me-1"></i>{{ __('lang.upload_document') }}
                    </a>
                </div>
            </div>

            <!-- Body avec tableau -->
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="w-35">{{ __('lang.title') }}</th>
                                <th class="w-20">{{ __('lang.author') }}</th>
                                <th class="w-20 text-center">{{ __('lang.type') }}</th>
                                <th class="w-25"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($documents as $document)
                                <tr>
                                    <!-- Titre -->
                                    <td>
                                        <strong>{{ $document->titre }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $document->fichier_original }}</small>
                                    </td>
                                    
                                    <!-- Auteur -->
                                    <td><i class="bi bi-person-circle me-1"></i> {{ $document->etudiant->nom }} </td>
                                    
                                    <!-- Type -->
                                    <td class="text-center">
                                        <span class="badge bg-secondary text-uppercase">{{ $document->type_fichier }}</span>
                                    </td>
                                    
                                    <!-- Actions -->
                                    <td class="text-center">
                                        <div class="action-group justify-content-between px-4">
                                            <!-- Télécharger -->
                                            <a href="{{ route('document.download', $document) }}" class="btn btn-primary" title="{{ __('lang.downlaod') }}">
                                                <i class="bi bi-download"></i>
                                                <span>{{ __('lang.download') }}</span>
                                            </a>

                                            @auth
                                                @if (Auth::user()->etudiant->id === $document->etudiant_id)
                                                
                                                    <!-- Modifier -->
                                                    <a href="{{ route('document.edit', $document) }}" class="btn btn-sm btn-outline-warning" title="{{ __('lang.button_edit') }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                        <span>{{ __('lang.button_edit') }}</span>
                                                    </a>
                                                    
                                                    <!-- Supprimer -->
                                                    <form action="{{ route('document.destroy', $document) }}" method="post" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="{{ __('lang.button_delete') }}" onclick="return confirm({{ json_encode(__('lang.confirm_delete_article')) }})">
                                                            <i class="bi bi-trash3"></i>
                                                            <span>{{ __('lang.button_delete') }}</span>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endauth
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                        <p class="text-center">{{ __('lang.no_documents') }}</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- pagination -->
            <div class="d-flex justify-content-center mt-4 pagination">
                {{ $documents->links() }}
            </div>
        </div>
    </div>
</div>


@endsection('content')