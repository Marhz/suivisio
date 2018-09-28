@extends('layouts.app')

@section('content')
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif

	<div class="panel panel-default">
		<div class="panel-heading">
      Mon choix pour le deuxième semestre
    </div>
		<div class="panel-body">
      @if($user->isStudent() && $user->group->poll_deadline != null)
        Verrouillage le
                {{ (new Carbon($user->group->poll_deadline))->formatLocalized('%d/%m/%Y à %H heures') }}
                ({{ (new Carbon($user->group->poll_deadline))->diffForHumans()}})
        <hr>
      @endif
      @if(isset($poll))
          {{ $poll->name }}
      @else
          Pas de voeu sélectionné.
      @endif
      @can('edit', \App\Models\Poll::class)
        <a href="{{'/poll/'.(isset($poll)?$user->id.'/edit':'create')}}"><button class="btn btn-warning actionButton"><i class="fa fa-edit"></i></button></a>
      @else
        <i class="fa fa-lock"></i>
      @endcan
		</div>
	</div>
@endsection
