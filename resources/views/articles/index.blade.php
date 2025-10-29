@extends('layouts.app')
@section('title', trans('lang.page__name_all_post'))
@section('content')

<div class="articles-container">
    @foreach ($articles as $article)
        <article class="article-card">

            <!-- En-tête de l'article -->
            <div class="article-header">
                <div class="article-icon-wrapper">
                    <i class="bi bi-file-text"></i>
                </div>
                <h3 class="article-title">{{ $article['titre'] }}</h3>
            </div>

            <!-- Corps de l'article -->
            <div class="article-body">
                <p class="article-content">{{ $article['contenu'] }}</p>
            </div>

            <!-- Métadonnées de l'article -->
            <div class="article-meta">
                <div class="meta-item">
                    <i class="bi bi-person-circle"></i>
                    <span class="meta-label">{{ __('lang.by') }}</span>
                    <span class="meta-value">{{ $article['etudiant_nom'] }}</span>
                </div>
                <div class="meta-divider"></div>
                <div class="meta-item">
                    <i class="bi bi-calendar-event"></i>
                    <span class="meta-label">{{ __('lang.date') }}</span>
                    <span class="meta-value">{{ $article['created_at'] }}</span>
                </div>
            </div>

            <!-- Actions (visible uniquement pour l'auteur) -->
            @auth
                @if (Auth::user()->etudiant->id === $article['etudiant_id'])
                    <div class="action-group justify-content-between px-4 pt-4">
                        <a href="{{ route('article.edit', $article['id']) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil-square"></i>
                            <span>{{ __('lang.button_edit') }}</span>
                        </a>
                        <form action="{{ route('article.destroy', $article['id']) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm({{ json_encode(__('lang.confirm_delete_article')) }})">
                                <i class="bi bi-trash3"></i>
                                <span>{{ __('lang.button_delete') }}</span>
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </article>
    @endforeach
</div>

@endsection('content')