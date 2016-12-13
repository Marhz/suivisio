@extends('layouts.app')

@section('css')
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Liste des categories</div>
		<div class="panel-body">
			<a href="activites_principales/create"><button class="btn btn-primary pull-right">Ajouter une activité principale</button></a>
			<table class="table table-striped">
				<thead>
					<tr>
						<td>Nom</td>
						<td>Activités liées</td>
						<td>Actions</td>
					</tr>
				</thead>
				<tbody>
					@foreach($main_activities as $main_activity)
						<tr>
						@php
						@endphp
							<td>{{$main_activity->name}}</td>
							<td>
								@foreach ($main_activity->activities as $activity)
									{{$activity->nomenclature}}<br/>
								@endforeach
							</td>
							<td>
							<a href="activites_principales/{{$main_activity->id}}/edit">
								<button class="btn btn-warning actionButton"><i class="fa fa-edit"></i></button>
							</a>
							{{Form::open(['method' => 'delete', 
										'url' => 'activites_principales/'.$main_activity->id, 
										'class' => 'deleteBtn'])}}
								<button type="submit" class="btn btn-danger actionButton">
									<i class="fa fa-trash"></i>
								</button>
							{{Form::close()}}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection