@extends('_master')

@section('content')
  <div class="user">
    
    <div class="header">
      <h1 class='subheader'>
        <img src="{{ $user->profile_image_url }}" alt="Profile image of {{ $user->screen_name }}" />
        &commat;{{ $user->screen_name }}
      </h1>
      <hr>
    </div>
    <div class="row">
      <div class="columns large-12">
        <div class="description">
          <p>{{ $user->description }}<br>
          {{ $user->location }} <a href='{{ $user->url }}' title='{{ $user->screen_name }} on Twitter'>{{ $user->url }}</a></p>
        </div>
      </div> <!-- end col large-10 -->
    </div> <!-- end row -->
    <div class="row">
      <div class="columns large-12">
        <ul class='inline-list'>
          <li><strong>Followers</strong> {{ number_format($user->followers_count) }}</li>
          <li><strong>Following</strong> {{ number_format($user->friends_count) }}</li>
          <li><strong>Tweets</strong> {{ number_format($user->statuses_count) }}</li>
          <li><strong>Listed</strong> {{ number_format($user->listed_count) }}</li>
          <li><strong>Tweeting since</strong> {{ date_format(new DateTime($user->created_at), 'F Y') }}</li>
        </ul>
      </div> <!-- end large-10 -->
    </div> <!-- end row -->
    <hr>
    <div class="row">
      <div class="columns large-12">
        <h3>
          Key indicators <small>for most recent {{ number_format($tweets->total_tweets) }} tweets&mdash;since 
          {{ date_format(new DateTime($tweets->tweets_since), 'F j, Y') }}</small>
        </h3>
      </div> <!-- end columns -->
    </div> <!-- end row -->
    <div class="row">
      <div class="columns large-12">
        <ul class="inline-list">
          <li><strong>Tweets per day</strong> {{ $tweets_per_day }}</li>
          <li><strong>Retweeted per day</strong>{{ $retweeted_per_day  }}</li>
          <li><strong>Retweeted per tweet</strong>{{ $retweeted_per_tweet }}</li>
          <li><strong>Mentioned per day</strong> {{ $mentioned_per_day }}</li>
        </ul>
      </div>
    </div> <!-- end row -->
    <div class="row">
      <div class="columns large-4">
        <h5>Favorite hashtags</h5>
        <ul class="no-bullet">
          @foreach($favorite_tags as $tag_stat)
            <li><strong>#{{ $tag_stat->tag }}</strong> {{ $tag_stat->count }} tweet{{ $tag_stat->count > 1 ? 's' : '' }}</li>
          @endforeach
        </ul>
      </div> <!-- end columns -->
      <div class="columns large-4">
      <h5>Top mentions</h5>
        <ul class="no-bullet">
          @foreach($most_mentioned as $mention)
            <li>
              <strong>
                <a href="{{ URL::route('user-profile', array($mention->screen_name)) }}" title="{{ 'hello' }} on Twitter">
                  &commat;{{ $mention->screen_name }}
                </a>
              </strong> 
              ({{ $mention->count }})
            </li>
          @endforeach
        </ul>
        
      </div> <!-- end columns -->
      <div class="columns large-4">
        <h5>Top mentioners of &commat;{{ $user->screen_name }}</h5>
        <ul class="no-bullet">
          @foreach($most_mentioners as $mentioner)
            <li>
              <strong>
                <a href="{{ URL::route('user-profile', array($mentioner->screen_name)) }}" title="{{ 'hello' }} on Twitter">
                  &commat;{{ $mentioner->screen_name }}
                </a>
              </strong> 
              ({{ $mentioner->count }})
            </li>
          @endforeach
        </ul>
      </div> <!-- end columns  -->
  
    </div> <!-- end row -->
@stop
