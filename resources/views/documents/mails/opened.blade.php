@extends('layouts.mail')

@section('body')
<P>
  Le téléversement de
  <a href="{{ url('/documents/'.$notification->data['document']) }}">{{ $notification->data['document_name'] }}</a>
  est ouvert.
</P>
@stop
