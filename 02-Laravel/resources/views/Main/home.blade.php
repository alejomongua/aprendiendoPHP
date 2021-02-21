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
      <div class="bordered border-gray-400 m-4 p-4 bg-gray-200 text-gray-700" data-controller="like" data-like-url-value='{{ route('like', $image->id) }}'>
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

        <a href="#" class="underline text-blue-600 hover:text-blue-800 visited:text-purple-600">
          {{ __('Comments') }}
        </a>

        <span class="text-red-500 cursor-pointer" data-action="click->like#likeAction">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="m-4 inline" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" class="{{ $image->likedByMe() ? '' : 'hidden' }}" data-like-target="icon" />
            <path d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
          </svg>
          <span class="inline m-4" data-like-target="text">{{ $image->likedByMe() ? 'Unlike' : 'Like' }}</span>
        </span>
      </div>
    @endforeach
    <div>
      {{ $images->links() }}
    </div>
  </div>

</div>
@endsection