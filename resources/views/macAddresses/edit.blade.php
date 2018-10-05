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
      @if($user->isStudent() && $user->group->mac_address_deadline != null)
        Verrouillage le
                {{ (new Carbon($user->group->mac_address_deadline))->formatLocalized('%d/%m/%Y à %H heures') }}
                ({{ (new Carbon($user->group->mac_address_deadline))->diffForHumans()}})
        <hr>
      @endif
      @if(isset($address))
        {{Form::open(['method' => 'put','url' => 'macAddress/'.$address->id, 'class' => 'form-horizontal'])}}
      @else
        {{Form::open(['method' => 'post','url' => 'macAddress', 'class' => 'form-horizontal'])}}
      @endif
          @can('editLabel', \App\Models\MacAddress::class )
            <div class="form-group">
              {{Form::label('label','Label :', ['class' => 'col-md-4'])}}
              {{Form::text('label',$value = isset($address)&&isset($address->label)?$address->label:null, ['id' => 'label', 'class' => 'col-md-6'])}}
            </div>
          @endcan
          <div class="form-group">
            {{Form::label('address','Adresse MAC :', ['class' => 'col-md-4'])}}
            {{Form::text('address',isset($address)?$address->address:null, ['id' => 'address', 'class' => 'col-md-6' ])}}
    			</div>
        @if(isset($address) && Auth::user()->can('edit',$address)
          || Auth::user()->can('create',\App\Models\MacAddress::class))
					{{Form::submit('Enregistrer',['class' => 'btn btn-primary col-md-6 col-md-offset-4'])}}
        @endif
			{{Form::close()}}
		</div>
	</div>
@endsection
