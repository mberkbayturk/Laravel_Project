@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card my-4 shadow-sm">
                <h4 class="card-header text-center font-weight-bold text-color mb-0">{{ __('Giriş Ekranı') }}</h4>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <label for="email">{{ __('Email ') }}</label>
                            <div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="password">{{ __('Şifre') }}</label>
                            <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Beni Hatırla') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-color1 text-white shadow-sm">
                                    {{ __('Giriş Yap') }}
                                </button>
                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Şifremi Unuttum') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="text-center">
                <img src="{{asset('images/Signin.gif')}}" class="sign d-block mx-auto" alt="">
            </div>
        </div>
    </div>
</div>
@endsection
