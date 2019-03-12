@extends('layouts.app')

@section('content')
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif
  @if ($errors->has('numeroCandidat'))
    <div class="alert alert-danger">
      {{ $errors->first('numeroCandidat') }}
    </div>
  @endif

	<div class="panel panel-default">
		<div class="panel-heading">Renseigner le numéro de candidat</div>
		<div class="panel-body">
			{{Form::model($user,['method' => 'post','url' => 'changerNumeroCandidat'])}}
        <input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" />
        <div class="form-group">
					{{Form::label('numeroCandidat','Numéro de candidat :')}}
					{{Form::text('numeroCandidat',null,['class' => 'form-control'])}}
				</div>
        <div class="form-group">
          {{Form::label('portefeuille','URL du portefeuille de compétences:')}}
          {{Form::text('portefeuille',null,['class' => 'form-control'])}}
        </div>
					{{Form::submit('Enregistrer',['class' => 'btn btn-primary form-control'])}}
				<!--/div-->
			{{Form::close()}}
		</div>
	</div>
@endsection
