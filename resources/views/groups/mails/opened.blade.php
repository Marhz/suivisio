@extends('layouts.mail')

@section('body')
<P>
  La
  <a href="{{config('app.url').'/macAddress'}}">
    saisie des situations professionnelles
  </a>
    est ouverte, elle sera close
    {{ (new Carbon($notification->data['deadline']))->diffForHumans() }}.
</P>
@stop