@extends('layouts.app')
@section('title', trans('lang.page__name_login'))
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        <div class="card shadow">

            <!-- Header -->
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-lock me-2"></i>@lang('lang.login')
                </h3>
            </div>

            <div class="card-body">
                <form method="post">
                    @csrf

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
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mt-4 w-100">
                        <i class="bi bi-lock me-1"></i>@lang('lang.button_submit')
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection('content')
