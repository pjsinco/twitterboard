@extends('_master')

@section('content')
  <h4>Top {{ $entities }} by leaders</h4>
  @foreach($users as $user)

    <div class="panel">
      <span class='label right'>{{ $user->count }} {{ $entities }}</span>
      <p class="left"><img src="{{ $user->profile_image_url }}"></p>
      <div class="name">
        {{ $user->name }} <a href="{{ URL::route('user', array($user->screen_name)) }}">&commat;{{ $user->screen_name }}</a>
      </div>
      <div class="description">
        <p>{{ $user->description }}<br>
        {{ $user->location }} <a href='{{ $user->url }}' title='{{ $user->screen_name }} on Twitter'>{{ $user->url }}</a></p>
      </div>
      
      <ul class='inline-list'>
        <li><strong>Followers:</strong> {{ number_format($user->followers_count) }}</li>
        <li><strong>Following:</strong> {{ number_format($user->friends_count) }}</li>
        <li><strong>Tweets:</strong> {{ number_format($user->statuses_count) }}</li>
        <li><strong>Listed:</strong> {{ number_format($user->listed_count) }}</li>
        <li><strong>Created:</strong> {{ $user->created_at }}</li>
      </ul>
    </div> <!-- end .panel  -->
  @endforeach
@stop


