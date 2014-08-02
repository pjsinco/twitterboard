<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>@yield('title', 'TwitterBoard')</title>
    <link rel="stylesheet" href='{{ URL::asset('css/foundation.css') }}' >
    @yield('head')
  </head>
  <body>

    <div class="row">
      <div class="large-12 columns">
        <h1>TwitterBoard</h1>
        <hr>
      </div>
    </div> <!-- end row -->

    <!-- side navigation -->
    <div class="row">
      <div class="large-4 columns">
        <strong>Leaders</strong>
        <ul class="side-nav">
          <li><a href="#">Leader tweets</a></li>
          <li><a href="#">Popular leader tweets</a></li>
          <li><a href="#">Accounts most mentioned by leaders</a></li>
          <li><a href="#">Accounts most retweeted by leaders</a></li>
          <li><a href="#">Tags tweeted by leaders</a></li>
        </ul>
        <strong>Circle</strong>
        <ul class="side-nav">
          <li><a href="#">All tweets</a></li>
          <li><a href="#">Search tweets</a></li>
          <li><a href="#">Search users</a></li>
          <li><a href="#">Most frequent mentioners</a></li>
          <li><a href="#">Most frequent retweeters</a></li>
          <li><a href="#">Tags tweeted by circle</a></li>
        </ul>
        <strong>Us</strong>
        <ul class="side-nav">
          <li><a href="#">All tweets</a></li>
          <li><a href="#">Popular tweets</a></li>
          <li><a href="#">Most frequent mentioners of us</a></li>
          <li><a href="#">Most frequent retweeters of us</a></li>
          <li><a href="#">Tags tweeted by us</a></li>
        </ul>
      </div> <!-- end large-4 -->

      <div class="large-8 columns">
        <div class="search">
          
        </div>
        <div class="content">
          @yield('content')
        </div>
      </div> <!-- end large-8 -->
    </div> <!-- end row -->

    <!-- footer -->
    <footer class="row">
      <div class="large-12 columns">
        <hr />
        <div class="row">
          <div class="large-6 columns">
            @yield('footer')
          </div>
        </div>
      </div>
    </footer>

    {{ HTML::script('js/vendor/jquery.js') }}
    {{ HTML::script('js/vendor/modernizr.js') }}
  </body>
</html>
