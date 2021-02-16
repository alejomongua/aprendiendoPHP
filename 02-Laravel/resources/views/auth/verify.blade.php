@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="bg-gray-100 rounded-xl p-8">
        <h1 class="text-xl font-thin leading-10 border-b-2 text-center w-full">
            {{ __('Verify Your Email Address') }}
        </h1>

        <div>
            @if (session('resent'))
                <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
                    <span class="inline-block align-middle mr-8">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </span>
                </div>
            @endif

            <div class='mt-4'>
                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
                <form class="inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="underline text-blue-600 hover:text-blue-800 visited:text-purple-600">
                        {{ __('click here to request another') }}
                    </button>.
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
