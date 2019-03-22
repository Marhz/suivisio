@extends('layouts.mail')

@section('body')
<P>
  Votre document
  <a href="{{ url('/documents/'.$notification->data['document']) }}">
    {{ $notification->data['document_name'] }}</a>
  a été refusé pour les raisons suivantes :
  <hr>
  {{ $notification->data['comment'] }}</a>
  <hr>
</P>
@stop
