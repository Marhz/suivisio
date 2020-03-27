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
			@can('edit', $document)
				<i class="fa fa-unlock"></i>
			@else
				<i class="fa fa-lock"></i>
			@endcan
		</div>
		<div class="panel-body">
			@if($document->pivot->deadline != null)
				Verrouillage le
				{{ (new Carbon($document->pivot->deadline))->formatLocalized('%d/%m/%Y à %H heures') }}
				({{ (new Carbon($document->pivot->deadline))->diffForHumans()}})
			<hr>
			@endif
			@if($document->pivot->file_name != null)
				<div class="row">
					<div class = "col-md-12">
						@include('documents.partials.status', ['pivot' => $document->pivot])
					</div>
				</div>
				<hr>
			@endif
			@can('accept', \App\Models\Document::class)
				<div class="form-group">
				{{ Form::open(['method' => 'post','url' => 'users/'.$user->id.'/documents/'.$document->id.'/accept']) }}
				{{ Form::submit('Accepter',['class' => 'btn btn-success']) }}
				{{ Form::close() }}
				</div>
				<hr>
				{{ Form::open(['method' => 'post','url' => 'users/'.$user->id.'/documents/'.$document->id.'/reject', 'class' => 'form-horizontal']) }}
				<div class="form-group">
					<div class = "col-md-12">
						{{ Form::textarea('comment',null,['id' => 'comment', 'class' => 'form-control']) }}
					</div>
				</div>
				<div class="form-group">
					<div class = "col-md-12">
						{{ Form::submit('Rejeter',['class' => 'btn btn-danger']) }}
					</div>
				</div>
				{{ Form::close() }}
			@endcan
			@can('edit', $document)
				{{Form::open(['method' => 'post','url' => 'documents/'.$document->id,
					'class' => 'form-horizontal', 'files' => true])}}
				<div class="form-group">
					<div class="col-md-9">
						{{Form::file('file_name',null, ['id' => 'file_name', 'class' => 'form-control-file'])}}
					</div>
					<div class="col-md-3">
						{{Form::submit('Téléverser',['class' => 'btn btn-primary'])}}
					</div>
				</div>
				{{Form::close()}}
			@endcan
		</div>
	</div>
@endsection
