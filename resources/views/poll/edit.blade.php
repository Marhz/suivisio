@extends('layouts.app')

@section('content')
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif
  @if ($errors->has('address'))
    <div class="alert alert-danger">
      {{ $errors->first('address') }}
    </div>
  @endif

	<div class="panel panel-default">
		<div class="panel-heading">Choisir une option</div>
		<div class="panel-body">
      @if($user->isStudent() && $user->group->poll_deadline != null)
        Verrouillage le
                {{ (new Carbon($user->group->poll_deadline))->formatLocalized('%d/%m/%Y à %H heures') }}
                ({{ (new Carbon($user->group->poll_deadline))->diffForHumans()}})
        <hr>
      @endif
      @if(isset($poll))
        {{Form::open(['method' => 'put','url' => 'poll/'.$user->id])}}
      @else
        {{Form::open(['method' => 'post','url' => 'poll'])}}
      @endif
        <div class="form-group">
            {{Form::label('polls','Mon choix :')}}
            {{Form::select('polls[]',$polls, (isset($poll) ? $poll->id : 0), ['id' => 'polls', 'class' =>'form-control'])}}
        </div>
        @can('edit',\App\Models\Poll::class)
					{{Form::submit('Enregistrer',['class' => 'btn btn-primary form-control'])}}
        @endcan
			{{Form::close()}}
		</div>
	</div>
@endsection
