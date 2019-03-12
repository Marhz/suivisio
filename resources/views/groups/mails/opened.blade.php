@extends('layouts.mail')

@section('body')
<P>
  La
  <a href="{{config('app.url').'/macAddress'}}">
    saisie des adresses MAC
  </a>
    est ouverte, elle sera close
    {{ (new Carbon($notification->data['mac_address_deadline']))->diffForHumans() }}.
</P>
@stop
