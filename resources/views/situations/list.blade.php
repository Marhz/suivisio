@extends('layouts.app')

@section('css')
@endsection

    @section('content')
	
        @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
            <div class="panel panel-default">
                <div class="panel-heading">Liste des situations</div>
                <div class="panel-body">
                	<a href="situation/create"><button class="btn btn-primary pull-right">Ajouter une situation</button></a>
                	<table class="table table-striped">
                		<thead>
                			<tr>
                				<td>Libéllé</td>
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
                                        <a href="situation/{{$situation->id}}">
                                            <button class="btn btn-primary actionButton"><i class="fa fa-eye"></i></button>
                                        </a>
    									<a href="situation/{{$situation->id}}/edit">
    										<button class="btn btn-warning actionButton"><i class="fa fa-edit"></i></button>
    									</a>
    									{{Form::open(['method' => 'delete', 
                                                    'url' => 'situation/'.$situation->id,
                                                    'class' => 'deleteBtn'])}}
    										<button type="submit" class="btn btn-danger actionButton"><i class="fa fa-trash"></i></button>
    									{{Form::close()}}
                                    </td>
								</tr>
	                 		@endforeach
                 		</tbody>
                 	</table>
                </div>
            </div>

    @endsection