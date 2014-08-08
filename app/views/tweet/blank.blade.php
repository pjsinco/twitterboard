@extends('_master')

@section('date_picker')
  <!--  we want the date_picker to be included -->
  @include('includes.date_picker')
@stop

@section('content')

@stop

@section('scripts')
    {{ HTML::script('js/tweets.js') }}
@stop
