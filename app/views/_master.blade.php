<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>@yield('title', 'TwitterBoard')</title>
    <link rel="stylesheet" href='{{ URL::asset('css/style.css') }}' >
    @yield('head')
  </head>
  <body>

    @yield('content')

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>

    @yield('footer')

  </body>
</html>
