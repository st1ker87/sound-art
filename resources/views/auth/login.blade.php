@extends('layouts.app')

@section('header')
    @include('partials.header_search')
@endsection

@section('content')
<div class="container login_main">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card_login">
                {{-- <div class="card-header text-center">{{ __('Login') }}</div> --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2 text-center">
                                <button type="" class="btn btn-facebook btn-lg btn-block">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <i class="fab fa-facebook-f"></i>
                                        </div>
                                        <div class="col-md-11">
                                            {{ __('SIGN IN WITH FACEBOOK') }}
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2 text-center">
                                <button type="" class="btn btn-spotify btn-lg btn-block">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <i class="fab fa-spotify"></i>
                                        </div>
                                        <div class="col-md-11">
                                            {{ __('SIGN IN WITH SPOTIFY') }}
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2 text-center">
                                <div class="or"><span>OR</span></div>
                            </div>
                        </div>


                        <div class="form-group row">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                            <div class="col-md-8 offset-md-2">
                                <input id="email" type="email" placeholder="E-mail Adress" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                            <div class="col-md-8 offset-md-2">
                                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2 text-center">
                                <button type="submit" class="btn btn-login btn-lg btn-block">
                                    {{ __('SIGN IN WITH EMAIL') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2 text-center">
                                Not a member?
                                <a class="btn btn-link" href="{{ route('register') }}">
                                    {{ __('SIGN UP!') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('partials.footer_search')
@endsection