@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="bg-gray-100 rounded-xl p-8">
        <div class="text-xl font-thin leading-10 border-b-2 text-center w-full">
            {{ __('Login') }}
        </div>

        <div class="font-light">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="grid grid-flow-col grid-cols-2 m-4">
                    <div class="self-center text-right mr-8">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                    </div>

                    <div>
                        <input id="email" type="email" class="p-4 w-full border-2 rounded @error('email') border-red-600 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="text-red-600" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-flow-col grid-cols-2 m-4">
                    <div class="self-center text-right mr-8">
                        <label for="password">{{ __('Password') }}</label>
                    </div>

                    <div>
                        <input id="password" type="password" class="p-4 w-full border-2 rounded @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="text-red-600" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="text-center">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-checkbox h-4 w-4" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="self-center text-right mr-8" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                    <div class='text-center'>
                        <button type="submit" class="bg-green-700 m-2 p-4 border-2 border-white text-white rounded-lg">
                            {{ __('Login') }}
                        </button>
                    </div>
                    
                    <div class='text-center'>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
