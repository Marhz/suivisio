@extends('layouts.app')

@section('content')
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif

	<div class="panel panel-default">
		<div class="panel-heading">
        @can('haveMany', \App\Models\MacAddress::class)
          Mes addresses
        @else
          Mon adresse
        @endcan
      MAC
    </div>
		<div class="panel-body">
      @if($user->isStudent() && $user->group->mac_address_deadline != null)
        Verrouillage le
                {{ (new Carbon($user->group->mac_address_deadline))->formatLocalized('%d/%m/%Y à %H heures') }}
                ({{ (new Carbon($user->group->mac_address_deadline))->diffForHumans()}})
        <hr>
      @endif
      @foreach($addresses as $address)
        <div class = "col-md-2 col-md-offset-2">
          {{ ($address->label != null)? $address->label : "" }}
        </div>
        <div class = "col-md-3">
          {{ $address->address }}
        </div>
        <div class = "col-md-1">
          @can('edit', $address)
            <a href="/macAddress/{{ $address->id }}/edit"><button class="btn btn-warning actionButton"><i class="fa fa-edit"></i></button></a>
          @else
            <i class="fa fa-lock"></i>
          @endcan
        </div>
        @can('destroy', $address)
          {{Form::open(['method' => 'delete',
                  'url' => '/macAddress/'.$address->id,
                  'class' => 'deleteBtn',
                  'class' => 'form-inline',
                  'style' => 'display:inline'])}}
            <div class="form-group">
              <button type="submit" class="btn btn-danger actionButton"><i class="fa fa-trash"></i></button>
            </div>
          {{Form::close()}}
        @endcan
        <hr>
      @endforeach
      @can('create', \App\Models\MacAddress::class)
        <div class="col-md-1 col-md-offset-11">
          <a href="/macAddress/create"><button class="btn btn-primary actionButton">
            <i class="fa fa-plus"></i></button>
          </a>
      </div>
      @else
        <div class="col-md-4 col-md-offset-8">
          (Vous ne pouvez pas ajouter d'adresse MAC)
        </div>
      @endcan
		</div>
	</div>
@endsection
