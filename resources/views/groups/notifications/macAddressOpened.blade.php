@extends('layouts.mail')

@section('body')
<P>
  La saisie des adresses est ouverte jusqu'au {{ $notification->data['deadline_mac_addresses'] }}.
</P>
@stop
