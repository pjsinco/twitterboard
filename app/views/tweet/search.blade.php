@extends('_master')

@section('filter')
  @include('includes.search')
@stop

@section('content')
@stop

@section('scripts')
    {{ HTML::script('js/tweets-search.js') }}
@stop
