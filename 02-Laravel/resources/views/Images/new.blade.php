@extends('layouts.app')

@section('content')
<div class="container mx-auto">
  <div class="bg-gray-100 rounded-xl p-8" data-controller='imageUpload'>
    <h1 class="text-xl font-thin leading-10 border-b-2 text-center w-full">
      {{ __('Upload a new image') }}
    </h1>

      <div class="flex justify-items-auto">
        <div class="w-full m-3">
          <form method="POST" action="{{ route('images.store') }}" enctype="multipart/form-data">
              @csrf

              <input 
                type="file"
                name="image"
                class="p-4 w-full border-2 rounded @error('image') border-red-600 @enderror"
                name="image"
                value="{{ old('image') }}"
                required
                autofocus
                data-imageUpload-target='input'
                data-action='change->imageUpload#render'
              />
            <button type="submit" class="bg-green-700 m-8 p-4 border-2 border-white text-white rounded-lg">
                {{ __('Submit') }}
            </button>

          </form> 
        </div>
        <div class="w-full m-3">
          <div class="bg-gray-200 font-thin text-5xl text-gray-400 p-5 text-center border rounded-lg border-gray-400" data-imageUpload-target="placeholder">
            {{ __('Image preview') }}
          </div>
          <img
            data-imageUpload-target='image'
            class="hidden"
          />
      </div>
    </div>
</div>
@endsection
