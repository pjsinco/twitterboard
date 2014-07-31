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
          <li><strong>Followers</strong> {{ number_format($user->followers_count) }}</li>
          <li><strong>Following</strong> {{ number_format($user->friends_count) }}</li>
          <li><strong>Tweets</strong> {{ number_format($user->statuses_count) }}</li>
          <li><strong>Listed</strong> {{ number_format($user->listed_count) }}</li>
          <li><strong>Tweeting since</strong> {{ date_format(new DateTime($user->created_at), 'F Y') }}</li>
        </ul>
      </div> <!-- end large-10 -->
    </div> <!-- end row -->
    <div class="row">
      <div class="columns large-offset-2 large-10">
        <h3>
          Twitter stats <small>(for most recent {{ $tweets->total_tweets }} tweets, 
          since {{ date_format(new DateTime($tweets->tweets_since), 'F j, Y') }})</small>
        </h3>
        <ul class="inline-list">
          <li><strong>Tweets per day</strong> {{ $tweets_per_day }}</li>
          <li><strong>Retweeted per day</strong>{{ $retweeted_per_day  }}</li>
          <li><strong>Retweeted per tweet</strong>{{ $retweeted_per_tweet }}</li>
          <li><strong>Mentioned per day</strong> {{ $mentioned_per_day }}</li>
        </ul>
      </div>
    </div> <!-- end row -->
    <div class="row">
      <div class="columns large-offset-2 large-3">
        Favorite hashtags<br>
        <ul>
          @foreach($favorite_tags as $tag_stat)
            <li><strong>#{{ $tag_stat->tag }}</strong> {{ $tag_stat->count }} tweet{{ $tag_stat->count > 1 ? 's' : '' }}</li>
          @endforeach
        </ul>
      </div> <!-- end columns -->
      <div class="columns large-3">
        Top mentions
        <ul>
          
        </ul>
        
      </div> <!-- end columns -->
      <div class="columns large-4">
        Top mentioners of {{ $user->screen_name }}
        <ul>
          
        </ul>
      </div> <!-- end columns  -->
  
    </div> <!-- end row -->
@stop
