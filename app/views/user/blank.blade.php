@extends('_master')

@section('filter')
  <!--  we want the date_picker to be included -->
  @include('includes.date_picker')
@stop

@section('content')

@stop

@section('scripts')
    {{ HTML::script('js/users.js') }}
@stop
