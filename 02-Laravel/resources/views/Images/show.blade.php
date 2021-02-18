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
</div>
@endsection
