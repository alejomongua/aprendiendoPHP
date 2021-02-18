@extends('layouts.app')

@section('title', $title)

@section('content')

<div class='container mx-auto font-light'>
  <h1 class="text-xl font-thin leading-10 border-b-2 text-center w-full">{{ $title }}</h1>
  
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
    <div class="md:col-span-2 lg:col-span-3 xl:col-span-4">
      <div class="grid grid-flow-col grid-cols-2 m-4">
        <div class="self-center text-right mr-8">
          {{ __('Name') }}
        </div>
        
        <div>
          {{ $user->name }}
        </div>
      </div>
      
      
      <div class="grid grid-flow-col grid-cols-2 m-4">
        <div class="self-center text-right mr-8">
          {{ __('Nickname') }}
        </div>
        
        <div>
          {{ $user->nickname }}
        </div>
      </div>

      <div class="grid grid-flow-col grid-cols-2 m-4">
        <div class="self-center text-right mr-8">
          {{ __('E-Mail Address') }}
        </div>
        
        <div>
          {{ $user->email }}
        </div>
      </div>
    </div>
    <div class='text-center'>
      <div class='m-16 sm:m-2'>
        @if ($user->profile_image_id)
          <img src={{ route('images.get', $user->profile_image_id) }} />
        @else
          @include('Common.profile')
        @endif
      </div>
    </div>
  </div>
</div>

@endsection