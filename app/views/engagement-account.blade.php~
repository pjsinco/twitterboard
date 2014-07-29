@extends('_master')

@section('content')
<div class="header">
  <h4 class='subheader'>Engagement account</h4>
  <h1>&commat;{{ $acct }}</h1>
  <div class='user-desc'>
    {{ $user->description }}
  </div>
  <div class='user-loc'>
    {{ $user->location }} <a href='{{ $user->url }}' title='{{ $user->screen_name }} on Twitter'>{{ $user->url }}</a>
  </div>
  <ul class='inline-list'>
    <li><strong>Followers:</strong> {{ $user->followers_count }}</li>
    <li><strong>Following:</strong> {{ $user->friends_count }}</li>
    <li><strong>Tweets:</strong> {{ $user->statuses_count }}</li>
    <li><strong>Listed:</strong> {{ $user->listed_count }}</li>
    <li><strong>Created:</strong> {{ $user->created_at }}</li>
  </ul>
</div>
<div class="data">
  
</div>
@stop
