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
        <h3><a href="{{ URL::route('home') }}" title="">TwitterBoard</a></h3>
        <hr>
      </div>
    </div> <!-- end row -->

    <!-- side navigation -->
    <div class="row">
      <div class="large-4 columns">
        @include('includes.menu')
      </div> <!-- end large-4 -->

      <div class="large-8 columns">
        @yield('date_picker')

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
    {{ HTML::script('js/vendor/jquery-ui.min.js') }}
    {{ HTML::script('js/date_picker.js') }}
    {{ HTML::script('js/vendor/modernizr.js') }}
    @yield('scripts')
  </body>
</html>
