@extends('layouts.mail')

@section('body')
<P>
  Votre document
  <a href="{{ url('/documents/'.$notification->data['document']) }}">
    {{ $notification->data['document_name'] }}</a>
  a été validé par un professeur.
</P>
@stop
