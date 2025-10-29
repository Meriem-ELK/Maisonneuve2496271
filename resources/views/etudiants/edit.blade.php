@extends('layouts.app')
@section('title', trans('lang.page__name_edit_student') )
@section('content')

<div class="row justify-content-center card-content">
    <div class="col-lg-8">
        <div class="card shadow">
            <!-- Header  -->
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-pencil-fill me-2"></i>@lang('lang.page__name_edit_student') : {{ $etudiant->nom }}
                </h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('etudiant.update', $etudiant) }}">
                    @csrf
                    @method('put')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nom" class="form-label">@lang('lang.name_student') *</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $etudiant->nom) }}">
                            @if($errors->has('nom'))
                                <div class="text-danger mt-2">
                                    {{$errors->first('nom')}}
                                </div>            
                            @endif
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">@lang('lang.email') *</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $etudiant->email) }}">
                            @if($errors->has('email'))
                                <div class="text-danger mt-2">
                                    {{$errors->first('email')}}
                                </div>            
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telephone" class="form-label">@lang('lang.phone') *</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $etudiant->telephone) }}" required>
                            @if($errors->has('telephone'))
                                <div class="text-danger mt-2">
                                    {{$errors->first('telephone')}}
                                </div>            
                            @endif
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="date_naissance" class="form-label">@lang('lang.birth_date') *</label>
                            <input type="date" class="form-control" id="date_naissance" name="date_naissance" 
                                   value="{{ old('date_naissance', $etudiant->date_naissance->format('Y-m-d')) }}">
                            @if($errors->has('date_naissance'))
                                <div class="text-danger mt-2">
                                    {{$errors->first('date_naissance')}}
                                </div>            
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="adresse" class="form-label">@lang('lang.address') *</label>
                        <textarea class="form-control" id="adresse" name="adresse" rows="3">{{ old('adresse', $etudiant->adresse) }}</textarea>
                        @if($errors->has('adresse'))
                                <div class="text-danger mt-2">
                                    {{$errors->first('adresse')}}
                                </div>            
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="ville_id" class="form-label">@lang('lang.city') *</label>
                        <select class="form-select @error('ville_id') is-invalid @enderror" 
                                id="ville_id" name="ville_id" required>
                            <option value="">@lang('lang.select_city') *</option>
                            @foreach($villes as $ville)
                                <option value="{{ $ville->id }}" 
                                        {{ old('ville_id', $etudiant->ville_id) == $ville->id ? 'selected' : '' }}>
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

                    <!-- Actions (boutons) -->
                    <div class="btn-actions">
                            <a href="{{ route('etudiant.show', $etudiant) }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>@lang('lang.button_cancel')
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save me-1"></i>@lang('lang.button_update')
                            </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection('content')