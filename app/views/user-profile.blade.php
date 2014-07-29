@extends('_master')

@section('content')
  <div class="user">
    
    <div class="header">
      <h4 class='subheader'>Profile of {{ $user->screen_name }} </h4>
    </div>
    <div class="row">
      <div class="columns large-2">
        <img src="{{ $user->profile_image_url }}" alt="Profile image of {{ $user->screen_name }}" />
      </div>
      <div class="columns large-10">
        <strong>&commat;{{ $user->screen_name }}</strong>
        <div class="description">
          {{ $user->description }}
        </div>
      </div>
    </div>

  </div>
@stop
