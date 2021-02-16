@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="bg-gray-100 rounded-xl p-8">
        <h1 class="text-xl font-thin leading-10 border-b-2 text-center w-full">
            {{ __('Reset Password') }}
        </h1>


        <div class="font-light">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                
                <input type="hidden" name="token" value="{{ $token }}">
            
                <div class="grid grid-flow-col grid-cols-2 m-4">
                    <div class="self-center text-right mr-8">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
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
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                    </div>

                    <div>
                        <input id="password" type="password" class="p-4 w-full border-2 rounded @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="text-red-600" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>

                <div class="grid grid-flow-col grid-cols-2 m-4">
                    <div class="self-center text-right mr-8">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                    </div>

                    <div>
                        <input id="password-confirm" type="password" class="p-4 w-full border-2 rounded" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class='text-center'>
                    <button type="submit" class="bg-green-700 m-2 p-4 border-2 border-white text-white rounded-lg">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
