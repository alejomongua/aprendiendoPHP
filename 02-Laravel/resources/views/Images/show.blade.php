@extends('layouts.app')

@section('content')
<div class="container mx-auto">
  <div class="bg-gray-100 rounded-xl p-8 pb-2">
    <div class="grid grid-cols-1 md:grid-cols-2 justify-items-auto">
      <div class="m-3">
        <img
          src="{{ route('images.get', $image->id) }}"
          data-imageUpload-target='image'
        />
      </div>
      <div class="m-3">
        <div class="m-2 p-4 bg-gray-200 text-gray-700 font-light bordered rounded">
          {{ $image->description }}
        </div>

        <div class="m-2 p-4 italic font-thin text-sm">
          {{ __('Uploaded by') }}
          @if (Auth::user()->id === $image->user->id)
            {{ __('me') }}
          @else
            <a href="{{ route('users.show', $image->user->id) }}">
              {{ $image->user->nickname }}
            </a>
          @endif
          {{ __('on ') . $image->created_at->format('l j F Y H:i:s') }}
        </div>
      </div>
    </div>
    <div data-controller="like" data-like-url-value='{{ route('images.like', $image->id) }}'>
      <span class="text-red-500 cursor-pointer" data-action="click->like#likeAction">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="m-4 inline" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" class="{{ $image->likedByMe() ? '' : 'hidden' }}" data-like-target="icon" />
          <path d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
        </svg>
        <span class="inline m-4" data-like-target="text">{{ $image->likedByMe() ? 'Unlike' : 'Like' }}</span>
      </span>
      <span class="inline m-4"><span data-like-target="conteo">{{ $image->likes->count() }}</span> <span data-like-target="plural">{{ $image->likes->count() === 1 ? 'like' : 'likes' }}</span></span>
    </div>
    <div class="p-8 mt-4 bg-gray-100 rounded boreder border-gray-400">
      @foreach ($image->comments as $comment)
        <div class="italic m-2">
          {{ $comment->content }}
        </div>
        <div class="font-light text-sm italic m-2">
          {{ __('By') }} 
          {{ $comment->user->nickname }}
          {{ __('on') }} 
          {{ $comment->created_at->format('l j F Y H:i:s') }}
        </div>
        <hr class="my-2">
      @endforeach
      <form action="{{ route('images.comment', $image->id) }}" method="post">
        @csrf
        <textarea
          class="h-24 border border-gray-400 rounded w-full p-2"
          placeholder="{{ __('Write your comment') }}"
          name="comment"></textarea>
        <button class="bg-green-700 mt-8 p-4 border-2 border-white text-white rounded-lg" type="submit">
          {{ __('Send comment') }}
        </button>
      </form>
    </div>
  </div>
  @if ($image->user->id === Auth::user()->id)
    <div class="my-4">
      <a class="bg-green-700 m-2 p-4 border-2 border-white text-white rounded-lg" href="{{ route('users.convertInProfile', $image->id) }}">
        {{ __('Convert in profile picture') }}
      </a>
    </div>
  @endif
</div>
@endsection
