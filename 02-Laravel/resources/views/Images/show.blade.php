@extends('layouts.app')

@section('content')
<div class="container mx-auto">
  <div class="bg-gray-100 rounded-xl p-8">
    <div class="flex justify-items-auto">
      <div class="w-full m-3">
        <p>{{ $image->description }}</p>
      </div>
      <div class="w-full m-3">
        <img
          src="{{ route('images.get', $image->id) }}"
          data-imageUpload-target='image'
        />
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
