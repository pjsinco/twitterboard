@extends('_master')

@section('content')

@foreach($data as $user)

  <h3><a href='{{ $user->url }}' title='{{ $user->screen_name }} on Twitter'>
    &commat;{{ $user->screen_name }}
  </h3>

@endforeach

@stop
