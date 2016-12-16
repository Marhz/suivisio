@extends('layouts.app')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Mot de passe par défaut</div>
		<div class="panel-body">
			{{Form::open()}}
				<div class="form-group">
					{{Form::label('password','Mot de passe par défault :')}}
					{{Form::text('password',$password,['class' => 'form-control'])}}
				</div>
				<div class="form-group">
					{{Form::submit('Changer')}}
				</div>
			{{Form::close()}}
		</div>
	</div>
@endsection
 