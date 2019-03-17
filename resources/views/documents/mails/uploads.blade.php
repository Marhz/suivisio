@extends('layouts.mail')

@section('body')
<P>
  {{ $notification->data['user_name'] }} a déposé un document dans
  <a href="{{ url('classes/'.$notification->data['group'].'/documents/'.$notification->data['document']) }}">
    {{ $notification->data['document_name'] }}
  </a>.
</P>
@stop
