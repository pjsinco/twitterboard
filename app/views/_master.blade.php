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
      <div class="large-10 columns">
        @yield('content')
      </div>
    </div>

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
