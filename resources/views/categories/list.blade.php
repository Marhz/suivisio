@extends('layouts.app')

@section('css')
@endsection

@section('content')
	
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Liste des categories</div>
                <div class="panel-body">
                	<a href="categories/create"><button class="btn btn-primary pull-right">Ajouter une classe</button></a>
                	<table class="table table-striped">
                		<thead>
                			<tr>
                				<td>Nom</td>
                				<td>libellé</td>
                				<td>Parcours</td>
                				<td>Actions</td>
                			</tr>
                		</thead>
                		<tbody>
	                    	@foreach($categories as $category)
	                    		<tr>
									<td>{{$category->nomenclature}}</td>
									<td>{{$category->label}}</td>
									<td>{{isset($category->course_id) ? $category->course->name : 'indiférencié'}}</td>
									<td><a href="categories/{{$category->id}}">
										<button class="btn btn-primary actionButton"><i class="fa fa-eye"></i></button>
									</a>
									<a href="categories/{{$category->id}}/edit">
										<button class="btn btn-warning actionButton"><i class="fa fa-edit"></i></button>
									</a>
									{{Form::open(['method' => 'delete', 
                                                'url' => 'categories/'.$category->id, 
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
        </div>
    </div>
</div>

@endsection