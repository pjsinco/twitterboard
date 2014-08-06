@extends('_master')

@section('content')

  <h4>Top hashtags tweeted by leaders</h4>

  <table>

    <thead>
      <tr>
        <th width='100'>Count</th>
        <th width='200'>Tag</th>
      </tr>
    </thead>
    <tbody>
    @foreach($tags as $tag)
      <tr>
        <td>{{ $tag->count }}</td>      
        <td>#{{ $tag->tag }}</td>      
      </tr>
    @endforeach
    </tbody>
  </table>
@stop
