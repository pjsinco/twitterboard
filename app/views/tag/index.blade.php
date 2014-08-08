@extends('_master')

@section('filter')
  <!--  we want the date_picker to be included -->
  @include('includes.date_picker')
@stop

@section('content')

  <h4>Top hashtags tweeted by {{ $group }}</h4>

  <table class='tags'>
    <thead>
      <tr>
        <th width='100'>Count</th>
        <th width='200'>Tag</th>
      </tr>
    </thead>
    <tbody>

    </tbody>
  </table>
@stop

@section('scripts')
    {{ HTML::script('js/tags.js') }}
@stop
