@extends('layouts.app')

@section('css')
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">Liste des professeurs</div>
		<div class="panel-body">
			<a href="professeurs/create"><button class="btn btn-primary pull-right">Ajouter un professeur</button></a>
			<table class="table table-striped">
				<thead>
					<tr>
						<td>Nom</td>
						<td>Prenom</td>
						<td>Classes</td>
						<td>Actions</td>
					</tr>
				</thead>
				<tbody>
					@foreach($teachers as $teacher)
						<tr>
							<td>{{$teacher->last_name}}</td>
							<td>{{$teacher->first_name}}</td>
							<td>
								@foreach ($teacher->teacherOf as $group)
									{{$group->name}}<br/>
								@endforeach
							</td>
							<td><a href="professeurs/{{$teacher->id}}">
								<button class="btn btn-primary actionButton"><i class="fa fa-eye"></i></button>
							</a>
							<a href="professeurs/{{$teacher->id}}/edit">
								<button class="btn btn-warning actionButton"><i class="fa fa-edit"></i></button>
							</a>
							{{Form::open(['method' => 'delete', 
										'url' => 'professeurs/'.$teacher->id, 
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