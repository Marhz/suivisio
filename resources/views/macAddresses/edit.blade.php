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
        @can('haveMultipleMacAddresses', $user)
          Mes addresses
        @else
          Mon adresse
        @endcan
      MAC
    </div>
		<div class="panel-body">
        @can('haveMultipleMacAddresses', $user)
          @foreach($addresses as $address)
            {{Form::model($user,['method' => 'post','url' => 'macAddress', 'class' => 'form-inline'])}}
              <div class="form-group">
                <input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" />
                <input name="id" type="hidden" value="{{ $address->id }}" />
                {{Form::label('address','Adresse MAC :')}}
                {{Form::text('address', $address->address, null,['id' => 'address', 'class' => 'form-control',''])}}
                @can('editMacAddress', Auth::user())
                  {{Form::submit('Enregistrer',['class' => 'btn btn-primary'])}}
                @endcan
              </div>
            {{Form::close()}}
            {{Form::open(['method' => 'delete',
                    'url' => '/macAddress/'.$address->id,
                    'class' => 'deleteBtn',
                    'class' => 'form-inline'])}}
              <div class="form-group">
                <button type="submit" class="btn btn-danger actionButton"><i class="fa fa-trash"></i></button>
              </div>
            {{Form::close()}}
          @endforeach
        @else
          {{Form::model($user,['method' => 'post','url' => 'macAddress'])}}
            <div class="form-group">
              {{Form::label('address','Adresse MAC :')}}
              {{Form::text('address',$address, null,['id' => 'address', 'class' => 'form-control',''])}}
            </div>
          {{Form::close()}}
        @endcan
		</div>
	</div>
@endsection
