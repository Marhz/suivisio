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
		<div class="panel-heading">Renseigner mon adresse MAC</div>
		<div class="panel-body">
			{{Form::model($user,['method' => 'post','url' => 'macAddress'])}}
        <input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" />
        <div class="form-group">
					{{Form::label('address','Adresse MAC :')}}
					{{Form::text('address',$address, null,['id' => 'address', 'class' => 'form-control', /*'multiple'*/])}}
				</div>
					{{Form::submit('Enregistrer',['class' => 'btn btn-primary form-control'])}}
			{{Form::close()}}
		</div>
	</div>
@endsection
