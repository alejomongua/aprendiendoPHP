@extends('layouts.app')

@section('title', 'Welcome to Laravel')

@section('content')
<div class='container mx-auto'>
  <h1 class="text-xl font-thin leading-10 border-b-2 text-center w-full">
    You are logged in as {{$user->nickname}}
  </h1>

  <div class="font-thin my-8">
    <a class="bg-green-700 m-8 p-4 border-2 border-white text-white rounded-lg" href="{{ route('images.create') }}">
        {{ __('Upload new image') }}
    </a>
  </div>
</div>
@endsection