@extends('layouts.app')

@section('css')
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Liste des situations
			@if($user->id != Auth::id())
				de {{ $user->fullName() }}
			@endif
			@include('groups.partials.lock', ['group' => $user->group])
		</div>
		<div class="panel-body">
			@can('addSituation', $user)
				<div class="pull-left">Verrouillage {{ (new Carbon($user->group->deadline))->diffForHumans()}}</div>
				<a href="situation/create"><button class="btn btn-primary pull-right">Ajouter une situation</button></a>
			@endcan
			<table class="table table-striped">
				<thead>
					<tr>
						<td>Libellé</td>
						<td>Description</td>
						<td>Source</td>
						<td>Début</td>
						<td>Fin</td>
						<td>Actions</td>
					</tr>
				</thead>
				<tbody>
					@foreach($situations as $situation)
						<tr>
							<td>{{$situation->name}}</td>
							<td>{{str_limit($situation->description,20,'...')}}</td>
							<td>{{$situation->source->label}}</td>
							<td>{{$situation->begin_at}}</td>
							<td>{{$situation->end_at}}</td>
							<td>
							@can('view', $situation)
								<a href={{ url('/situation/'.$situation->id)}} >
									<button class="btn btn-primary actionButton"><i class="fa fa-eye"></i></button>
								</a>
							@endcan
							@can('edit', $situation)
								<a href={{ url('/situation/'.$situation->id.'/edit')}}>
									<button class="btn btn-warning actionButton"><i class="fa fa-edit"></i></button>
								</a>
							@endcan
							@can('edit', $situation)
								<a href={{ url('/situation/'.$situation->id.'/duplicate')}}>
									<button class="btn btn-warning actionButton"><i class="fa fa-copy"></i></button>
								</a>
							@endcan
							@can('edit', $situation)
								{{Form::open(['method' => 'delete',
											'url' => '/situation/'.$situation->id,
											'class' => 'deleteBtn'])}}
									<button type="submit" class="btn btn-danger actionButton"><i class="fa fa-trash"></i></button>
								{{Form::close()}}
							@endcan
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
