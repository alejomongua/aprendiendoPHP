@extends('layouts.app')

@section('content')
<div class="container mx-auto">
  <div class="bg-gray-100 rounded-xl p-8">
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
  </div>
  @if ($image->user->id === Auth::user()->id)
    <div class=my-4>
      <a class="bg-green-700 m-2 p-4 border-2 border-white text-white rounded-lg" href="{{ route('users.convertInProfile', $image->id) }}">
        {{ __('Convert in profile picture') }}
      </a>
    </div>
  @endif
</div>
@endsection
