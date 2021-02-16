@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="bg-gray-100 rounded-xl p-8">
        <div class="text-xl font-thin leading-10 border-b-2 text-center w-full">
            {{ __('Confirm Password') }}
        </div>
        
        <div class='mt-4'>
            {{ __('Please confirm your password before continuing.') }}
        </div>
        
        <div class="font-light">
            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf
                
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
                
                <div class='text-center'>
                    <button type="submit" class="bg-green-700 m-2 p-4 border-2 border-white text-white rounded-lg">
                        {{ __('Confirm Password') }}
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

