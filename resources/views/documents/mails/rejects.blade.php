@extends('layouts.mail')

@section('body')
<P>
  Votre document
  <a href="{{ url('/documents/'.$notification->data['document']) }}">
    {{ $notification->data['document_name'] }}</a>
  a été refusé :
  {{ $notification->data['comment'] }}</a>
</P>
@stop
