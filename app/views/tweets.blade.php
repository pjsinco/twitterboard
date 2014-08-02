@extends('_master')

@section('content')
  @foreach($tweets as $tweet)
  <div class="tweet">
    <p class="left"><img src="{{ $tweet->profile_image_url }}"></p>
    <div class='name'>
      {{ $tweet->name }} <a href="{{ URL::route('profile', array($tweet->screen_name)) }}">&commat;{{ $tweet->screen_name }}</a>
    </div>
    <div class='text'>
      {{ $tweet->tweet_text }}
    </div>
    <div class='meta'>
      <p><small>{{ $tweet->retweet_count }} retweets since {{ $tweet->created_at }} | {{ $tweet->retweet_count }} favorited</small></p>
    </div>
  </div> <!--   end .tweet -->
  @endforeach

@stop
