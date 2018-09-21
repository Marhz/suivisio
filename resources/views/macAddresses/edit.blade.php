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
      @if($user->isStudent() && $user->group->mac_address_deadline != null)
        Verrouillage le
                {{ (new Carbon($user->group->mac_address_deadline))->formatLocalized('%d/%m/%Y à %H heures') }}
                ({{ (new Carbon($user->group->mac_address_deadline))->diffForHumans()}})
        <hr>
      @endif
      @if(isset($address))
        {{Form::open(['method' => 'put','url' => 'macAddress/'.$address->id])}}
      @else
        {{Form::open(['method' => 'post','url' => 'macAddress'])}}
      @endif
        <div class="form-group">
            {{Form::label('address','Adresse MAC :')}}
            {{Form::text('address',$address, null,['id' => 'address', 'class' => 'form-control',''])}}
				</div>
        @can('editMacAddress', Auth::user())
					{{Form::submit('Enregistrer',['class' => 'btn btn-primary form-control'])}}
        @endcan
			{{Form::close()}}
		</div>
	</div>
@endsection
