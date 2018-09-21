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
		<div class="panel-heading">
        {{isset($address) ? "Modifier l'adresse MAC" : "Ajouter une adresse MAC"}}
    </div>
		<div class="panel-body">
      @if(isset($address))
        {{Form::open(['method' => 'put','url' => 'macAddress/'.$address->id])}}
      @else
        {{Form::open(['method' => 'post','url' => 'macAddress'])}}
      @endif
        <div class="form-group">
          {{Form::label('address','Adresse MAC :')}}
          {{Form::text('address',isset($address) ? $address->address : null, null,['id' => 'address', 'class' => 'form-control',''])}}
          {{Form::submit('Enregistrer',['class' => 'btn btn-primary'])}}
        </div>
      {{Form::close()}}
		</div>
	</div>
@endsection
