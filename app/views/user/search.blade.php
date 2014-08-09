@extends('_master')

@section('filter')
  @include('includes.search')
@stop

@section('content')
@stop

@section('scripts')
    {{ HTML::script('js/users-search.js') }}
@stop

