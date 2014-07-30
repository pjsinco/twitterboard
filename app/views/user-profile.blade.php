@extends('_master')

@section('content')
  <div class="user">
    
    <div class="header">
      <h4 class='subheader'>
        Profile of &commat;{{ $user->screen_name }}
      </h4>
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
      </div> <!-- end col large-10 -->
    </div> <!-- end row -->
    <div class="row">
      <div class="columns large-offset-2 large-10">
        <div class='user-loc'>
          {{ $user->location }} <a href='{{ $user->url }}' title='{{ $user->screen_name }} on Twitter'>{{ $user->url }}</a>
        </div>
        <ul class='inline-list'>
          <li><strong>Followers:</strong> {{ number_format($user->followers_count) }}</li>
          <li><strong>Following:</strong> {{ number_format($user->friends_count) }}</li>
          <li><strong>Tweets:</strong> {{ number_format($user->statuses_count) }}</li>
          <li><strong>Listed:</strong> {{ number_format($user->listed_count) }}</li>
          <li><strong>Created:</strong> {{ $user->created_at }}</li>
        </ul>
      </div> <!-- end large-10 -->
    </div> <!-- end row -->
    <div class="row">
      <div class="columns large-offset-2 large-10">
        <h3>
          Twitter stats <small>(dont' think this is helpful, as currently calculated)</small><br>
          <small>(More like, for the tweets we have gathered, which may only be 100, 150 or so,<br>
          these are the numbers)</small>
        </h3>
        <ul class="inline-list">
          <li><strong>Tweets per day</strong> {{ $tweets_per_day }}</li>
          <li><strong>Retweeted per day</strong>{{ $retweeted_per_day  }}</li>
          <li><strong>Retweeted per tweet</strong>{{ $retweeted_per_tweet }}</li>
          <li><strong>Mentioned per day</strong> {{ $mentioned_per_day }}</li>
        </ul>
        
      </div>
    </div> <!-- end row -->

      
  
    </div> <!-- end row -->
@stop
