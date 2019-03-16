@extends('layouts.app')

@section('content')
	@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
	@endif
	@foreach ($errors->all() as $error)
		<div class="alert alert-danger">{{ $error }}</div>
	@endforeach

	<div class="panel panel-default">
		<div class="panel-heading">
			{{ $document->name }}
		</div>
		<div class="panel-body">
			Verrouillage le
			{{ (new Carbon($user->group->deadline))->formatLocalized('%d/%m/%Y à %H heures') }}
			({{ (new Carbon($user->group->deadline))->diffForHumans()}})
			<hr>
			@if($document->pivot->file_name != null)
				<div class="row">
					<div class = "col-md-12">
						@include('documents.partials.link', ['file_name' => $document->pivot->file_name])
					</div>
				</div>
				<hr>
			@endif
			@can('edit', $document)
				{{Form::open(['method' => 'post','url' => 'documents/'.$document->id,
					'class' => 'form-horizontal', 'files' => true])}}
				<div class="form-group">
					<div class="col-md-10">
						{{Form::file('file_name',null, ['id' => 'file_name', 'class' => 'form-control-file'])}}
					</div>
					<div class="col-md-2">
						{{Form::submit('Enregistrer',['class' => 'btn btn-primary'])}}
					</div>
				</div>
				{{Form::close()}}
			@endcan
		</div>
	</div>
@endsection
