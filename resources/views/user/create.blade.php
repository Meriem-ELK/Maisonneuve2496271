@extends('layouts.app')

@section('title', trans('lang.page__name_user_create'))

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-person-plus-fill me-2"></i>@lang('lang.page__name_user_create')
                </h3>
            </div>
            <div class="card-body">
                <form method="POST">
                    @csrf
                    
                    <!-- Nom -->
                    <div class="mb-3">
                        <label for="name" class="form-label">@lang('lang.name') *</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <div class="form-text text-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">@lang('lang.email') *</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <div class="form-text text-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">@lang('lang.password') *</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @if ($errors->has('password'))
                            <div class="form-text text-danger">{{ $errors->first('password') }}</div>
                        @endif
                        <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>
                                {{ __('lang.accepted_password') }}
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">@lang('lang.confirm_password') *</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        @if ($errors->has('confirm_password'))
                            <div class="form-text text-danger">{{ $errors->first('confirm_password') }}</div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-save me-1"></i>@lang('lang.button_submit')
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
