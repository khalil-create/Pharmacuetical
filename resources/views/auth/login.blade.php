@extends('layouts.app')

@section('content')
<div class="login-box">
    <div class="card card-outline card-primary">
        {{-- <div class="col-md-8">
            <div class="card"> --}}
                <div class="card-header text-center">{{ __('Login') }}</div>

                <div class="card-body" dir="ltr">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- <div class="form-group row"> --}}
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                            <div class="input-group mb-3">
                                <input id="email" dir="ltr" placeholder="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        {{-- </div> --}}
                        {{-- <div class="input-group mb-3"> --}}
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}
                            <div class="input-group mb-3">
                                <input id="password" placeholder="password" dir="ltr" placeholder="كلمة السر" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        {{-- </div> --}}
                        <div class="row" style="float: left">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            
                        </div>
                    </form>
                </div>
            {{-- </div>
        </div> --}}
    </div>
</div>
@endsection
