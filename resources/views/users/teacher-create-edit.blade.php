@extends('layouts.app')

@section('content')
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
	<div class="panel panel-default">
		<div class="panel-heading">{{isset($teacher) ? 'Modification' : 'Création'}} d'un professeur</div>
		<div class="panel-body">
			@if(isset($teacher))
				{{Form::model($teacher,['method' => 'put','url' => 'professeurs/'.$teacher->id])}}
			@else
				{{Form::open(['route' => 'professeurs.store'])}}
			@endif
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
                    {{Form::label('group_list','Classes :')}}
                    {{Form::select('group_list[]',$groups,null,['id' => 'activity_list', 'class' => 'form-control','multiple'])}}
                </div>
				<div class="form-group">
					{{Form::submit(isset($teacher) ? 'Modifier' : 'Créer', ['class' => 'btn btn-primary form-control'])}}
				</div>
			{{Form::close()}}
		</div>
	</div>
@endsection
@section('js')
	<script>
		$('#activity_list').select2({
            closeOnSelect : false,
        });
	</script>
@endsection