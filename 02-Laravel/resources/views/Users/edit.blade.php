@extends('layouts.app')

@section('title', 'Edit my profile')

@section('content')

<div class='container mx-auto'>

  <h1 class="text-xl font-thin leading-10 border-b-2 text-center w-full">{{ $title }}</h1>

  <form method='post' action={{ route('users.update', $user->id) }} class="font-light">
    @csrf
    @method('put')

    <div class="grid grid-flow-col grid-cols-2 m-4">
      <div class="self-center text-right mr-8">
        <label for="name">{{ __('Name') }}</label>
      </div>
      
      <div>
        <input id="name" type="text" class="p-4 w-full border-2 rounded @error('name') border-red-600 @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
        
        @error('name')
        <span class="text-red-600" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    
    
    <div class="grid grid-flow-col grid-cols-2 m-4">
      <div class="self-center text-right mr-8">
        <label for="nickname">{{ __('Nickname') }}</label>
      </div>
      
      <div>
        <input id="nickname" type="text" class="p-4 w-full border-2 rounded @error('nickname') border-red-600 @enderror" name="nickname" value="{{ $user->nickname }}" required autocomplete="nickname" autofocus>
        
        @error('nickname')
        <span class="text-red-600" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <div class="grid grid-flow-col grid-cols-2 m-4">
      <div class="self-center text-right mr-8">
        <label for="email">{{ __('E-Mail Address') }}</label>
      </div>
      
      <div>
        <input id="email" type="email" class="p-4 w-full border-2 rounded @error('email') border-red-600 @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>
        
        @error('email')
        <span class="text-red-600" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <div class="text-center">
        <button type="submit" class="bg-green-700 m-2 p-4 border-2 border-white text-white rounded-lg">
            {{ __('Register changes') }}
        </button>
    </div>
  </form>
</div>
@endsection