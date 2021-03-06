@extends('layouts.app')

@section('content')
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
	<div class="panel panel-default">
		<div class="panel-heading">Utilisateur {{ $user->fullName() }}</div>
		<div class="panel-body">
			{{Form::model($user,['url' => 'prrofesseurs/'.$user->id])}}
				<div class="form-group">
					{{Form::label('last_name','Nom :')}}
					{{Form::text('last_name',null,['class' => 'form-control', 'readonly'])}}
				</div>
				<div class="form-group">
					{{Form::label('first_name','Prénom :')}}
					{{Form::text('first_name',null,['class' => 'form-control', 'readonly'])}}
				</div>
        <div class="form-group">
					{{Form::label('numeroCandidat','Numéro de candidat :')}}
					{{Form::text('numeroCandidat',null,['class' => 'form-control', 'readonly'])}}
				</div>
				<div class="form-group">
					{{Form::label('email','Mail :')}}
					{{Form::email('email',null,['class' => 'form-control', 'readonly'])}}
				</div>
				<div class="form-group">
          {{Form::label('group_list','Classes :')}}
          {{Form::select('group_list[]',$groups,null,['id' => 'activity_list', 'class' => 'form-control','multiple', 'disabled'])}}
				</div>
			{{Form::close()}}
		</div>
	</div>
@endsection
