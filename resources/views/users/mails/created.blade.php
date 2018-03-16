@extends('layouts.mail')

@section('body')
<P>
  Votre compte sur <a href="{{ config('app.url') }}">{{ config('app.name') }}</a> a bien été créé.
  Connectez-vous avec le mot de passe par défaut <CODE>{{ $notification->data['password'] }}</CODE>
  (il vous sera demandé de le modifier à la première connexion).
</P>
@stop
