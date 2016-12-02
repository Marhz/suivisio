@extends('layouts.app')

@section('css')
@endsection

@section('content')
	
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Liste des classes</div>
                <div class="panel-body">
                	<a href="classes/create"><button class="btn btn-primary pull-right">Ajouter une classe</button></a>
                	<table class="table table-striped">
                		<thead>
                			<tr>
                				<td>Nom</td>
                				<td>Année</td>
                				<td>Parcours</td>
                				<td></td>
                				<td></td>
                				<td></td>
                			</tr>
                		</thead>
                		<tbody>
	                    	@foreach($groups as $group)
	                    		<tr>
									<td>{{$group->name}}</td>
									<td>{{$group->year}}</td>
									<td>{{$group->course->name}}</td>
									<td><a href="classes/{{$group->id}}">
										<button class="btn btn-primary"><i class="fa fa-eye"></i></button>
									</a></td>
									<td><a href="classes/{{$group->id}}/edit">
										<button class="btn btn-warning"><i class="fa fa-edit"></i></button>
									</a></td>
									<td>
										{{Form::open(['method' => 'delete', 'url' => 'classes/'.$group->id])}}
											<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
										{{Form::close()}}
									</a></td>
								</tr>
	                 		@endforeach
                 		</tbody>
                 	</table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection