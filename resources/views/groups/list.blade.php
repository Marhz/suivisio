@extends('layouts.app')

@section('css')
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Liste des classes</div>
		<div class="panel-body">
			@can('create', App\Models\Group::class)
				<a href="classes/create"><button class="btn btn-primary pull-right">Ajouter une classe</button></a>
			@endcan
			<table class="table table-striped">
				<thead>
					<tr>
						<td>Nom</td>
						<td>Année</td>
						<td>Verrouillé</td>
						<td>Parcours</td>
						<td>Actions</td>
					</tr>
				</thead>
				<tbody>
					@foreach($groups as $group)
						<tr>
							<td>{{$group->name}}</td>
							<td>{{$group->year}}</td>
							<td>@include('groups.partials.lock')</td>
							<td>{{$group->course->name}}</td>
							<td>
									<a href="classes/{{$group->id}}">
										@can('view', $group)
										<button class="btn btn-primary actionButton"><i class="fa fa-eye"></i></button>
									</a>
								@endcan
								@can('edit', $group)
									<a href="classes/{{$group->id}}/edit">
										<button class="btn btn-warning actionButton"><i class="fa fa-edit"></i></button>
									</a>
								@endcan
								@can('delete', $group)
									{{Form::open(['method' => 'delete',
												'url' => 'classes/'.$group->id,
												'class' => 'deleteBtn'])}}
										<button type="submit" class="btn btn-danger actionButton">
											<i class="fa fa-trash"></i>
										</button>
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
