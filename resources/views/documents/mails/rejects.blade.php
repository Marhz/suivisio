@extends('layouts.mail')

@section('body')
<P>
  Votre document
  <a href="{{ url('/documents/'.$notification->data['document']) }}">
    {{ $notification->data['document_name'] }}</a>
  a été refusé pour les raisons suivantes :
  <hr>
  {!! nl2br($notification->data['comment']) !!}
  <hr>
</P>
@stop
