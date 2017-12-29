<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="Scotch">

<!-- load bootstrap from a cdn -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/twitter-bootstrap/3.0.3/css/bootstrap-combined.min.css">

<P>Bonjour {{ $user->fullName() }},</P>

<P>Votre compte sur <a href="{{ config('app.url') }}">{{ config('app.name') }}</a> a bien été créé.
Connectez-vous avec votre password <CODE>{{ config('app.defaultPassword') }}</CODE> (il vous sera demandé
de le modifier à la première connexion).
</P>

<P>A bientôt,<BR>
Les Admins.
</P>
