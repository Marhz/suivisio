@extends('layouts.app')

@section('content')
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
	<div class="panel panel-default">
		<div class="panel-heading">Modification d'un élève</div>
		<div class="panel-body">
			{{Form::model($user,['method' => 'put','url' => 'users/'.$user->id])}}
				<div class="form-group">
					{{Form::label('last_name','Nom :')}}
					{{Form::text('last_name',null,['class' => 'form-control'])}}
				</div>
				<div class="form-group">
					{{Form::label('first_name','Prénom :')}}
					{{Form::text('first_name',null,['class' => 'form-control'])}}
				</div>
				<div class="form-group">
					{{Form::label('email','Mail :')}}
					{{Form::email('email',null,['class' => 'form-control'])}}
				</div>
				<div class="form-group">
					{{Form::label('group_id','Classe :')}}
					{{Form::select('group_id',$groups,null,['class' => 'form-control'])}}
				</div>
				<div class="form-group">
					{{Form::submit('Envoyer',['class' => 'btn btn-primary form-control'])}}
				</div>
			{{Form::close()}}
		</div>
	</div>
@endsection