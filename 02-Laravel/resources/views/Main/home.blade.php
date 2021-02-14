@extends('layouts.app')

@section('title', 'Welcome to Laravel')

@section('content')
<div class='container mx-auto'>
  <h1>You are logged in as {{$user->nickname}}</h1>

  <p>To do: render home page after login</p>
</div>
@endsection