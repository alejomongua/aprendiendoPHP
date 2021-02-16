@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="bg-gray-100 rounded-xl p-8">
        <h1 class="text-xl font-thin leading-10 border-b-2 text-center w-full">
            {{ __('Reset Password') }}
        </h1>

        <div class="font-light">
            @if (session('status'))
                <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
                    <span class="inline-block align-middle mr-8">
                        {{ session('status') }}
                    </span>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

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

                <div class='text-center'>
                    <button type="submit" class="bg-green-700 m-2 p-4 border-2 border-white text-white rounded-lg">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
