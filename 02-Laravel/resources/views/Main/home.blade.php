@extends('layouts.app')

@section('title', 'Welcome to Laravel')

@section('content')
<div class='container mx-auto'>
  <h1 class="text-xl font-thin leading-10 border-b-2 text-center w-full">
    {{ __('You are logged in as') . $user->nickname}}
  </h1>

  <div class="font-thin my-8">
    <a class="bg-green-700 m-8 p-4 border-2 border-white text-white rounded-lg" href="{{ route('images.create') }}">
        {{ __('Upload new image') }}
    </a>
  </div>

  <h2 class="text-lg font-light leading-8 border-b-2 text-center">
    {{ __('Recent images') }}
  </h2>

  <div class="w-1/2 m-auto">
    @foreach ($images as $image)
      <div class="bordered border-gray-400 m-4 m-2 p-4 bg-gray-200 text-gray-700 ">
        <div class="h-16 m-2">
          <a href="{{ route('users.show', $image->user->id) }}">
            @if ($image->user->profile_image_id)
              <img
                class="rounded-full h-12 w-12 inline mr-4"
                src={{ route('images.get', $image->user->profile_image_id) }}
              />
            @endif
            <div class='inline font-bold'>
              {{ $image->user->nickname }}
            </div>
          </a>
        </div>
        <a href="{{ route('images.show', $image->id) }}">
          <div>
            <img src="{{ route('images.get', $image->id) }}" />
          </div>
          <div class="font-light bordered rounded">
            {{ $image->description }}
          </div>
          <div class="m-2 p-4 italic font-thin text-sm">
            {{ __('Uploaded on ') . $image->created_at->format('l j F Y H:i:s') }}
          </div>
        </a>
      </div>
    @endforeach
    <div>
      {{ $images->links() }}
    </div>
  </div>

</div>
@endsection